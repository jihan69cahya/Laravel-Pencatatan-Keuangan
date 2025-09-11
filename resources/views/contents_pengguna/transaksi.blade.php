@extends('layouts_admin.master')
@section('title', 'Transaksi Pencatatan')
@section('page-title', 'Pencatatan Keuangan')
@section('breadcrumb', 'Transaksi')

@section('contents')
    <div class="row">
        <div class="col-md-4">
            <div class="block block-rounded block-link-shadow text-center">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-success">
                        <i class="fa fa-wallet fa-2x mb-2"></i>
                    </div>
                    <div class="fs-sm fw-semibold text-success text-uppercase tracking-wider">
                        Total Saldo Anda
                    </div>
                    <div class="fs-3 fw-bold text-dark" id="total_saldo">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Data <small>Transaksi Keuangan</small>
            </h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" onclick="tambah_transaksi()">
                <i class="fa fa-plus me-1"></i>
                <span>Tambah Transaksi</span>
            </button>
        </div>
        <div class="block-content block-content-full">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="tanggal_mulai">Dari Tanggal</label>
                    <input type="text" class="js-flatpickr form-control" id="tanggal_mulai" name="tanggal_mulai"
                        placeholder="Y-m-d">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_selesai">Sampai Tanggal</label>
                    <input type="text" class="js-flatpickr form-control" id="tanggal_selesai" name="tanggal_selesai"
                        placeholder="Y-m-d">
                </div>
                <div class="col-md-3">
                    <label for="tipe">Tipe Transaksi</label>
                    <select class="form-select" id="tipe_filter" name="tipe_filter">
                        <option value="">Pilih tipe</option>
                        <option value="SALDO AWAL">Saldo Awal</option>
                        <option value="MASUK">Pemasukan</option>
                        <option value="KELUAR">Pengeluaran</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button id="filterData" class="btn btn-secondary" onclick="get_data()">Filter</button>
                </div>
            </div>

            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="tabel_data">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Tanggal</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Tipe</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%;">Nominal</th>
                        <th style="width: 30%;">Keterangan</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">
                            <i class="fa fa-file-invoice-dollar me-2"></i> <small class="text-light" id="title_modal">Input
                                Data
                                Transaksi</small>
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form id="formData">
                            <div class="row">
                                <div class="col-6 col-xl-6 col-sm-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="mb-2">
                                        <label class="form-label" for="tanggal">Tanggal</label>
                                        <input type="date" class="js-flatpickr form-control" id="tanggal"
                                            name="tanggal" placeholder="Y-m-d">
                                        <small class="text-danger ps-1" id="error-tanggal"></small>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="tipe">Tipe</label>
                                        <select class="form-select" id="tipe" name="tipe">
                                        </select>
                                        <small class="text-danger ps-1" id="error-tipe"></small>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="nominal">Nominal</label>
                                        <input type="text" class="form-control maskRupiah" id="nominal"
                                            name="nominal" placeholder="Masukkan nominal">
                                        <small class="text-danger ps-1" id="error-nominal"></small>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5"
                                            placeholder="Masukkan keterangan transaksi..."></textarea>
                                        <small class="text-danger ps-1" id="error-keterangan"></small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-warning" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="btn_tambah" class="btn btn-sm btn-alt-primary"
                            onclick="submitTransaksi()">Simpan</button>
                        <button type="button" id="btn_edit" class="btn btn-sm btn-alt-primary"
                            onclick="editTransaksi()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let today = new Date();
            let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            let lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

            let formatDate = (date) => {
                let month = String(date.getMonth() + 1).padStart(2, '0');
                let day = String(date.getDate()).padStart(2, '0');
                return date.getFullYear() + '-' + month + '-' + day;
            };

            $('#tanggal_mulai').val(formatDate(firstDay));
            $('#tanggal_selesai').val(formatDate(lastDay));

            $('#tanggal_mulai, #tanggal_selesai').on('change', function() {
                let mulai = new Date($('#tanggal_mulai').val());
                let selesai = new Date($('#tanggal_selesai').val());

                if (selesai < mulai) {
                    $('#tanggal_selesai').val($('#tanggal_mulai').val());
                }
            });

            get_data();
        });

        function get_data_saldo() {
            $.ajax({
                url: "{{ route('transaksi.saldo_transaksi') }}",
                type: "GET",
                beforeSend: function() {
                    $("#total_saldo").html(
                        "<div class='spinner-border spinner-border-sm text-dark' role='status'></div>");
                },
                success: function(res) {
                    $('#total_saldo').html(res);
                },
                error: function(xhr) {
                    toastr.error("Gagal cek saldo awal!");
                    console.log(xhr.responseText);
                }
            });
        }

        function get_data() {
            get_data_saldo();
            let tanggal_mulai = $('#tanggal_mulai').val();
            let tanggal_selesai = $('#tanggal_selesai').val();
            let tipe = $('#tipe_filter').val();
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
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                ajax: {
                    url: "{{ route('transaksi.datatable_pencatatan') }}",
                    type: 'GET',
                    data: {
                        tanggal_mulai: tanggal_mulai,
                        tanggal_selesai: tanggal_selesai,
                        tipe: tipe,
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                    },
                    {
                        data: 'tanggal_format',
                        className: 'text-center',
                        name: 'tanggal',
                    },
                    {
                        data: 'tipe_format',
                        className: 'text-center',
                        name: 'tipe',
                    },
                    {
                        data: 'nominal_format',
                        className: 'text-center',
                        name: 'nominal',
                    },
                    {
                        data: 'keterangan',
                        className: 'text-center',
                        name: 'keterangan',
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        name: 'aksi',
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('small-padding');
                }
            });
        }

        function tambah_transaksi() {
            delete_error();
            delete_form();
            $("#btn_tambah").show();
            $("#btn_edit").hide();
            $("#title_modal").text("Tambah data transaksi");
            $("#tipe").prop("disabled", false);

            $.ajax({
                url: "{{ route('cek_saldo_awal') }}",
                type: "GET",
                success: function(res) {
                    let options = '<option value="">-- Pilih Tipe --</option>';

                    if (res == 0) {
                        options += '';
                    } else {
                        options += '<option value="MASUK">Pemasukan</option>';
                        options += '<option value="KELUAR">Pengeluaran</option>';
                    }
                    $("#tipe").html(options);
                },
                error: function(xhr) {
                    toastr.error("Gagal cek saldo awal!");
                    console.log(xhr.responseText);
                }
            });
        }

        function edit_transaksi(data) {
            $("#btn_tambah").hide();
            $("#btn_edit").show();
            $("#title_modal").text("Edit data transaksi");

            let $btn = $(data);
            $('#id').val($btn.data('id'));
            $('#tanggal').val($btn.data('tanggal'));
            $('#nominal').val($btn.data('nominal'));
            $('#keterangan').val($btn.data('keterangan'));

            if ($btn.data('tipe') == 'SALDO AWAL') {
                let options = '<option value="">-- Pilih Tipe --</option>' +
                    '<option value="SALDO AWAL" selected>Saldo Awal</option>';
                $("#tipe").html(options).prop("disabled", true);
            } else {
                let options = '<option value="">-- Pilih Tipe --</option>' +
                    '<option value="MASUK">Pemasukan</option>' +
                    '<option value="KELUAR">Pengeluaran</option>';
                $("#tipe").html(options).prop("disabled", true);
            }
            $('#tipe').val($btn.data('tipe')).change();
        }


        function submitTransaksi() {
            var formData = new FormData(document.getElementById('formData'));
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.tambah_data') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#btn_tambah").prop("disabled", true).html(
                        "<div class='spinner-border spinner-border-sm text-dark' role='status'></div>");
                },
                success: function(response) {
                    delete_error();
                    if (response.errors) {
                        Object.keys(response.errors).forEach(function(fieldName) {
                            $("#error-" + fieldName).show();
                            $("#error-" + fieldName).html(
                                response.errors[fieldName][0]
                            );
                        });
                    } else if (response.success) {
                        $("#modal").modal("hide");
                        Dashmix.helpers('jq-notify', {
                            type: 'success',
                            icon: 'fa fa-check me-1',
                            message: response.success
                        });
                        get_data();
                    } else if (response.error) {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: response.error
                        });
                        get_data();
                    }
                    $("#btn_tambah").prop("disabled", false).text("Simpan");
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                    $("#btn_tambah").prop("disabled", false).text("Simpan");
                },
            });
        }

        function editTransaksi() {
            var formData = new FormData(document.getElementById('formData'));
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.edit_data') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#btn_edit").prop("disabled", true).html(
                        "<div class='spinner-border spinner-border-sm text-dark' role='status'></div>");
                },
                success: function(response) {
                    delete_error();
                    if (response.errors) {
                        Object.keys(response.errors).forEach(function(fieldName) {
                            $("#error-" + fieldName).show();
                            $("#error-" + fieldName).html(
                                response.errors[fieldName][0]
                            );
                        });
                    } else if (response.success) {
                        $("#modal").modal("hide");
                        Dashmix.helpers('jq-notify', {
                            type: 'success',
                            icon: 'fa fa-check me-1',
                            message: response.success
                        });
                        get_data();
                    } else if (response.error) {
                        $("#modal").modal("hide");
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: response.error
                        });
                        get_data();
                    }
                    $("#btn_edit").prop("disabled", false).text("Simpan");
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                    $("#btn_edit").prop("disabled", false).text("Simpan");
                },
            });
        }

        function hapus_data(id) {
            Swal.fire({
                title: 'Konfirmasi!',
                text: "Apakah anda yakin ingin menghapus transaksi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        url: "{{ route('transaksi.hapus_data') }}",
                        success: function(response) {
                            if (response.success) {
                                Dashmix.helpers('jq-notify', {
                                    type: 'success',
                                    icon: 'fa fa-check me-1',
                                    message: response.success
                                });
                                get_data();
                            } else if (response.error) {
                                Dashmix.helpers('jq-notify', {
                                    type: 'danger',
                                    icon: 'fa fa-times me-1',
                                    message: response.error
                                });
                                get_data();
                            }
                        },
                    });
                }
            })
        }
    </script>
@endsection
