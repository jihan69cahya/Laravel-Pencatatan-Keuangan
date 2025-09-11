<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Pencatatan - Register</title>

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
    <div id="page-container">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('{{ asset('assets') }}/media/bg_login.jpg');">
                <div class="row g-0 bg-primary-op">
                    <div class="hero-static col-md-6 d-flex align-items-center bg-body-extra-light">
                        <div class="p-3 w-100">
                            <div class="mb-3 text-center">
                                <a class="link-fx fw-bold fs-1" href="index.html">
                                    <span class="text-dark">Pencatatan</span><span class="text-primary"> Keuangan</span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">Login</p>
                            </div>

                            <div class="row g-0 justify-content-center">
                                <div class="col-sm-8 col-xl-6">
                                    <form class="js-validation-signin" action="{{ route('doRegister') }}" method="POST"
                                        onsubmit="submitPostRegister(event, $(this))">
                                        @csrf
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-alt" id="name"
                                                    name="name" placeholder="Nama Lengkap">
                                            </div>

                                            <div class="mb-4">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-alt number-only"
                                                    id="telp" name="telp" placeholder="Nomor Telepon">
                                            </div>

                                            <div class="mb-4">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-alt" id="email"
                                                    name="email" placeholder="Email">
                                            </div>

                                            <div class="mb-4">
                                                <div class="input-group input-group-lg">
                                                    <input type="password" class="form-control form-control-alt"
                                                        id="password" name="password" placeholder="Password">
                                                    <button type="button" class="btn btn-alt-secondary"
                                                        id="toggle-password">
                                                        <i class="fa fa-eye" id="toggle-password-icon"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <button type="submit" id="btn_register"
                                                    class="btn w-100 btn-lg btn-hero btn-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Register
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="text-center mb-3">
                                    <p class="mb-0">
                                        Sudah punya akun?
                                        <a href="{{ route('login') }}" class="fw-bold text-primary">Login
                                            sekarang</a>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('landing') }}" class="text-muted">
                                        <i class="fa fa-arrow-left me-1"></i> Kembali ke Halaman Utama
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                    <div class="p-3">
                        <p class="display-4 fw-bold text-white mb-3">
                            Pencatatan Keuangan
                        </p>
                        <p class="fs-lg fw-semibold text-white-75 mb-0">
                            Copyright &copy; <span data-toggle="year-copy"></span>
                        </p>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>

    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets') }}/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets') }}/js/pages/op_auth_signin.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('toggle-password');
            const toggleIcon = document.getElementById('toggle-password-icon');
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        });

        // $('.maskRupiah').maskMoney({
        //     prefix: 'Rp. ',
        //     thousands: '.',
        //     decimal: ',',
        //     precision: 0
        // });

        $('.number-only').keypress(function(e) {
            var txt = String.fromCharCode(e.which);
            if (!txt.match(/[0-9.,]/)) {
                return false;
            }
        });

        function submitPostRegister(event, this_) {
            event.preventDefault();

            // reset error
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            $.ajax({
                url: this_.attr('action'),
                type: this_.attr('method'),
                data: this_.serialize(),
                beforeSend: () => {
                    $("#btn_register").prop("disabled", true).html(
                        "<div class='spinner-border spinner-border-sm text-primary' role='status'></div> Loading ..."
                    );
                },
                success: (response) => {
                    Dashmix.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: response['message']
                    });
                    window.location.href = response['route'];
                },
                error: (xhr) => {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, messages) {
                            let input = $(`[name="${key}"]`);
                            if (input.length) {
                                input.addClass("is-invalid");

                                // khusus untuk input-group (password)
                                if (input.closest(".input-group").length) {
                                    input.closest(".input-group")
                                        .after(
                                            `<div class="invalid-feedback d-block">${messages[0]}</div>`
                                        );
                                } else {
                                    input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                                }
                            }
                        });
                    } else {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: xhr.responseText
                        });
                    }
                },
                complete: () => {
                    $("#btn_register").prop("disabled", false).html(
                        '<i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Register'
                    );
                }
            });
        }
    </script>
</body>

</html>
