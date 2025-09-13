<?php

namespace App\Http\Controllers\Keuangan;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('contents_pengguna.laporan');
    }

    public function datatable()
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
                'tanggal'    => CustomHelper::format($trx->tanggal, 1),
                'keterangan' => $trx->keterangan ?? '-',
                'debit'      => $debit > 0 ? CustomHelper::stringToRupiah($debit) : '-',
                'kredit'     => $kredit > 0 ? CustomHelper::stringToRupiah($kredit) : '-',
                'saldo'      => CustomHelper::stringToRupiah($saldo),
            ];
        }

        return datatables()->of($rows)->make(true);
    }
}
