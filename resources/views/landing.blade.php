@extends('layouts.master')

@section('contents')
    <div class="bg-header-dark">
        <div class="content content-full">
            <div class="row">
                <div class="col-md d-md-flex align-items-md-center">
                    <div class="w-100 text-center text-md-start">
                        <h1 class="text-white mb-2 fw-semibold">Dashboard</h1>
                        <div class="fw-medium fs-base text-white-75">Selamat datang di website pencatatan
                            keuangan
                        </div>
                    </div>
                </div>
                <div class="col-md d-md-flex align-items-md-center justify-content-md-end text-center">
                    <a href="{{ route('informasi') }}" type="button" class="btn btn-primary me-1">
                        <i class="fa fa-sign-in-alt opacity-50 me-1"></i> Bergabung dengan Aplikasi
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
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
