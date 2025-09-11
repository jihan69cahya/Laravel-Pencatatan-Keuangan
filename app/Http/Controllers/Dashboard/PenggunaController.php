<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{

    public function index()
    {
        $data['masuk'] = Transaksi::whereIn('tipe', ['SALDO AWAL', 'MASUK'])->sum('nominal');
        $data['keluar'] = Transaksi::where('tipe', 'KELUAR')->sum('nominal');
        $data['saldo'] = $data['masuk'] - $data['keluar'];
        $data['transaksi'] = Transaksi::whereDate('tanggal', '>=', Carbon::now()->subWeek())
            ->get();

        $year = Carbon::now()->year;

        $transaksiPerBulan = Transaksi::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('SUM(CASE WHEN tipe IN ("SALDO AWAL","MASUK") THEN nominal ELSE 0 END) as pemasukan'),
            DB::raw('SUM(CASE WHEN tipe = "KELUAR" THEN nominal ELSE 0 END) as pengeluaran')
        )
            ->whereYear('tanggal', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $pemasukan = [];
        $pengeluaran = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanData = $transaksiPerBulan->firstWhere('bulan', $i);
            $labels[] = Carbon::create()->month($i)->format('M');
            $pemasukan[] = $bulanData ? (int) $bulanData->pemasukan : 0;
            $pengeluaran[] = $bulanData ? (int) $bulanData->pengeluaran : 0;
        }

        $data['chart'] = [
            'labels' => $labels,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
        ];

        return view('contents_pengguna.dashboard', compact('data'));
    }
}
