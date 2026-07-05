@extends('layouts.base')

@section('title', "Komisi Advokasi BPMF FTI UKSW")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
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
        /* background-color: #0066CC; */
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
    .beranda-container {
        background: linear-gradient(to bottom, transparent 0%, #0066CC 100%), url('https://fti.uksw.edu/images/2018/03/06/sample_helix_header_21.jpg');
        background-repeat: no-repeat;
        background-size: 100%, cover;
        color: black;
        height: 90.5vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        color: white;
        text-shadow: 2px 3px 3px black;
    }
    .beranda-title, .beranda-tagline {
        font-weight: bold;
    }
    .beranda-title {
        font-size: 50px;
        text-align: center;
    }
    .beranda-tagline {
        font-size: 30px;
        text-align: center;
    }
    .btn-aspirasi {
        background: darkblue;
        color: lightblue;
        text-decoration: none;
        padding: 10px;
        border-radius: 10px;
        font-weight: bold;
        font-size: 30px;
        text-shadow: none;
        transition: all 0.3s ease;
    }
    .btn-aspirasi:hover {
        background-color: lightblue;
        color: darkblue;
        box-shadow: 2px 2px 3px rgba(0, 0, 0, 1);
    }
    .struktur-header {
        text-align: center;
        background: #E32636;
        color: #ffd700;
        padding: 5px;
        margin-bottom: 20px;
    }
    .swal2-popup, .swal2-confirm, .swal2-cancel {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
    }
    .swal2-input {
        border-radius: 10px;
    }
    footer {
        /* margin-top: 15px; */
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
    .statistik-container {
        padding: 40px 20px;
        background: linear-gradient(to bottom, #0066CC 0%, #0F2B4D 100%);
        color: white;
    }

    .statistik-card {
        max-width: 1200px;
        margin: 0 auto;
        background: linear-gradient(to bottom right, steelblue 0%, skyblue 50%, lightblue 100%);
        border: 2px solid black;
        border-radius: 24px;
        padding: 24px;
        box-sizing: border-box;
    }

    .statistik-title {
        margin: 0 0 16px 0;
        text-align: center;
        font-size: 30px;
        color: #0F172A;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
        font-weight: 700;
    }

    .statistik-table-wrap {
        width: 100%;
        margin: 0 auto;
        overflow-x: visible;
    }

    .table-advokasi {
        width: 100%;
        border-collapse: collapse;
        border: none !important;
        min-width: 700px;
    }

    .table-advokasi thead {
        background-color: darkblue;
        color: lightblue;
    }

    .table-advokasi thead th {
        text-align: center;
        padding: 10px;
    }

    .table-advokasi tbody td {
        color: #0B2E59;
        padding: 10px;
        vertical-align: top;
    }

    .table-advokasi tbody tr:nth-child(odd) td {
        background-color: #CFE8FF;
    }

    .table-advokasi tbody tr:nth-child(even) td {
        background-color: #A9D4FF;
    }
    table.dataTable thead th {
        text-align: center;
    }
    .dataTables_filter {
        margin-bottom: 5px;
    }
    .dataTables_filter input {
        font-family: 'Open Sans', 'sans-serif';
    }
    .dataTables_wrapper {
        color: #0B2E59 !important;
        font-family: 'Open Sans', sans-serif;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_info {
        color: #0B2E59 !important;
        font-weight: 700;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        background-color: #ffffff !important;
        color: #0F172A !important;
        border: 1px solid #0F172A !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
        outline: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #0B2E59 !important;
        border: 1px solid #0B2E59 !important;
        background: transparent !important;
        border-radius: 8px !important;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: lightblue !important;
        background: darkblue !important;
        border-color: darkblue !important;
    }

    .empty-data {
        color: #0B2E59;
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        padding: 30px 10px 10px;
    }
    th, td {
        border-collapse: collapse;
        border-width: 0px;
        border-color: #0066CC;
        border-left: none;
        border-right: none;
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
        .beranda-container {
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }
        .beranda-title {
            font-size: 40px;
        }
        .beranda-tagline {
            font-size: 24px;
        }
        .btn-aspirasi {
            font-size: 22px;
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
        .beranda-container {
            height: auto;
            min-height: 70vh;
            gap: 20px;
        }
        .beranda-container img {
            width: 140px !important;
        }
        .beranda-title {
            font-size: 30px;
        }
        .beranda-tagline {
            font-size: 20px;
        }
        .btn-aspirasi {
            font-size: 18px;
        }
        .statistik-container {
            padding: 28px 12px;
        }
        .statistik-card {
            padding: 14px;
            border-radius: 14px;
        }
        .statistik-title {
            font-size: 22px;
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
        .beranda-title {
            font-size: 24px;
        }
        .beranda-tagline {
            font-size: 16px;
        }
        .btn-aspirasi {
            font-size: 16px;
            padding: 8px 12px;
        }
        .statistik-title {
            font-size: 18px;
        }
        .table-advokasi thead th,
        .table-advokasi tbody td {
            font-size: 13px;
            padding: 8px;
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
        .beranda-container, .form-container, .struktur-container {
            width: 100%;
            box-sizing: border-box;
        }
        .beranda-container h1 {
            font-size: 20px;
        }
        .form-header h1, .struktur-header h1 {
            font-size: 20px;
        }
        .form-header h3, .struktur-header h3 {
            font-size: 16px;
        }
        .beranda-container h4 {
            font-size: 14px;
        }
        .beranda-title {
            font-size: 20px;
        }
        .beranda-tagline {
            font-size: 14px;
        }
        .beranda-container p {
            font-size: 11px;
        }
        .beranda-container img {
            width: 100px !important;
        }
        .btn-aspirasi {
            font-size: 13px;
        }
        .form-text, .titik-dua {
            font-size: 15px;
        }
        .form-value {
            font-size: 10px;
            padding: 5px;
            border-radius: 7px;
        }
        .bersedia-checkbox {
            width: 18px;
            height: 18px;
        }
        .bersedia-checkbox:checked::after {
            font-size: 14px;
        }
        .checkbox-text {
            font-size: 12px;
        }
        .panduan {
            font-size: 13px;
        }
        .btn-send {
            margin-left: 95px;
            font-size: 10px;
        }
        table {
            margin: 0 10px;
        }
        table img {
            width: 50px;
        }
        footer h2 {
            font-size: 22px;
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
            <div class="selected-btn">
                <img src="icons/Beranda.png" style="width: 30px;">
                <span>Beranda</span>
            </div>
            <a href="/form" class="navbar-btn">
                <img src="icons/Form.png" style="width: 30px;">
                <span>Form Aspirasi</span>
            </a>
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
    <div class="beranda-container">
        <img src="icons/KomisiAdvokasi.png" style="width: 200px;">
        <div class="beranda-title">Komisi Advokasi BPMF FTI UKSW</div>
        <div class="beranda-tagline">Aspirasi kalian adalah napas bagi kami.</div>
        <div style="font-size: 20px;">Selamat datang di website Komisi Advokasi BPMF FTI UKSW! Di sini, teman-teman bebas beraspirasi apapun seputar perkuliahan di lingkungan FTI UKSW.</div>
        <a href="/form" class="btn-aspirasi">Suarakan aspirasi</a>
    </div>
    <div class="statistik-container">
        <div class="statistik-card">
            <h2 class="statistik-title">Daftar Aspirasi yang Sudah Diselesaikan</h2>
            <div class="statistik-table-wrap">
                @if($aspirasi->isEmpty())
                    <div class="empty-data">Belum ada aspirasi yang diselesaikan.</div>
                @else
                    <table class="table-advokasi" cellpadding="5px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasi as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kategori ? $item->nama_kategori : '-' }}</td>
                                    <td style="text-align: justify;">{!! nl2br(e($item->aspirasi)) !!}</td>
                                    <td style="text-align: justify;">{!! nl2br(e($item->tanggapan ? $item->tanggapan : '-')) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
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

    $(document).ready(function() {
        if ($('.table-advokasi').length) {
            $('.table-advokasi').DataTable({
                pageLength: 10,
                lengthChange: false,
                scrollX: true,
                autoWidth: false
            });
        }
    });
</script>
@endsection
