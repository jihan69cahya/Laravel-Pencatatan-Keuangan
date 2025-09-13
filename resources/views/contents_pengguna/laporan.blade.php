@extends('layouts_admin.master')
@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')
@section('breadcrumb', 'Laporan')

@section('contents')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Laporan <small>Transaksi Keuangan</small>
            </h3>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="tabel_data">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Tanggal</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%;">Keterangan</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Masuk</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Keluar</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Saldo</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            get_data();
        });

        function get_data() {
            $('#tabel_data').DataTable({
                buttons: [{
                        extend: "copy",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: "csv",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: "excel",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: "pdf",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: "print",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],
                dom: "<'row'<'col-sm-12'<'bg-body-light py-2 mb-2'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                processing: true,
                serverSide: true,
                responsive: true,
                destroy: true,
                autoWidth: false,
                ordering: false,
                lengthMenu: [
                    [20, 50, -1],
                    [20, 50, "All"]
                ],
                ajax: {
                    url: "{{ route('laporan.datatable') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'tanggal',
                        className: 'text-center',
                        name: 'tanggal',
                    },
                    {
                        data: 'keterangan',
                        className: 'text-center',
                        name: 'keterangan',
                    },
                    {
                        data: 'debit',
                        className: 'text-center',
                        name: 'debit',
                    },
                    {
                        data: 'kredit',
                        className: 'text-center',
                        name: 'kredit',
                    },
                    {
                        data: 'saldo',
                        className: 'text-center',
                        name: 'saldo',
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('small-padding');
                }
            });
        }
    </script>
@endsection
