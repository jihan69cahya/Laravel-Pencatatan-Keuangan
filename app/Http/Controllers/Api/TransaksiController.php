<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
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
}
