@extends('layouts.master')

@section('contents')
    <div class="bg-header-dark">
        <div class="content content-full">
            <div class="row py-5">
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="w-100 text-center text-lg-start">
                        <h1 class="text-white mb-3 fw-bold" style="font-size: 3rem;">
                            Kelola Keuangan <span class="text-light">Lebih Mudah</span>
                        </h1>
                        <p class="text-white-75 fs-5 mb-4">
                            Aplikasi pencatatan keuangan yang membantu Anda tracking uang masuk dan keluar,
                            monitoring saldo, serta menganalisis pemasukan dan pengeluaran bulanan secara otomatis.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                            <a href="{{ route('informasi') }}" class="btn btn-primary btn-lg px-4 py-3">
                                <i class="fa fa-rocket me-2"></i> Mulai Sekarang
                            </a>
                            <a href="#fitur" class="btn btn-outline-light btn-lg px-4 py-3">
                                <i class="fa fa-info-circle me-2"></i> Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <i class="fa fa-chart-line text-light" style="font-size: 8rem; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="fitur" class="content content-full py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Fitur Unggulan</h2>
            <p class="text-muted fs-5">Semua yang Anda butuhkan untuk mengelola keuangan personal</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-plus-circle text-success" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">Pencatatan Pemasukan</h4>
                        <p class="text-muted">
                            Catat semua uang masuk dengan mudah. Kategorikan sumber pemasukan
                            dan pantau pertumbuhan finansial Anda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-minus-circle text-danger" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">Pencatatan Pengeluaran</h4>
                        <p class="text-muted">
                            Tracking semua pengeluaran dengan detail. Ketahui ke mana saja uang
                            Anda terpakai dan kontrol spending habits.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-wallet text-primary" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">Monitoring Saldo</h4>
                        <p class="text-muted">
                            Pantau saldo keuangan Anda secara real-time. Lihat posisi keuangan
                            Anda kapan saja dengan akurat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-history text-info" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">History Transaksi</h4>
                        <p class="text-muted">
                            Akses riwayat transaksi lengkap. Cari dan filter transaksi
                            berdasarkan tanggal, kategori, atau jumlah.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-chart-bar text-warning" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">Laporan Bulanan</h4>
                        <p class="text-muted">
                            Dapatkan insight mendalam tentang pola keuangan bulanan Anda
                            dengan grafik dan statistik yang mudah dipahami.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="block block-rounded block-link-shadow text-center h-100">
                    <div class="block-content py-5">
                        <div class="mb-4">
                            <i class="fa fa-mobile-alt text-secondary" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="mb-3">Akses Mudah</h4>
                        <p class="text-muted">
                            Interface yang user-friendly dan responsive. Akses dari mana saja,
                            kapan saja melalui berbagai device.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-body-extra-light py-5">
        <div class="content content-full">
            <div class="row text-center">
                <div class="col-6 col-lg-3 mb-4">
                    <div class="block block-rounded">
                        <div class="block-content py-4">
                            <div class="fs-1 fw-bold text-primary mb-2">100%</div>
                            <div class="text-muted">Gratis</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-4">
                    <div class="block block-rounded">
                        <div class="block-content py-4">
                            <div class="fs-1 fw-bold text-success mb-2">24/7</div>
                            <div class="text-muted">Akses Kapan Saja</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-4">
                    <div class="block block-rounded">
                        <div class="block-content py-4">
                            <div class="fs-1 fw-bold text-info mb-2">∞</div>
                            <div class="text-muted">Unlimited Transaksi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-4">
                    <div class="block block-rounded">
                        <div class="block-content py-4">
                            <div class="fs-1 fw-bold text-warning mb-2">🔒</div>
                            <div class="text-muted">Data Aman</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content content-full py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Mengapa Harus Mencatat Keuangan?</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fa fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Kontrol Pengeluaran</h5>
                                <p class="text-muted small">Ketahui ke mana saja uang Anda terpakai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fa fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Perencanaan Keuangan</h5>
                                <p class="text-muted small">Buat budget dan rencana finansial yang realistis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fa fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Deteksi Pemborosan</h5>
                                <p class="text-muted small">Identifikasi pengeluaran yang tidak perlu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fa fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Pencapaian Goal</h5>
                                <p class="text-muted small">Capai target tabungan dan investasi Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fa fa-piggy-bank text-primary" style="font-size: 12rem; opacity: 0.7;"></i>
            </div>
        </div>
    </section>

    <section class="bg-primary">
        <div class="content content-full py-5">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-3">Mulai Kelola Keuangan Anda Sekarang!</h2>
                    <p class="text-white-75 fs-5 mb-4">
                        Jangan biarkan keuangan Anda tidak terkontrol. Bergabunglah dan rasakan kemudahan
                        mengelola keuangan personal dengan aplikasi kami.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="{{ route('informasi') }}" class="btn btn-light btn-lg px-5 py-3">
                            <i class="fa fa-sign-in-alt me-2"></i> Bergabung Sekarang
                        </a>
                        <a href="https://wa.me/62895414580242?text=Halo%20saya%20ingin%20bertanya..." target="_blank"
                            class="btn btn-outline-light btn-lg px-5 py-3">
                            <i class="fa fa-phone me-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
