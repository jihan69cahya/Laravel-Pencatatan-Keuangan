@extends('layouts_admin.master')
@section('title', 'Profile Pengguna')
@section('page-title', 'Profile')
@section('breadcrumb', 'Profile')

@section('contents')
    <div class="rounded border overflow-hidden push">
        <div class="bg-image pt-9" style="background-image: url('assets/media/photos/photo19@2x.jpg');"></div>
        <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
            <a class="d-block img-link mt-n5" href="{{ asset('assets') }}/media/avatars/profile.png" target="_blank">
                <img class="img-avatar img-avatar128 img-avatar-thumb" src="{{ asset('assets') }}/media/avatars/profile.png"
                    alt="">
            </a>
            <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
                <h1 class="fs-4 fw-bold mb-1">{{ $user['name'] }}</h1>
                <h2 class="fs-sm fw-medium text-muted mb-0">
                    Edit Profile
                </h2>
            </div>
            <div class="space-x-1">
                <a href="{{ route('dashboard.pengguna') }}" class="btn btn-sm btn-alt-secondary space-x-1">
                    <i class="fa fa-arrow-left opacity-50"></i>
                    <span>Kembali ke dashboard</span>
                </a>
            </div>
        </div>
    </div>

    <div class="block block-bordered block-rounded">
        <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
            <li class="nav-item">
                <button class="nav-link space-x-1 active" id="account-profile-tab" data-bs-toggle="tab"
                    data-bs-target="#account-profile" role="tab" aria-controls="account-profile" aria-selected="true">
                    <i class="fa fa-user-circle d-sm-none"></i>
                    <span class="d-none d-sm-inline">Profile</span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link space-x-1" id="account-password-tab" data-bs-toggle="tab"
                    data-bs-target="#account-password" role="tab" aria-controls="account-password"
                    aria-selected="false">
                    <i class="fa fa-asterisk d-sm-none"></i>
                    <span class="d-none d-sm-inline">Password</span>
                </button>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab"
                tabindex="0">
                <div class="row push p-sm-2 p-lg-4">
                    <div class="offset-xl-1 col-xl-4 order-xl-1">
                        <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                            Informasi penting akun Anda. Nama pengguna Anda akan terlihat oleh publik.
                        </p>
                    </div>
                    <div class="col-xl-6 order-xl-0">
                        <form class="js-validation-signin" action="{{ route('edit_profile') }}" method="POST"
                            onsubmit="submitUpdateProfile(event, $(this))">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-alt" id="name" name="name"
                                    placeholder="Masukkan nama lengkap anda.." value="{{ $user['name'] }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" class="form-control form-control-alt" id="email" name="email"
                                    placeholder="Masukkan email anda.." value="{{ $user['email'] }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="telp">No Telepon</label>
                                <input type="text" class="form-control form-control-alt number-only" id="telp"
                                    name="telp" placeholder="Masukkan nomor telepon aktif.." value="{{ $user['telp'] }}">
                            </div>
                            <button type="submit" class="btn btn-alt-primary" id="btn_edit_profile">
                                <i class="fa fa-check-circle opacity-50 me-1"></i> Update Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="account-password" role="tabpanel" aria-labelledby="account-password-tab"
                tabindex="0">
                <div class="row push p-sm-2 p-lg-4">
                    <div class="offset-xl-1 col-xl-4 order-xl-1">
                        <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                            Mengubah kata sandi masuk Anda adalah cara mudah untuk menjaga keamanan akun Anda.
                        </p>
                    </div>
                    <div class="col-xl-6 order-xl-0">
                        <form class="js-validation-signin" action="{{ route('edit_password') }}" method="POST"
                            onsubmit="submitUpdatePassword(event, $(this))">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="password_lama">Password Lama</label>
                                <input type="password" class="form-control form-control-alt" id="password_lama"
                                    name="password_lama">
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password">Password Baru</label>
                                    <input type="password" class="form-control form-control-alt" id="password"
                                        name="password">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control form-control-alt"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            <div class="mb-4">
                                <input type="checkbox" id="show_password" onclick="togglePassword()"> Tampilkan Password
                            </div>
                            <button type="submit" class="btn btn-alt-primary" id="btn_edit_password">
                                <i class="fa fa-check-circle opacity-50 me-1"></i> Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword() {
            const passwordFields = ['password_lama', 'password', 'password_confirmation'];
            passwordFields.forEach(id => {
                const field = document.getElementById(id);
                if (field.type === "password") {
                    field.type = "text";
                } else {
                    field.type = "password";
                }
            });
        }

        function ajaxFormWithConfirm(event, this_, options) {
            event.preventDefault();

            const {
                confirmTitle = "Apakah Anda yakin?",
                    confirmText = "",
                    confirmButtonText = "Ya, Lanjutkan!",
                    successTitle = "Berhasil!",
                    btnSelector,
                    btnText
            } = options;

            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(".is-invalid").removeClass("is-invalid");
                    $(".invalid-feedback").remove();

                    $.ajax({
                        url: this_.attr('action'),
                        type: this_.attr('method'),
                        data: this_.serialize(),
                        beforeSend: () => {
                            if (btnSelector) {
                                $(btnSelector).prop("disabled", true).html(
                                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div> Loading ..."
                                );
                            }
                        },
                        success: (response) => {
                            Swal.fire(successTitle, response['message'], 'success')
                                .then(() => window.location.reload());
                        },
                        error: (xhr) => {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, messages) {
                                    let input = $(`[name="${key}"]`);
                                    if (input.length) {
                                        input.addClass("is-invalid");
                                        if (input.closest(".input-group").length) {
                                            input.closest(".input-group")
                                                .after(
                                                    `<div class="invalid-feedback d-block">${messages[0]}</div>`
                                                );
                                        } else {
                                            input.after(
                                                `<div class="invalid-feedback">${messages[0]}</div>`
                                            );
                                        }
                                    }
                                });
                            } else {
                                Swal.fire('Gagal!', xhr.responseText, 'error');
                            }
                        },
                        complete: () => {
                            if (btnSelector && btnText) {
                                $(btnSelector).prop("disabled", false).html(btnText);
                            }
                        }
                    });
                }
            });
        }

        function submitUpdateProfile(event, this_) {
            ajaxFormWithConfirm(event, this_, {
                confirmText: "Data profile akan diupdate!",
                btnSelector: "#btn_edit_profile",
                btnText: '<i class="fa fa-check-circle opacity-50 me-1"></i> Update Profile'
            });
        }

        function submitUpdatePassword(event, this_) {
            ajaxFormWithConfirm(event, this_, {
                confirmText: "Password akan diupdate!",
                btnSelector: "#btn_edit_password",
                btnText: '<i class="fa fa-check-circle opacity-50 me-1"></i> Update Password'
            });
        }
    </script>
@endsection
