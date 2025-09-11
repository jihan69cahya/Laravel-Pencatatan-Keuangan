<?php

namespace App\Http\Controllers\Keuangan;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('contents_pengguna.transaksi');
    }

    public function saldoTransaksi()
    {
        $saldo = Transaksi::saldo();
        return response()->json(CustomHelper::stringToRupiah($saldo));
    }

    public function cekSaldoAwal()
    {
        $saldo_awal = Transaksi::where('tipe', 'SALDO AWAL')->count();
        return response()->json($saldo_awal);
    }

    public function datatablePencatatan(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;
        $tipe = $request->tipe;

        $data = Transaksi::orderBy('tanggal', 'DESC')
            ->when($tipe, function ($query, $tipe) {
                $query->where('tipe', $tipe);
            })
            ->when($tanggal_mulai && $tanggal_selesai, function ($query) use ($tanggal_mulai, $tanggal_selesai) {
                $query->whereBetween('tanggal', [$tanggal_mulai, $tanggal_selesai]);
            })
            ->get();
        return DataTables::of($data)
            ->addColumn("tanggal_format", function ($row) {
                return CustomHelper::format($row->tanggal, 1);
            })
            ->addColumn("nominal_format", function ($row) {
                return CustomHelper::stringToRupiah($row->nominal);
            })
            ->addColumn("tipe_format", function ($row) {
                if ($row->tipe === 'MASUK') {
                    return '<span class="badge bg-success">Pemasukan</span>';
                } elseif ($row->tipe === 'KELUAR') {
                    return '<span class="badge bg-danger text-light">Pengeluaran</span>';
                } elseif ($row->tipe === 'SALDO AWAL') {
                    return '<span class="badge bg-info">Saldo Awal</span>';
                }
            })
            ->editColumn("keterangan", function ($row) {
                return $row->keterangan ?? '-';
            })
            ->addColumn("aksi", function ($row) {
                $id = encrypt($row->id);
                $btnEdit = "
                        <button class='btn btn-warning btn-sm' 
                                data-bs-toggle='modal'
                                data-bs-target='#modal'
                                data-id='$id'
                                data-tanggal='$row->tanggal'
                                data-tipe='$row->tipe'
                                data-nominal='$row->nominal'
                                data-keterangan='$row->keterangan'
                                onclick='edit_transaksi(this)'>
                            <i class='fa fa-edit me-1'></i>
                            <span>Edit</span>
                        </button>";
                if ($row->tipe !== 'SALDO AWAL') {
                    $btnDelete = "<button class='btn btn-danger btn-sm' onclick='hapus_data(\"$id\")'>
                                    <i class='fa fa-trash me-1'></i>
                                    <span>Hapus</span>
                                </button>";
                } else {
                    $btnDelete = '';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'tipe_format'])
            ->make(true);
    }

    public function tambahData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal'      => 'required|date',
            'tipe'         => 'required|in:MASUK,KELUAR,SALDO AWAL',
            'nominal'      => 'required|min:1',
            'keterangan'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            DB::beginTransaction();

            Transaksi::create([
                'tanggal' => $request->tanggal,
                'users_id' => Auth::user()->id,
                'tipe' => $request->tipe,
                'nominal' => CustomHelper::rupiahToString($request->nominal),
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();
            return response()->json(['success' => 'Berhasil menambah transaksi']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function editData(Request $request)
    {
        $id = decrypt($request->id);
        $validator = Validator::make($request->all(), [
            'tanggal'      => 'required|date',
            'nominal'      => 'required|min:1',
            'keterangan'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            DB::beginTransaction();

            Transaksi::where('id', $id)->update([
                'tanggal'    => $request->tanggal,
                'nominal'    => is_numeric($request->nominal)
                    ? $request->nominal
                    : CustomHelper::rupiahToString($request->nominal),
                'keterangan' => $request->keterangan
            ]);

            DB::commit();
            return response()->json(['success' => 'Berhasil mengubah transaksi']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function hapusData(Request $request)
    {
        $id = decrypt($request->id);
        try {
            DB::beginTransaction();

            $transaksi = Transaksi::find($id);
            $transaksi->delete();

            DB::commit();
            return response()->json(['success' => 'Berhasil menghapus transaksi']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
