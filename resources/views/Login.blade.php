@extends('layouts.base')

@section('title', "Login as Minvo")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('styles')
    html, body {
        height: 100%;
        padding: 0;
        box-sizing: border-box;
        margin: 0;
        scroll-behavior: smooth;
        background-color: #0066CC;
    }
    .login {
        background: linear-gradient(to bottom, transparent 0%, #0066CC 100%), url('FTI.jpg');
        background-repeat: no-repeat;
        background-size: 100%, cover;
        background-position: top center;
        color: #ffd700;
        font-family: 'Open Sans', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
    }
    .login-container {
        background: white;
        max-width: 1000px;
        width: 100%;
        border-radius: 20px;
        margin: 0px auto;
        padding: 20px;
        color: black;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 1);
        /* border: 5px solid black; */
    }
    .user-items {
        display: grid;
        grid-template-columns: 100px 20px 1fr;
        padding: 10px;
        align-items: center;
        text-align: left;
        font-size: 18px;
    }
    [hidden] {
        display: none;
    }
    .user-text {
        margin-left: 10px;
    }
    .user-value {
        width: 98%;
        border: solid grey;
        border-radius: 10px;
        padding: 5px;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        box-sizing: border-box;
        appearance: none;
    }
    .user-value:disabled {
        background-color: lightgrey;
    }
    .btn-login {
        background: linear-gradient(to bottom, darkblue 0%, blue 100%);
        color: white;
        text-decoration: none;
        padding: 15px;
        margin-top: 10px;
        border-radius: 10px;
        margin-left: 20px;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 20px;
        font-weight: bold;
        width: 190px;
        cursor: pointer;
        text-shadow: 1px 2px 3px black;
    }
    .btn-login:hover {
        background: radial-gradient(lightblue 0%, darkblue 100%);
    }
    .swal2-popup, .swal2-input, .swal2-confirm, .swal2-cancel {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 10px;
    }
    .logoBack {
        align-items: top;
        display: flex;
        justify-content: space-between;
    }
    .back-btn {
        border-radius: 10px;
        text-decoration: none;
        padding: 5px 10px;
        font-weight: bold;
        font-size: 20px;
        background: lightblue;
        color: darkblue;
        border: 2px solid darkblue;
    }
    .logo {
        width: 150px;
        margin-right: 28vw;
    }
    .swal2-popup {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
    }
    .auth-buttons {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        align-items: center;
        gap: 20px;
    }
    .lupa {
        border: none;
        font-family: 'Open Sans', 'sans-serif';
        background: none;
        cursor: pointer;
        font-size: 15px;
    }
    .lupa:hover {
        text-decoration: underline;
        color: #0066CC;
    }

    @media(max-width: 600px) {
        .login {
            display: flex;
            align-items: center;
        }
        .back-btn {
            font-size: 10px;
        }
        .logo {
            width: 100px;
            margin-right: 140px;
        }
        .login-container {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
        }
        .user-items {
            padding: 10px 0;
        }
        h1 {
            font-size: 25px;
        }
        h4 {
            font-size: 10px;
        }
        .user-value {
            font-size: 11px;
        }
        .btn-login {
            margin-left: 5px;
            font-size: 10px;
            padding: 8px;
        }
    }
@endsection

