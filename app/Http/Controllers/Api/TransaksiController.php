<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{

    public function dataDashboard()
    {
        $pemasukan = Transaksi::whereIn('tipe', ['SALDO AWAL', 'MASUK'])->sum('nominal') ?? 0;
        $pengeluaran = Transaksi::where('tipe', 'KELUAR')->sum('nominal') ?? 0;
        $saldo = $pemasukan - $pengeluaran;

        $year = Carbon::now()->year;

        $transaksi = Transaksi::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('SUM(CASE WHEN tipe IN ("SALDO AWAL","MASUK") THEN nominal ELSE 0 END) as pemasukan'),
            DB::raw('SUM(CASE WHEN tipe = "KELUAR" THEN nominal ELSE 0 END) as pengeluaran')
        )
            ->whereYear('tanggal', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        return response()->json([
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'transaksi' => $transaksi,
        ], 200);
    }
    public function data(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $page    = $request->get('page', 1);
        $offset  = ($page - 1) * $perPage;

        $cutoff = Transaksi::orderBy('tanggal', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->skip($offset)
            ->take(1)
            ->first();

        $saldoAwal = 0;

        if ($cutoff) {
            $saldoAwal = DB::table('transaksi')
                ->where(function ($q) {
                    $q->where('tipe', 'SALDO AWAL')
                        ->orWhere('tipe', 'MASUK')
                        ->orWhere('tipe', 'KELUAR');
                })
                ->where(function ($q) use ($cutoff) {
                    $q->where('tanggal', '<', $cutoff->tanggal)
                        ->orWhere(function ($q2) use ($cutoff) {
                            $q2->where('tanggal', $cutoff->tanggal)
                                ->where('created_at', '<', $cutoff->created_at);
                        });
                })
                ->selectRaw("COALESCE(SUM(CASE 
                            WHEN tipe IN ('SALDO AWAL','MASUK') THEN nominal
                            WHEN tipe = 'KELUAR' THEN -nominal
                            ELSE 0 END),0) as saldo")
                ->value('saldo');
        }

        $data = Transaksi::orderBy('tanggal', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $saldo = $saldoAwal;
        $rows = [];

        foreach ($data as $trx) {
            $debit = 0;
            $kredit = 0;

            if ($trx->tipe == 'SALDO AWAL' || $trx->tipe == 'MASUK') {
                $debit = $trx->nominal;
                $saldo += $debit;
            } elseif ($trx->tipe == 'KELUAR') {
                $kredit = $trx->nominal;
                $saldo -= $kredit;
            }

            $rows[] = [
                'id'         => $trx->id,
                'tanggal'    => $trx->tanggal,
                'tipe'       => $trx->tipe,
                'keterangan' => $trx->keterangan ?? '-',
                'debit'      => $debit > 0 ? $debit : '-',
                'kredit'     => $kredit > 0 ? $kredit : '-',
                'saldo'      => $saldo,
            ];
        }

        $total = Transaksi::count();

        return response()->json([
            'data' => $rows,
            'pagination' => [
                'current_page' => $page,
                'per_page'     => $perPage,
                'total'        => $total,
                'last_page'    => ceil($total / $perPage),
            ]
        ], 200);
    }

    public function cekSaldoAwal()
    {
        $saldo_awal = Transaksi::where('tipe', 'SALDO AWAL')->count();
        return response()->json($saldo_awal, 200);
    }

    public function simpanTransaksi(Request $request)
    {
        DB::beginTransaction();

        try {
            if ($request->id) {
                $transaksi = Transaksi::findOrFail($request->id);

                if ($transaksi && $transaksi->tipe === 'KELUAR') {
                    $saldo = Transaksi::saldo() + $transaksi->nominal;

                    if ($request->nominal > $saldo) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Saldo tidak cukup untuk transaksi pengeluaran',
                            'error' => 'Saldo tidak cukup untuk transaksi pengeluaran'
                        ], 500);
                    }
                }

                $transaksi->update([
                    'tanggal' => $request->tanggal,
                    'tipe' => $request->tipe,
                    'nominal' => $request->nominal,
                    'keterangan' => $request->keterangan,
                ]);
            } else {
                if ($request->tipe === 'KELUAR') {
                    $saldo = Transaksi::saldo();
                    if ($request->nominal > $saldo) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Saldo tidak cukup untuk transaksi pengeluaran',
                            'error' => 'Saldo tidak cukup untuk transaksi pengeluaran'
                        ], 500);
                    }
                }

                $transaksi = Transaksi::create([
                    'tanggal' => $request->tanggal,
                    'users_id' => Auth::user()->id,
                    'tipe' => $request->tipe,
                    'nominal' => $request->nominal,
                    'keterangan' => $request->keterangan,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Transaksi berhasil disimpan',
                'data' => $transaksi
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function hapusTransaksi(Request $request)
    {
        try {
            DB::beginTransaction();

            $transaksi = Transaksi::find($request->id);
            $transaksi->delete();

            DB::commit();
            return response()->json(['success' => 'Berhasil menghapus transaksi'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
