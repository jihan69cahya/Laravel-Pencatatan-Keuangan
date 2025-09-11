@extends('layouts_admin.master')
@section('title', 'Dashboard Pengguna')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('contents')
    <div class="row">
        <div class="col-md-4">
            <div class="block block-rounded block-link-shadow text-center">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-success">
                        <i class="fa fa-wallet fa-2x mb-2"></i>
                    </div>
                    <div class="fs-sm fw-semibold text-success text-uppercase tracking-wider">
                        Saldo Saat Ini
                    </div>
                    <div class="fs-3 fw-bold mt-2">
                        {{ App\Helpers\CustomHelper::stringToRupiah($data['saldo']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-rounded block-link-shadow text-center">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-primary">
                        <i class="fa fa-arrow-down fa-2x mb-2"></i>
                    </div>
                    <div class="fs-sm fw-semibold text-primary text-uppercase tracking-wider">
                        Pemasukan
                    </div>
                    <div class="fs-3 fw-bold mt-2">
                        {{ App\Helpers\CustomHelper::stringToRupiah($data['masuk']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-rounded block-link-shadow text-center">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-danger">
                        <i class="fa fa-arrow-up fa-2x mb-2"></i>
                    </div>
                    <div class="fs-sm fw-semibold text-danger text-uppercase tracking-wider">
                        Pengeluaran
                    </div>
                    <div class="fs-3 fw-bold mt-2">
                        {{ App\Helpers\CustomHelper::stringToRupiah($data['keluar']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Pemasukan vs Pengeluaran per Bulan (tahun {{ Date('Y') }})</h3>
                </div>
                <div class="block-content block-content-full">
                    <canvas id="chart-bar" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Persentase Pemasukan & Pengeluaran</h3>
                </div>
                <div class="block-content block-content-full">
                    <canvas id="chart-pie" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Transaksi 1 Minggu Terakhir</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id="tabel">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['transaksi'] as $item)
                                    <tr>
                                        <td>{{ App\Helpers\CustomHelper::format($item->tanggal, 1) }}</td>
                                        <td>
                                            @if ($item->tipe === 'MASUK')
                                                <span class="badge bg-success">Pemasukan</span>
                                            @elseif ($item->tipe === 'KELUAR')
                                                <span class="badge bg-danger text-light">Pengeluaran</span>
                                            @elseif ($item->tipe === 'SALDO AWAL')
                                                <span class="badge bg-info">Saldo Awal</span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>{{ App\Helpers\CustomHelper::stringToRupiah($item->nominal) }}</td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data transaksi</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets') }}/js/plugins/chart.js/chart.min.js"></script>
    <script>
        $('#tabel').dataTable({
            responsive: true
        });

        const ctxBar = document.getElementById('chart-bar');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: @json($data['chart']['labels']),
                datasets: [{
                        label: 'Pemasukan',
                        data: @json($data['chart']['pemasukan']),
                        backgroundColor: '#4caf50'
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($data['chart']['pengeluaran']),
                        backgroundColor: '#f44336'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString()
                        }
                    }
                }
            }
        });


        const ctxPie = document.getElementById('chart-pie');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [@json($data['masuk']), @json($data['keluar'])],
                    backgroundColor: ['#2196f3', '#ff5722']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
