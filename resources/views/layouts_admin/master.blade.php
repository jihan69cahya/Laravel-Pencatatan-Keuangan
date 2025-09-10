<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Pencatatan - @yield('title')</title>

    <meta name="description"
        content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description"
        content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/media/favicons/icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets') }}/media/favicons/icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets') }}/media/favicons/icon.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets') }}/css/dashmix.min.css">
    <!-- END Stylesheets -->
</head>

<body>
    <div id="page-container"
        class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

        @include('layouts_admin.sidebar')

        @include('layouts_admin.navbar')

        <main id="main-container">
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">@yield('page-title')</h1>
                        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">{{ Auth::user()->role }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb') </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="content">
                @yield('contents')
            </div>
        </main>

        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                            target="_blank">Jihan Cahya Firmana</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" target="_blank">Pencatatan Keuangan</a> &copy; <span
                            data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

    <script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>

    <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirm_logout() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan keluar dari aplikasi ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logout') }}";
                }
            })
        }
    </script>
    @yield('scripts')
</body>

</html>
