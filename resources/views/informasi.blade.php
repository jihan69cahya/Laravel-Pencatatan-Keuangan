@extends('layouts.master')

@section('contents')
    <div class="bg-header-dark">
        <div class="content content-full">
            <div class="row">
                <div class="col-md d-md-flex align-items-md-center">
                    <div class="w-100 text-center text-md-start">
                        <h1 class="text-white mb-2 fw-semibold">Informasi</h1>
                        <div class="fw-medium fs-base text-white-75">
                            Temukan berbagai informasi dan panduan penggunaan aplikasi pencatatan keuangan
                        </div>
                    </div>
                </div>
                <div class="col-md d-md-flex align-items-md-center justify-content-md-end text-center">
                    <a href="{{ route('landing') }}" type="button" class="btn btn-primary me-1">
                        <i class="fa fa-arrow-left opacity-50 me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-body-extra-light">
        <div class="content content-full">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt bg-body-light px-4 py-2 rounded push">
                    <li class="breadcrumb-item">
                        <a href="{{ route('landing') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                </ol>
            </nav>

            <!-- Konten halaman informasi bisa ditambahkan di sini -->
            <div class="content">
                <h2 class="fw-semibold">Panduan Aplikasi</h2>
                <p>
                    Halaman ini berisi informasi lengkap mengenai fitur, cara penggunaan,
                    dan tips untuk memanfaatkan aplikasi pencatatan keuangan dengan maksimal.
                </p>
            </div>
        </div>
    </div>
@endsection