@section('content')
<form action="/validate-user" id="loginForm" method="post">
    @csrf
    <div class="login">
        <div class="login-container">
            <div class="logoBack">
                <span><a href="/advo" class="back-btn">⮌</a></span>
                <span><img src="icons/KomisiAdvokasi.png" class="logo"></span>
            </div>
            <div style="text-align: center;">
                <h1>Login as Admin</h1>
                <h4>Mau login sebagai Admin? Mari verifikasi dirimu.</h4>
            </div>
            <div class="user-items">
                <span class="user-text">NIM</span>
                <span>:</span>
                <input type="text" name="nim" id="nim" maxlength="9" class="user-value" placeholder="Masukkan NIM">
            </div>
            <div class="user-items">
                <span class="user-text">Nama</span>
                <span>:</span>
                <input type="text" name="nama" id="nama" class="user-value" disabled placeholder="Nama akan muncul secara otomatis">
            </div>
            <div class="user-items" id="passwordRow" hidden>
                <span class="user-text">Password</span>
                <span>:</span>
                <input type="password" name="password" id="password" class="user-value" placeholder="Masukkan password">
            </div>
            <div class="auth-buttons">
                <button type="button" class="lupa">Lupa Password?</button>
                <button type=submit id="btn-login" class="btn-login">LOGIN</button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    $('#nim').on('blur keydown',function(e) {
        if(e.type === 'blur' || e.key === 'Enter') {
            e.preventDefault();
            const nim = $(this).val().trim();
            checkNIM(nim);
        }
    });

    $('#password').on('keydown',function(e) {
        if(e.type === 'Enter') {
            e.preventDefault();
            const nim = $('#nim').val().trim();
            const password = $(this).val().trim();
            validateUser(nim, password);
        }
    });

    $('#btn-login').on('click',function(e) {
        e.preventDefault();
        const nim = $('#nim').val().trim();
        const password = $('#password').val().trim();
        if(!nim) {
            Swal.fire({
                icon: 'error',
                title: 'NIM Kosong',
                text: 'Isi NIM untuk lanjut',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } else if(!password) {
            Swal.fire({
                icon: 'error',
                title: 'Password Kosong',
                text: 'Isi password untuk lanjut',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } else if(!nim && !password) {
            Swal.fire({
                title: 'NIM dan Password Kosong',
                text: 'Isi NIM dan passwod untuk lanjut',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } else {
            validateUser(nim, password);
        }
    });

    function checkNIM(nim) {
        if(nim === '') {
            Swal.fire({
                icon: 'error',
                title: 'NIM Kosong',
                text: 'Masukkan NIM untuk lanjut',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        fetch('{{ route("check-nim") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({nim: nim})
        }).then(response => {
            if(!response.ok) {
                throw new Error('NIM tidak ditemukan.');
            } else {
                return response.json();
            }
        }).then(data => {
            //Tampilkan data nama dan jabatan jika NIM ada di database
            if(data.success) {
                $('#nama').val(data.nama).prop('disabled',false).prop('readonly',true);
                $('#jabatan').val(data.jabatan).prop('disabled',false).prop('readonly',true);
                $('#passwordRow').prop('hidden',false);
            } else {
                //Hapus semua data nama dan jabatan jika NIM tidak ada di database
                Swal.fire({
                    icon: 'error',
                    title: 'NIM Tidak Ditemukan',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#nama').val('').prop('disabled',true).prop('readonly',false);
                $('#jabatan').val('').prop('disabled',true).prop('readonly',false);
                $('#passwordRow').prop('hidden',true);
            }
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'NIM gagal diproses',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    function validateUser(nim, password) {
        fetch('{{ route("validate-user") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({nim: nim, password: password})
        }).then(response => {
            console.log("RESPONSE JSON: ",response.status);
            console.log("RESPONSE OK: ", response.ok);
            return response.json();
        }).then(data => {
            if(data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: 'Selamat datang, ' + data.panggilan + '!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    console.log("Redirecting to: ", data.redirect);
                    window.location.href = data.redirect;
                });
            } else if(data.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: data.error,
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }).catch(error => {
            console.error("ERROR: ", error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal Memproses Data User',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    $('.lupa').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Masukkan NIM untuk diverifikasi',
            html:  `
                <style>
                    .goToken {
                        text-decoration: none;
                        color: darkblue;
                    }
                    .goToken:hover {
                        text-decoration: underline;
                        color: blue;
                    }
                </style>
                <div style="margin-top: 10px;">
                    Sudah dapat token? <a href="#" class="goToken">Klik di sini</a>
                </div>
            `,
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal'
        }).then(result => {
            if(!result.isConfirmed) return;
            const nim = result.value;
            if(!nim) {
                Swal.fire({
                    icon: 'error',
                    title: 'NIM Kosong',
                    text: 'Isi NIM untuk lanjut',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            Swal.fire({
                title: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route("forgetPassword") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({nim: nim})
            }).then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.messageTitle,
                        text: data.messageText,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.messageTitle,
                        text: data.messageText,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memverifikasi NIM',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            });
        });
    });

    $(document).on('click', '.goToken', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Masukkan token yang telah diberikan',
            input: 'text',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal'
        }).then(result => {
            if(!result.isConfirmed) return;
    
            const token = result.value;
            if(!token) {
                Swal.fire({
                    icon: 'error',
                    title: 'Token Kosong',
                    text: 'Isi token untuk lanjut',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            Swal.fire({
                title: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route("validateToken") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({token: token})
            }).then(response => response.json())
            .then(data => {
                if(!data.success) {
                    Swal.fire({
                        icon: 'error',
                        title: data.messageTitle,
                        text: data.messageText,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                openResetPasswordModal(token);
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memverifikasi token',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            });
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memproses token',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        });
    });

    function openResetPasswordModal(token) {
        Swal.fire({
            title: 'Reset Password',
            html: `
                <label for="newPassword" style="display:block; text-align:left; margin:0 0 6px 40px;">
                    Password Baru
                </label>
                <input type="password" id="newPassword" class="swal2-input" style="width: 400px;" placeholder="Password Baru">
                <label for="confirmPassword" style="display:block; text-align:left; margin:8px 0 6px 40px;">
                    Konfirmasi Password
                </label>
                <input type="password" id="confirmPassword" class="swal2-input" style="width: 400px;" placeholder="Konfirmasi Password">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Reset Password',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const password = document.getElementById('newPassword').value.trim();
                const confirmPassword = document.getElementById('confirmPassword').value.trim();

                if(!password || !confirmPassword) {
                    Swal.showValidationMessage('Password dan konfirmasi password wajib diisi');
                    return false;
                }

                if(password !== confirmPassword) {
                    Swal.showValidationMessage('Konfirmasi password tidak cocok');
                    return false;
                }

                return { token, password, confirmPassword };
            }
        }).then(result => {
            if(!result.isConfirmed) return;

            const {password, confirmPassword} = result.value;

            Swal.fire({
                title: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route("resetPassword") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({token: token, password: password, confirmPassword: confirmPassword})
            }).then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.messageTitle,
                        text: data.messageText,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal mengubah password',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            });
        });
    }
</script>
@endsection
