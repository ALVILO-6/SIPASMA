@extends('layouts.base')

@section('title', "Struktur Organisasi")

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
    .struktur-container {
        background: linear-gradient(to bottom, #0066CC 0%, transparent 50%, #0066CC 100%), url('icons/DalamFTI.jpg');
        background-size: 100%, cover;
        color: black;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 13px;
        color: white;
    }
    .struktur-header {
        padding: 30px 0;
        text-align: center;
        text-shadow: 2px 3px 3px black;
        font-weight: bold;
    }
    .struktur-chart {
        display: flex;
        gap: 13px;
    }
    .header-top {
        font-size: 38px;
    }
    .header-bottom {
        font-size: 20px;
    }
    .chart-box {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 3px solid lightblue;
        background-color: darkblue;
        color: white;
        border-radius: 10px;
        gap: 15px;
        text-shadow: 1px 2px 3px black;
        box-shadow: 3px 3px 3px black;
    }
    .struktur-foto {
        width: 50px;
        /* border: 3px solid lightblue; */
        border-radius: 10px;
    }
    .struktur-nama {
        font-size: 20px;
    }
    .struktur-jabatan {
        font-size: 15px;
    }
    .swal2-popup, .swal2-confirm, .swal2-cancel {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
    }
    .swal2-input {
        border-radius: 10px;
    }
    footer {
        margin-top: 15px;
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
        .struktur-container {
            padding: 24px 14px;
            box-sizing: border-box;
        }
        .struktur-chart {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }
        .chart-box {
            flex: 1 1 320px;
            max-width: 420px;
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
        .header-top {
            font-size: 30px;
        }
        .header-bottom {
            font-size: 18px;
        }
        .chart-box {
            max-width: 360px;
        }
        .struktur-nama {
            font-size: 18px;
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
        .struktur-header {
            padding: 20px 10px;
        }
        .header-top {
            font-size: 24px;
        }
        .header-bottom {
            font-size: 14px;
        }
        .chart-box {
            padding: 8px;
            gap: 10px;
        }
        .struktur-foto {
            width: 42px;
        }
        .struktur-jabatan {
            font-size: 13px;
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
        .struktur-container {
            width: 95%;
            margin: 0 auto;
            padding: 14px 8px;
            box-sizing: border-box;
        }
        .header-top {
            font-size: 20px;
        }
        .header-bottom {
            font-size: 13px;
        }
        .chart-box {
            flex-direction: column;
            text-align: center;
            width: 100%;
            max-width: 100%;
            gap: 8px;
            padding: 10px;
        }
        .struktur-nama {
            font-size: 16px;
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
            <a href="/form" class="navbar-btn">
                <img src="icons/Form.png" style="width: 30px;">
                <span>Form Aspirasi</span>
            </a>
            <div class="selected-btn">
                <img src="icons/Struktur.png" style="width: 30px;">
                <span>Struktur Organisasi</span>
            </div>
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
                <span>Login</span>
            </a>
        </span>
    </div>
    <div class="struktur-container">
        <div class="struktur-header">
            <div class="header-top">Struktur Komisi Advokasi</div>
            <div class="header-bottom">Mari berkenalan dengan anggota-anggota kami.</div>
        </div>
        <div class="struktur-chart">
            @foreach($struktur['kakom'] as $advo)
                <div class="chart-box">
                    <img src="{{ asset($advo->foto) }}" class="struktur-foto">
                    <span>
                        <div class="struktur-nama">{{ $advo->nama }}</div>
                        <div class="struktur-jabatan">{{ $advo->jabatan }}</div>
                    </span>
                </div>
            @endforeach
        </div>
        <div class="struktur-chart">
            @foreach($struktur['sekom'] as $advo)
                <div class="chart-box">
                    <img src="{{ asset($advo->foto) }}" class="struktur-foto">
                    <span>
                        <div class="struktur-nama">{{ $advo->nama }}</div>
                        <div class="struktur-jabatan">{{ $advo->jabatan }}</div>
                    </span>
                </div>
            @endforeach
        </div>
        <div class="struktur-chart">
            @foreach($struktur['fungsio']->slice(0,4) as $advo)
                <div class="chart-box">
                    <img src="{{ asset($advo->foto) }}" class="struktur-foto">
                    <span>
                        <div class="struktur-nama">{{ $advo->nama }}</div>
                        <div class="struktur-jabatan">{{ $advo->jabatan }}</div>
                    </span>
                </div>
            @endforeach
        </div>
        <div class="struktur-chart">
            @foreach($struktur['fungsio']->slice(4) as $advo)
                <div class="chart-box">
                    <img src="{{ asset($advo->foto) }}" class="struktur-foto">
                    <span>
                        <div class="struktur-nama">{{ $advo->nama }}</div>
                        <div class="struktur-jabatan">{{ $advo->jabatan }}</div>
                    </span>
                </div>
            @endforeach
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
</script>
@endsection
