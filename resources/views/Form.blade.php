@extends('layouts.base')

@section('title', "Form Pengaduan Aspirasi")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('styles')
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }
    .main-menu {
        background-color: #0066CC;
        font-family: 'Open Sans', sans-serif;
    }
    .navbar {
        padding: 10px 20px;
        background: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 1);
        font-weight: bold;
        position: relative;
    }
    .navbar-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .navbar-btn {
        color: black;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 0px 40px;
        gap: 10px;
        white-space: nowrap;
    }
    .navbar-btn:hover {
        text-decoration: underline;
        color: #0066CC;
    }
    .selected-btn {
        color: #0066CC;
        text-decoration: underline;
        display: flex;
        align-items: center;
        padding: 0px 40px;
        gap: 10px;
        white-space: nowrap;
    }
    .login-btn {
        text-decoration: none;
        display: flex;
        align-items: center;
        color: black;
        gap: 10px;
    }
    .login-btn:hover {
        text-decoration: underline;
        color: #0066CC;
    }
    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }
    .form {
       background: radial-gradient(#DBEAFE 0%, #93C5FD 25%, #60A5FA 50%, #3B82F6 75%, #1D4ED8 100%);
       /* background-color: #0066CC; */
       background-repeat: no-repeat;
       background-size: 100%, cover;
       background-position: top center;
       height: 90.5vh;
       display: flex;
       align-items: center;
    }
    .form-container {
        text-align: left;
        background: white;
        max-width: 1040px;
        width: 100%;
        overflow: hidden;
        border-radius: 20px;
        margin: 0px auto;
        color: black;
        padding-bottom: 20px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 1);
    }
    .form-header {
        text-align: center;
        background: darkblue;
        color: lightblue;
        padding: 5px;
        text-shadow: 2px 2px 3px black;
        margin-bottom: 20px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 1);
    }
    .form-items {
        display: grid;
        grid-template-columns: 100px 20px 1fr;
        padding: 10px;
        align-items: center;
        text-align: left;
    }
    .swal2-popup, .swal2-confirm, .swal2-cancel {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
    }
    .swal2-input {
        border-radius: 10px;
    }
    .form-text {
        margin-left: 10px;
        font-size: 20px;
    }
    .form-value {
        width: 98%;
        border: solid grey;
        border-radius: 10px;
        padding: 10px;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        box-sizing: border-box;
    }
    .form-value:disabled {
        background-color: lightgrey;
    }
    .checkbox-items {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 10px;
    }
    .bersedia-checkbox {
        cursor: pointer;
        appearance: none;
        border-radius: 5px;
        border: 3px solid grey;
        text-align: left;
        width: 22px;
        height: 22px;
        margin-left: 20px;
        top: 2px;
        position: relative;
        transition: all 0.2s ease-in-out;
        font-family: 'Open Sans', 'sans-serif';
    }
    .bersedia-checkbox:checked {
        background-color: darkblue;
        border: none;
    }
    .bersedia-checkbox:checked::after {
        text-align: center;
        content: "✓";
        position: absolute;
        left: 4px;
        bottom: 0.5px;
        font-size: 18px;
        color: lightblue
    }
    .btn-send {
        background: lightblue;
        color: darkblue;
        font-weight: bold;
        text-decoration: none;
        padding: 10px;
        margin-top: 10px;
        border-radius: 10px;
        border: 3px solid darkblue;
        margin-right: 30vw;
    }
    .btn-send:hover {
        background: darkblue;
        color: lightblue;
    }
    .panduan {
        display: flex;
        align-items: center;
        gap: 15px;
        color: black;
        font-size: 15px;
        text-decoration: none;
        cursor: pointer;
        margin-top: 10px;
        background: none;
        border: none;
    }
    .panduan:hover {
        text-decoration: underline;
        color: #0066CC;
    }
    .panduan-items {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .panduan-icon {
        width: 30px;
        margin-left: 20px;
    }
    .form-buttons {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
    textarea {
        resize: vertical;
    }
    footer {
        background-color: darkblue;
        color: #ffd700;
        border-top: 3px solid lightblue;
        padding: 10px;
        padding-top: 30px;
    }
    .footer-elements {
        display: grid;
        gap: 65px;
        flex-direction: column;
        grid-template-columns: repeat(3, 1fr);
        align-items: center;
    }
    .footer-elements > .footer-items.kontak {
        align-self: start;
    }
    .footer-items a {
        text-decoration: none;
        color: lightblue;
    }
    .footer-items a:hover {
        text-decoration: underline;
        color: turquoise;
    }
    footer hr {
        border-color: #FFD700;
    }
    .copyright {
        text-align: center;
        margin: 0;
        padding: 15px 0;
    }
    .footer-contacts {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
    }
    .system-logo {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .system-title {
        font-size: 20px;
        font-weight: bold;
    }
    .logo-footer {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: bold;
        justify-content: center;
        font-size: 30px;
    }

    @media(max-width: 1024px) {
        .navbar {
            flex-wrap: wrap;
            gap: 12px;
            padding: 10px 14px;
        }
        .navbar-wrap {
            width: 100%;
            order: 3;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .navbar-btn, .selected-btn {
            padding: 0 14px;
            font-size: 14px;
        }
        .form {
            height: auto;
            min-height: calc(100vh - 90px);
            padding: 20px 12px;
            box-sizing: border-box;
        }
        .form-items {
            grid-template-columns: 90px 16px 1fr;
        }
        .btn-send {
            margin-right: 0;
        }
        .footer-elements {
            gap: 30px;
        }
    }

    @media(max-width: 768px) {
        .logo img {
            width: 40px !important;
        }
        .logo div {
            font-size: 13px;
        }
        .login-btn {
            font-size: 14px;
        }
        .login-btn img {
            width: 22px !important;
        }
        .navbar-btn img, .selected-btn img {
            width: 22px !important;
        }
        .navbar-btn, .selected-btn {
            font-size: 13px;
            padding: 0 12px;
            gap: 6px;
        }
        .form {
            min-height: auto;
            padding: 16px 10px;
        }
        .form-container {
            border-radius: 14px;
        }
        .form-header h1 {
            font-size: 28px;
        }
        .form-header h3 {
            font-size: 18px;
        }
        .form-items {
            grid-template-columns: 1fr;
            gap: 6px;
            padding: 8px 12px;
        }
        .form-text {
            margin-left: 0;
            font-size: 16px;
        }
        .titik-dua {
            display: none;
        }
        .form-value {
            width: 100%;
        }
        .checkbox-items {
            align-items: flex-start;
            padding: 0 12px;
        }
        .bersedia-checkbox {
            margin-left: 0;
            margin-top: 2px;
        }
        .form-buttons {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 0 12px;
        }
        .panduan-icon {
            margin-left: 0;
        }
        .footer-elements {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .footer-items {
            text-align: center;
        }
        .footer-items.kontak {
            align-items: center !important;
        }
        .system-logo {
            justify-content: center;
        }
        .footer-contacts {
            justify-content: center;
        }
    }

    @media(max-width: 600px) {
        .navbar {
            padding: 8px 10px;
            gap: 8px;
        }
        .logo div {
            font-size: 11px;
        }
        .navbar-wrap {
            gap: 0;
        }
        .form {
            padding: 12px 8px;
        }
        .form-header h1 {
            font-size: 22px;
        }
        .form-header h3 {
            font-size: 14px;
        }
        .form-value {
            font-size: 14px;
            padding: 8px;
        }
        .checkbox-text {
            font-size: 13px;
        }
        .btn-send {
            font-size: 14px;
            padding: 8px 12px;
        }
        .logo-footer {
            font-size: 22px;
        }
        .logo-footer img {
            width: 70px !important;
        }
    }

    @media(max-width: 480px) {
        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .navbar-btn {
            margin-left: 0;
            margin-right: 0;
            font-size: 10px;
            padding: 0 10px;
        }
        .selected-btn {
            padding: 0 10px;
            font-size: 10px;
        }
        .login-btn {
            /* margin-right: 5px; */
            font-size: 10px;
        }
        .navbar {
            padding: 5px 8px;
        }
        .main-menu {
            width: 100%;
        }
        .form {
            padding: 10px 6px;
        }
        .form-container {
            width: 95%;
            box-sizing: border-box;
        }
        .form-header h1 {
            font-size: 20px;
        }
        .form-header h3 {
            font-size: 14px;
        }
        .form-items {
            padding: 6px 10px;
        }
        .form-text {
            font-size: 14px;
        }
        .form-value {
            font-size: 12px;
            padding: 7px;
        }
        .bersedia-checkbox {
            width: 18px;
            height: 18px;
        }
        .bersedia-checkbox:checked::after {
            left: 3px;
            font-size: 14px;
        }
        .checkbox-text {
            font-size: 12px;
        }
        .panduan {
            font-size: 13px;
        }
        .btn-send {
            font-size: 12px;
        }
        .footer-elements {
            display: block;
        }
        .footer-items {
            margin: 10px auto;
        }
        .copyright {
            font-size: 13px;
        }
    }
@endsection

@section('content')

<div class="main-menu">
    <div class="navbar">
        <span class="logo">
            <img src="icons/KomisiAdvokasi.png" style="width: 50px;">
            <span>
                <div>Komisi Advokasi</div>
                <div>BPMF FTI UKSW</div>
            </span>
        </span>
        <span class="navbar-wrap">
            <a href="/advo" class="navbar-btn">
                <img src="icons/Beranda.png" style="width: 30px;">
                <span>Beranda</span>
            </a>
            <div class="selected-btn">
                <img src="icons/Form.png" style="width: 30px;">
                <span>Form Aspirasi</span>
            </div>
            <a href="/struktur" class="navbar-btn">
                <img src="icons/Struktur.png" style="width: 30px;">
                <span>Struktur Organisasi</span>
            </a>
            <a href="/faq" class="navbar-btn">
                <img src="icons/FAQ.png" style="width: 30px;">
                <span>FAQ</span>
            </a>
            <a href="#" class="navbar-btn" id="trackAspirasiBtn">
                <img src="icons/Lacak.png" style="width: 30px;">
                <span>Lacak Aspirasi</span>
            </a>
        </span>
        <span class="login-btn">
            <a href="/login" class="login-btn">
                <img src="icons/Login.png" style="width: 30px;">
                Login
            </a>
        </span>
    </div>
    <form action="/proses-aspirasi" method="post" id="aspirasiForm">
        @csrf
        <input type="hidden" name="tracking_code" id="tracking_code">
        <div class="form">
            <div class="form-container">
                <div class="form-header">
                    <h1>Form Pengaduan Aspirasi</h1>
                    <h3>Punya keluhan? Boleh banget nih isi aspirasi kalian di sini!</h3>
                </div>
                <div class="form-body">
                    <div class="form-items">
                        <div class="form-text">Nama</div>
                        <div class="titik-dua">:</div>
                        <input type="text" name="nama" class="form-value" id="nama" placeholder="Nama boleh anonim atau kosong">
                    </div>
                    <div class="form-items" id="formNIM" style="display: none;">
                        <div class="form-text">NIM</div>
                        <div class="titik-dua">:</div>
                        <input type="text" name="nim" class="form-value" id="nim" maxlength="9" disabled>
                    </div>
                    <div class="form-items">
                        <div class="form-text">Kategori</div>
                        <div class="titik-dua">:</div>
                        <select class="form-value" name="kategori" id="kategori">
                            <option value="" selected disabled hidden>Pilih kategori</option>
                            @foreach($kategori as $items)
                                <option value="{{ $items->id_kategori }}">{{ $items->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-items">
                        <div class="form-text">Deskripsi</div>
                        <div class="titik-dua">:</div>
                        <textarea class="form-value" name="aspirasi" id="aspirasi"></textarea>
                    </div>
                    <div class="checkbox-items">
                        <span class="bersedia-checbox"><input type="checkbox" class="bersedia-checkbox" name="bersedia" id="bersedia"></span>
                        <span class="checkbox-text">Saya bersedia dihubungi oleh pihak Advokasi apabila dibutuhkan tindak lanjut atas aspirasi ini.</span>
                    </div>
                </div>
                <div class="form-buttons">
                    <a href="#" class="panduan" id="panduan">
                        <img src="icons/Panduan.png" class="panduan-icon">
                        Lihat panduan beraspirasi
                    </a>
                    <a href="#" type="button" class="btn-send" id="submitAspirasi">Suarakan</a>
                </div>
            </div>
        </div>
    </form>
    <footer>
        <div class="footer-elements">
            <div class="footer-items">
                <span class="logo-footer">
                    <img src="icons/KomisiAdvokasi.png" style="width: 100px;">
                    <span>
                        <div>Komisi Advokasi</div>
                        <div>BPMF FTI UKSW</div>
                    </span>
                </span>
            </div>
            <div class="footer-items">
                <span class="system-logo">
                    <img src="icons/Sistem.png" style="width: 30px;">
                    <div class="system-title">Tentang Sistem</div>
                </span><br>
                <div>Sistem ini membantu mahasiswa FTI UKSW dalam menampung dan menyalurkan aspirasi mereka.</div><br>
                <div>Jadi, tunggu apa lagi? Ayo, salurkan aspirasimu di <a href="/form">sini</a>.</div><br>
                <div>Pastikan telah membaca <a href="/faq">FAQ</a> sebelum beraspirasi untuk menghindari pengajuan aspirasi yang berulang.</div>
            </div>
            <div class="footer-items kontak" style="display: flex; flex-direction: column !important; align-items: flex-start;">
                <div>Atau jika butuh bantuan lebih lanjut, hubungi kami di:</div>
                <a href="https://instagram.com/advokasibpmffti" class="footer-contacts">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" width="25px">
                    @advokasibpmffti
                </a>
                <a href="mailto:komad.fti@student.uksw.edu" class="footer-contacts">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Gmail_icon_%282020%29.svg/1280px-Gmail_icon_%282020%29.svg.png" width="25px">
                    komad.fti@student.uksw.edu
                </a>
            </div>
        </div>
        <br><hr>
        <p class="copyright">&copy 2026 | Komisi Advokasi BPMF FTI UKSW | All rights reserved</p>
    </footer>
</div>

@endsection

@section('scripts')
<script>
    function nl2brSafe(value) {
        return String(value ?? '-')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\r?\n/g, '<br>');
    }

    let fromKat = false;
    const kategoriPelayanan = 'KAT5';
    $('#kategori').on('change', function() {
        const selectedKat = $(this).val();

        fromKat = true;
        if(selectedKat === kategoriPelayanan) {
            if(!$('#bersedia').is(':checked')) {
                $('#bersedia').prop('checked',true).trigger('change');
            }
        }
        fromKat = false;
    });
    $('#bersedia').on('change', function(e) {
        e.preventDefault();
        if($(this).is(':checked')) {
            $('#formNIM').show();
            $('#nim').prop('disabled', false).attr('placeholder', 'Sesuaikan NIM dengan nama Anda');
            $('#nama').attr('placeholder','Gunakan nama asli').val('');
        } else {
            $('#formNIM').hide();
            $('#nim').prop('disabled', true).attr('placeholder', '');
            $('#nama').attr('placeholder','Nama boleh anonim atau kosong');
        }
    });

    $('#panduan').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Panduan Beraspirasi',
            html: `
                <div style="text-align: justify;">
                    Halo guys! Berikut ini adalah beberapa hal yang harus diperhatikan saat mau beraspirasi.<br>
                    <ol>
                        <li>Kategori dan Deskripsi wajib diisi, karena ini adalah inti sebuah aspirasi.</li><br>
                        <li>Nama diperbolehkan anonim atau kosong. NIM juga tidak perlu diisi.</li><br>
                        <li>Dengan mencentang checkbox, teman-teman dinyatakan bersedia untuk dihubungi apabila ada tindak lanjut. Maka dari itu, teman-teman wajib mengisi nama asli, dan mengisi NIM yang sesuai.</li><br>
                        <li>Perlu diperhatikan... Apabila terdapat ketidakcocokan NIM dan nama, maka aspirasi yang dimasukkan dianggap TIDAK VALID, dan Komisi Advokasi berhak menolak aspirasi yang teman-teman suarakan.</li><br>
                        <li>Pastikan semua data yang dimasukkan sudah benar sebelum menekan tombol "Suarakan".</li><br>
                    </ol>
                </div>`,
            width: '600px',
            confirmButtonText: 'Mengerti'
        });
    });

    $('#submitAspirasi').on('click', function(e) {
        e.preventDefault();

        if($('#bersedia').is(':checked')) {
            validateInput();
        } else {
            if($('#kategori').val() && $('#aspirasi').val()) {
                limitAspirasi();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Isi semua field untuk lanjut.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }
    });

    $('#trackAspirasiBtn').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Lacak Aspirasi',
            input: 'text',
            inputLabel: 'Masukkan kode pelacakan',
            inputPlaceholder: 'Contoh: A1B2C3D4E',
            showCancelButton: true,
            confirmButtonText: 'Lacak',
            cancelButtonText: 'Batal'
        }).then(result => {
            if(!result.isConfirmed) return;

            const code = (result.value || '').trim();
            if(!code) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kode Kosong',
                    text: 'Masukkan kode pelacakan terlebih dahulu.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            fetch('/track-aspirasi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ tracking_code: code })
            }).then(response => response.json())
            .then(data => {
                if(!data.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Ditemukan',
                        text: data.message || 'Kode pelacakan tidak ditemukan.',
                        showConfirmButton: false,
                        timer: 1800
                    });
                    return;
                }

                const info = data.data || {};
                const tanggapan = info.tanggapan ? info.tanggapan : 'Belum ada tanggapan.';
                Swal.fire({
                    icon: 'info',
                    title: 'Detail Aspirasi',
                    html: `
                        <div style="text-align: left;">
                            <div><b>Kategori:</b> ${info.kategori || '-'}</div>
                            <div><b>Status:</b> ${info.status || '-'}</div>
                            <div><b>Dikirim:</b> ${info.created_at || '-'}</div>
                            <hr>
                            <div><b>Deskripsi:</b><br>${nl2brSafe(info.aspirasi || '-')}</div>
                            <hr>
                            <div><b>Tanggapan:</b><br>${nl2brSafe(tanggapan)}</div>
                        </div>
                    `,
                    confirmButtonText: 'Tutup'
                });
            }).catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal melacak aspirasi.',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    });

    function submitWithTracking() {
        fetch('/generate-tracking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({})
        }).then(response => response.json())
        .then(data => {
            if(!data.success) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Membuat Kode',
                    text: 'Coba lagi beberapa saat.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            $('#tracking_code').val(data.tracking_code);
            Swal.fire({
                icon: 'info',
                title: 'Kode Pelacakan Aspirasi',
                html: `
                    <div style="text-align: center;">
                        <div style="font-size: 15px; margin-bottom: 10px;">Simpan kode ini baik-baik. Kode hanya tampil sekali.</div>
                        <div style="font-size: 24px; font-weight: bold; letter-spacing: 2px;">${data.tracking_code}</div>
                    </div>
                `,
                confirmButtonText: 'OK, Kirim Aspirasi',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then(result => {
                if(result.isConfirmed) {
                    $('#aspirasiForm').submit();
                }
            });
        }).catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Tidak bisa membuat kode pelacakan.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    function validateNIM() {
        const nim = $('#nim').val();
        fetch('{{ route("validateNIM") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({nim: nim})
        }).then(response => response.json())
        .then(data => {
            if(data.success) {
                limitAspirasi();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'NIM Tidak Valid',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }
        });
        return true;
    }

    function validateInput() {
        if(!$('#nama').val() || !$('#kategori').val() || !$('#aspirasi')) {
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Lengkap',
                text: 'Isi semua field untuk lanjut',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } else {
            validateNIM();
        }
    }

    function limitAspirasi() {
        fetch('{{ route("checkLimit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nim: $('#bersedia').is(':checked') ? $('#nim').val() : null
            })
        }).then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    'icon': 'error',
                    'title': data.messageTitle,
                    'text': data.messageText,
                    'confirmButtonText': 'Baiklah'
                });
                return;
            } else {
                submitWithTracking();
            }
        }).catch(() => {
            Swal.fire({
                'icon': 'error',
                'title': 'Terjadi Kesalahan',
                'text': 'Tidak dapat melimitasi aspirasi',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
</script>
@endsection
