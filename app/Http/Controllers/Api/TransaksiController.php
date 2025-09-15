<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function data()
    {
        $data = Transaksi::orderBy('tanggal', 'ASC')->get();

        $rows = [];
        $saldo = 0;

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
                'keterangan' => $trx->keterangan ?? '-',
                'debit'      => $debit > 0 ? $debit : '-',
                'kredit'     => $kredit > 0 ? $kredit : '-',
                'saldo'      => $saldo,
            ];
        }

        return response()->json($rows, 200);
    }
}
