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

        $saldoAwal = Transaksi::where('tanggal', '<', function ($query) use ($page, $perPage) {
            $query->select('tanggal')
                ->from('transaksi')
                ->orderBy('tanggal', 'ASC')
                ->skip(($page - 1) * $perPage)
                ->take(1);
        })
            ->selectRaw("
            COALESCE(SUM(
                CASE 
                    WHEN tipe = 'SALDO AWAL' THEN nominal
                    WHEN tipe = 'MASUK' THEN nominal
                    WHEN tipe = 'KELUAR' THEN -nominal
                    ELSE 0
                END
            ), 0) as saldo
        ")
            ->value('saldo');

        $saldo = $saldoAwal;

        $data = Transaksi::orderBy('tanggal', 'ASC')->paginate($perPage);

        $rows = [];
        foreach ($data as $trx) {
            $debit = 0;
            $kredit = 0;

            if ($trx->tipe == 'SALDO AWAL') {
                $debit = $trx->nominal;
                $saldo = $debit;
            } elseif ($trx->tipe == 'MASUK') {
                $debit = $trx->nominal;
                $saldo += $debit;
            } elseif ($trx->tipe == 'KELUAR') {
                $kredit = $trx->nominal;
                $saldo -= $kredit;
            }

            $rows[] = [
                'tanggal'    => $trx->tanggal,
                'tipe'    => $trx->tipe,
                'keterangan' => $trx->keterangan ?? '-',
                'debit'      => $debit > 0 ? $debit : '-',
                'kredit'     => $kredit > 0 ? $kredit : '-',
                'saldo'      => $saldo,
            ];
        }

        return response()->json([
            'data' => $rows,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page'     => $data->perPage(),
                'total'        => $data->total(),
                'last_page'    => $data->lastPage(),
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
                $transaksi->update([
                    'tanggal' => $request->tanggal,
                    'tipe' => $request->tipe,
                    'nominal' => $request->nominal,
                    'keterangan' => $request->keterangan,
                ]);
            } else {
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
}
