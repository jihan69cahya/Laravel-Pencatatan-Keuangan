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

            <div class="block block-rounded">
                <div class="block-content text-center py-5">
                    <h2 class="fw-bold mb-4">Mulai Kelola Keuangan Anda</h2>
                    <p class="text-muted fs-5 mb-4">
                        Akses aplikasi pencatatan keuangan melalui berbagai platform
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('login') }}" class="btn btn-success btn-lg w-100 py-3">
                                        <i class="fa fa-sign-in-alt mb-2" style="font-size: 1.5rem;"></i><br>
                                        <span class="fw-semibold">Login Web</span><br>
                                        <small>Akses via Browser</small>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="#" class="btn btn-info btn-lg w-100 py-3" onclick="downloadAndroidApp()">
                                        <i class="fab fa-android mb-2" style="font-size: 1.5rem;"></i><br>
                                        <span class="fw-semibold">Download Android</span><br>
                                        <small>Aplikasi Mobile</small>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg w-100 py-3">
                                        <i class="fa fa-user-plus mb-2" style="font-size: 1.5rem;"></i><br>
                                        <span class="fw-semibold">Daftar Akun</span><br>
                                        <small>Pengguna Baru</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-flow-chart text-primary me-2"></i>
                        Alur Penggunaan Aplikasi
                    </h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-success-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-user-plus text-success fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-success mb-3">1. Daftar Akun</h4>
                                    <p class="text-muted mb-0">
                                        Buat akun baru dengan mengisi nama, email, dan password.
                                        Verifikasi email Anda untuk mengaktifkan akun.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-info-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-sign-in-alt text-info fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-info mb-3">2. Login ke Aplikasi</h4>
                                    <p class="text-muted mb-0">
                                        Masuk menggunakan email dan password yang telah didaftarkan.
                                        Aplikasi dapat diakses melalui web browser atau aplikasi Android.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-warning-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-wallet text-warning fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-warning mb-3">3. Atur Saldo Awal</h4>
                                    <p class="text-muted mb-0">
                                        Masukkan saldo awal keuangan Anda sebagai titik mulai pencatatan.
                                        Ini bisa berupa uang tunai, saldo rekening, atau total aset liquid.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-success-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-plus-circle text-success fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-success mb-3">4. Catat Pemasukan</h4>
                                    <p class="text-muted mb-0">
                                        Setiap ada uang masuk (gaji, bonus, penjualan, dll),
                                        langsung catat dengan kategori yang sesuai. Saldo akan otomatis terupdate.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-danger-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-minus-circle text-danger fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-danger mb-3">5. Catat Pengeluaran</h4>
                                    <p class="text-muted mb-0">
                                        Catat setiap pengeluaran mulai dari yang kecil hingga besar.
                                        Kategorikan berdasarkan jenis (makanan, transportasi, belanja, dll).
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="block block-rounded block-bordered text-center h-100">
                                <div class="block-content py-4">
                                    <div class="mb-3">
                                        <div class="bg-primary-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-chart-line text-primary fs-3"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-semibold text-primary mb-3">6. Monitor & Analisa</h4>
                                    <p class="text-muted mb-0">
                                        Pantau saldo real-time, lihat history transaksi, dan analisa
                                        laporan bulanan untuk memahami pola keuangan Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="block block-rounded h-100">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-globe text-primary me-2"></i>
                                Akses via Web Browser
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="text-center mb-4">
                                <i class="fa fa-laptop text-primary" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="fw-semibold mb-3">Fitur Web Version:</h5>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Dashboard lengkap
                                </li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Laporan detail
                                    dengan grafik</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Export data ke
                                    Excel/PDF</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Backup otomatis
                                </li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Akses dari
                                    berbagai device</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fa fa-sign-in-alt me-2"></i>Login Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="block block-rounded h-100">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fab fa-android text-success me-2"></i>
                                Aplikasi Android
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="text-center mb-4">
                                <i class="fa fa-mobile-alt text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="fw-semibold mb-3">Fitur Mobile Version:</h5>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Pencatatan cepat
                                    on-the-go</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Notifikasi
                                    pengingat</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Foto bukti
                                    transaksi</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Sinkronisasi
                                    real-time</li>
                                <li><span class="fa-li"><i class="fa fa-check text-success"></i></span>Mode offline</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-success" onclick="downloadAndroidApp()">
                                    <i class="fab fa-android me-2"></i>Download APK
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-rounded mt-4">
                <div class="block-content text-center py-5">
                    <i class="fa fa-headset text-primary mb-3" style="font-size: 3rem;"></i>
                    <h3 class="fw-semibold mb-3">Butuh Bantuan?</h3>
                    <p class="text-muted mb-4">
                        Tim support kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami
                        jika mengalami kesulitan atau memiliki pertanyaan.
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="btn-group w-100" role="group">
                                <a href="mailto:support@financialapp.com" class="btn btn-outline-primary">
                                    <i class="fa fa-envelope me-2"></i>Email Support
                                </a>
                                <a href="https://wa.me/1234567890" class="btn btn-outline-success" target="_blank">
                                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadAndroidApp() {
            if (confirm(
                    'Anda akan mengunduh aplikasi Pencatatan Keuangan untuk Android.\n\nCatatan: Pastikan Anda mengizinkan instalasi dari sumber tidak dikenal di pengaturan Android Anda.\n\nLanjutkan download?'
                )) {
                const downloadLink = document.createElement('a');
                downloadLink.href = '{{ asset('assets/apk/pencatatan.apk') }}';
                downloadLink.download = 'pencatatan-keuangan.apk';
                downloadLink.style.display = 'none';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

                setTimeout(function() {
                    alert('Download dimulai! Silakan cek folder Download di perangkat Anda.');
                }, 1000);
            }
        }
    </script>
@endsection
