@extends('layouts.base')

@section('title', "Dashboard Admin")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
@endsection

@section('styles')
    html, body {
        padding: 0;
        box-sizing: border-box;
        margin: 0;
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
        background-color: #0066CC;
    }
    .logout-btn, .aspirasi-done {
        color: black;
        display: flex;
        gap: 10px;
        align-items: center;
        text-decoration: none;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 20px;
    }
    .aspirasi-done:hover {
        color: #0066CC;
        text-decoration: underline;
    }
    .logout-btn:hover {
        color: #E32636;
        text-decoration: underline;
    }
    .dashboard {
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
        gap: 10px;
    }
    .user-info {
        gap: 10px;
        display: flex;
        align-items: center;
    }
    .dashboard-container {
        padding: 30px;
        overflow-x: visible;
        max-width: 100%;
    }
    .header-one {
        font-size: 30px;
        font-weight: bold;
        color: white;
        text-shadow: 1px 2px 3px black;
        margin-bottom: 10px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 1500px;
        border: none;
    }
    th, td {
        border-collapse: collapse;
        border: none;
    }
    table.dataTable thead th,
    table.dataTable tbody td,
    table.dataTable.no-footer {
        border-bottom: none !important;
    }
    thead {
        background-color: darkblue;
        color: lightblue;
        text-align: center;
    }
    .swal2-popup, .swal2-confirm, .swal2-cancel, .swal2-textarea {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
    }
    .swal2-popup .swal2-textarea {
        border: 2px solid #0066CC;
    }
    /* .swal2-input {
        border-radius: 10px;
    } */
    .table-dashboard tbody tr:nth-child(odd) td {
        background-color: #CFE8FF !important;
        color: #0B2E59 !important;
    }
    .table-dashboard tbody tr:nth-child(even) td {
        background-color: #A9D4FF !important;
        color: #0B2E59 !important;
    }
    .pj-select {
        text-align: center;
        width: 100%;
        border-radius: 10px;
        padding: 5px;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        background-color: darkblue;
        box-sizing: border-box;
        color: lightblue;
        font-weight: bold;
    }
    .status-select {
        text-align: center;
        width: 100%;
        border-radius: 10px;
        padding: 5px;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        background-color: darkblue;
        box-sizing: border-box;
        color: lightblue;
        font-weight: bold;
    }
    option {
        text-align: left;
    }
    .hapus-pj {
        cursor: pointer;
        text-align: center;
        width: 100%;
        border-radius: 10px;
        padding: 5px;
        border: 1px solid black;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        background-color: #E32636;
        box-sizing: border-box;
        color: #FFD700;
        font-weight: bold;
        text-decoration: none;
        text-shadow: 1px 1px 3px black;
    }
    .empty-data {
        max-width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 80vh;
        gap: 40px;
    }
    .pic-text {
        font-size: 50px;
        color: white;
        text-shadow: 2px 2px 3px darkblue;
        /* margin-top: 20px; */
    }
    .btn-tanggapan {
        cursor: pointer;
        text-align: center;
        width: 100%;
        border-radius: 10px;
        padding: 5px;
        border: none;
        font-family: 'Open Sans', 'sans-serif';
        font-size: 15px;
        background-color: green;
        box-sizing: border-box;
        color: lightgreen;
        font-weight: bold;
        text-decoration: none;
        text-shadow: 1px 1px 3px black;
    }
    .btn-tanggapan:hover {
        text-shadow: none;
        border: 2px solid black;
        color: darkgreen;
        background-color: lightgreen;
    }
    /* DataTable styles */
    .dataTables_wrapper {
        color: white !important;
        font-family: 'Open Sans', sans-serif;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_info {
        color: white !important;
        font-weight: 600;
    }

    .dataTables_filter input {
        font-family: 'Open Sans', 'sans-serif';
    }
    .dataTables_filter {
        margin-bottom: 5px;
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

    /* Pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: white !important;
        border: 1px solid white !important;
        background: transparent !important;
        border-radius: 8px !important;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: darkblue !important;
        background: lightblue !important;
        border-color: lightblue !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: darkblue !important;
        background: lightblue !important;
        border-color: lightblue !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed !important;
    }
    @media(max-width: 1024px) {
        .navbar {
            flex-wrap: wrap;
            padding: 10px 14px;
            gap: 12px;
        }
        .logout-btn, .aspirasi-done {
            font-size: 16px;
            white-space: nowrap;
        }
        .logout-btn img, .aspirasi-done img {
            width: 24px !important;
        }
        .user-info {
            margin-left: auto;
        }
        .dashboard-container {
            padding: 20px 12px;
        }
        .table-dashboard {
            min-width: 1100px;
        }
        .empty-data img {
            width: 220px;
        }
        .pic-text {
            font-size: 36px !important;
            text-align: center;
            padding: 0 16px;
        }
    }
    @media(max-width: 768px) {
        .navbar {
            justify-content: flex-start;
        }
        .user-info {
            width: 100%;
            order: 3;
            margin-left: 0;
            justify-content: flex-start;
        }
        .user-info img {
            width: 40px !important;
        }
        .user-nama {
            font-size: 18px !important;
        }
        .user-jabatan {
            font-size: 12px !important;
        }
        .header-one {
            font-size: 24px;
        }
        .pj-select, .status-select, .hapus-pj, .btn-tanggapan {
            font-size: 13px;
        }
        .empty-data {
            height: 70vh;
            gap: 20px;
        }
        .empty-data img {
            width: 170px;
        }
        .pic-text {
            font-size: 28px !important;
        }
    }
    @media(max-width: 600px) {
        .navbar {
            padding: 8px 10px;
        }
        .logout-btn {
            margin-left: 0;
            font-size: 14px;
        }
        .aspirasi-done {
            font-size: 14px;
        }
        .dashboard-container {
            padding: 14px 8px;
        }
        .user-info {
            margin-right: 0;
        }
        .user-nama {
            font-size: 16px !important;
        }
        .user-jabatan {
            font-size: 10px !important;
        }
        .table-dashboard {
            min-width: 980px;
        }
        .header-one {
            font-size: 20px;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 12px;
        }
    }
    @media(max-width: 480px) {
        .logout-btn, .aspirasi-done {
            font-size: 12px;
            gap: 6px;
        }
        .logout-btn img, .aspirasi-done img {
            width: 20px !important;
        }
        .user-info {
            gap: 8px;
        }
        .user-info img {
            width: 34px !important;
        }
        .user-nama {
            font-size: 14px !important;
        }
        .user-jabatan {
            font-size: 9px !important;
        }
        .dashboard-container {
            padding: 12px 6px;
        }
        .empty-data img {
            width: 130px;
        }
        .pic-text {
            font-size: 22px !important;
        }
    }
@endsection

@section('content')

<div class="dashboard">
    <div class="navbar">
        <button class="logout-btn" onclick="logout()">
            <img src="icons/Logout.png" style="width: 30px;">
            Logout
        </button>
        @if($jabatan !== 'Fungsionaris Komisi Advokasi')
            <a href="/done" class="aspirasi-done">
                <img src="icons/Done.png" width="30px;">
                <div>Aspirasi Selesai</div>
            </a>
        @endif
        <span class="user-info">
            <img src="icons/KomisiAdvokasi.png" width="50px;">
            <span>
                <div class="user-nama" style="font-size: 25px;">{{ $name }}</div>
                <div class="user-jabatan" style="font-size: 15px;">{{ $jabatan }}</div>
            </span>
        </span>
    </div>
    @if($aspirasi->isEmpty())
        <div class="empty-data">
            <img src="icons/EmptyFolder.png">
            <div class="pic-text" style="font-size: 50px;">Belum ada aspirasi yang masuk nih...</div>
        </div>
    @else
        <div class="dashboard-container">
            <div class="header-one" align="center">Progress Aspirasi</div>
            <table cellpadding="5px" class="table-dashboard">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>PJ</th>
                        <th>Tanggapan</th>
                        @if($jabatan === 'Ketua Komisi Advokasi')
                            <th>AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasi as $index => $advo)
                        <tr align="center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $advo->nama ? $advo->nama : '-' }}</td>
                            <td>{{ $advo->nim ? $advo->nim : '-' }}</td>
                            <td class="kategori" data-id="{{ $advo->id }}">{{ $advo->kategori }}</td>
                            <td style="text-align: justify;">{!! nl2br(e($advo->aspirasi)) !!}</td>
                            <td>
                                @if($advo->pj === $nim && $advo->status !== 'STS4')
                                    <select name="status" data-id="{{ $advo->id }}" class="status-select">
                                        <option value='{{ $advo->status }}' hidden>{{ $advo->nama_status }}</option>
                                        @if($advo->status !== 'STS2')
                                            <option value="STS2">Sedang Diproses</option>
                                        @elseif($advo->status !== 'STS3')
                                            <option value="STS3">Ditunda</option>
                                        @endif
                                    </select>
                                    <div class="selectedStatus" data-id="{{ $advo->id }}" hidden>{{ $advo->nama_status }}</div>
                                @else
                                    {{ $advo->nama_status }}
                                @endif
                            </td> 
                            <td class="nowrap">
                                @if($jabatan === 'Ketua Komisi Advokasi' || $jabatan === 'Sekretaris Komisi Advokasi')
                                    <select name="pj" data-id="{{ $advo->id }}" class="pj-select" >
                                        <option hidden>Pilih PJ ...</option>
                                        @foreach($pj as $admin)
                                            <option value="{{ $admin->nama }}">{{ $admin->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="selectedPJ" data-id="{{ $advo->id }}" name="selectedPJ" hidden>{{ $advo->pj ? $advo->pj : "-" }}</div>
                                @else
                                    <div class="selectedPJ" data-id="{{ $advo->id }}" name="selectedPJ" hidden>{{ $advo->pj ? $advo->pj : "-" }}</div>
                                @endif
                            </td>
                            @if($advo->pj === $nim && $advo->status !== 'STS3')
                                <td class="tanggapan">
                                    <button class="btn-tanggapan" data-id="{{ $advo->id }}">Jawab</button>
                                </td>
                            @elseif($advo->status === 'STS3')
                                <td class="tanggapan">Ditunda</td>
                            @else
                                <td class="tanggapan">Belum ada tanggapan</td>
                            @endif
                            @if($jabatan === 'Ketua Komisi Advokasi' && $advo->pj === NULL)
                                <td>
                                    <button type="button" class="hapus-pj" data-id="{{ $advo->id }}">Hapus</button>
                                </td>
                            @elseif($jabatan === 'Ketua Komisi Advokasi' && $advo->pj !== NULL)
                                <td>
                                    <div class="watch" data-id="{{ $advo->id }}">Diproses...</div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


@endsection

@section('scripts')
<script>
    function logout() {
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin logout?',
            text: 'Anda akan dikeluarkan dari sesi.',
            showConfirmButton: true,
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if(result.isConfirmed) {
                fetch('{{ route("logout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            text: 'Sampai jumpa, ' + data.panggilan + '!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = '/login';
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Logout Gagal',
                        text: 'Terjadi kesalahan saat logout',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                });
            }
        });
    }

    $(document).ready(function() {
        if ($('.table-dashboard').length) {
            $('.table-dashboard').DataTable({
                pageLength: 10,
                lengthChange: false,
                scrollX: true,
                autoWidth: false
            });
        }

        $('.pj-select').on('change', function() {
            const select = $(this);
            const nama = select.val();
            const row = select.closest('tr');
            const selectedPJ = row.find('.selectedPJ');

            fetch('{{ route("get-panggilan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({nama: nama})
            }).then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Yakin ingin menetapkan ' + data.panggilan + ' sebagai PJ?',
                        text: 'Begitu kamu OK, kamu tidak bisa melakukan perubahan lagi di kemudian hari.',
                        showConfirmButton: true,
                        confirmButtonText: 'Ya',
                        showCancelButton: true,
                        cancelButtonText: 'Tidak'
                    }).then(result => {
                        if(result.isConfirmed) {
                            fetch('/update/' + selectedPJ.data('id'), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({nama: nama})
                            }).then(response => response.json())
                            .then(data => {
                                if(data.success) {
                                    Swal.fire({
                                       icon: 'success',
                                       title: 'PJ Berhasil Dipilih',
                                       text: data.panggilan + ' telah dipilih menjadi PJ.',
                                       showConfirmButton: false,
                                       timer: 2000 
                                    }).then(() => {
                                        select.hide();
                                        selectedPJ.text(nama).show();
                                        window.location.reload();
                                    });
                                }
                            });
                        }
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memuat PJ',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            });
        });
        
        $('.hapus-pj').on('click',function() {
            const id = $(this).data('id');
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin hapus aspirasi ini?',
                showConfirmButton: true,
                confirmButtonText: 'Ya',
                showCancelButton: true,
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if(result.isConfirmed) {
                    fetch('{{ route("deletePJ", ":id") }}'.replace(':id', id), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({id: id})
                    }).then(response => response.json())
                    .then(data => {
                        window.location.href = '/dashboard';
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal menghapus aspirasi',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $('.selectedPJ').each(function() {
            const nim = $(this).text().trim();
            const id = $(this).data('id');

            if(nim !== "-") {
                fetch('{{ route("nimPJ") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({nim: nim})
                }).then(response => response.json())
                .then(data => {
                    if(data.success) {
                        const namaData = data.nama ? data.nama : 'Belum ada PJ';
                        $(`.selectedPJ[data-id="${id}"]`).text(namaData);
                    }
                });
                $(`.pj-select[data-id="${id}"]`).hide();
                $(this).show();
            } else {
                const user = `{{ $jabatan }}`;
                if(user === 'Ketua Komisi Advokasi' || user === 'Sekretaris Komisi Advokasi') {
                    $(`.pj-select[data-id="${id}"]`).show();
                } else {
                    $(this).text('Belum ada PJ').show();
                }
            }
        });

        $('.status-select').on('change',function() {
            const select = $(this);
            const status = select.val();
            const row = select.closest('tr');
            const selectedStatus = row.find('.selectedStatus');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi',
                text: 'Yakin ingin meng-update status?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(result => {
                if(result.isConfirmed) {
                    fetch('/updateS/' + selectedStatus.data('id'), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({status: status})
                    }).then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Status Berhasil Diperbarui',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                if(status === 'STS4') {
                                    select.hide();
                                    selectedStatus.text(status).show();
                                } else {
                                    select.show();
                                    selectedStatus.hide();
                                }
                                window.location.reload();
                            });
                        }
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memperbarui status.',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $('.btn-tanggapan').on('click',function() {
            const btn = $(this);
            const id = btn.data('id');
            const row = btn.closest('tr');
            const current = row.find('.tanggapan-input').val();

            Swal.fire({
                title: 'Beri tanggapan',
                input: 'textarea',
                inputValue: current || '',
                inputPlaceholder: 'Tuliskan jawabanmu',
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal'
            }).then(result => {
                if(!result.isConfirmed) return;

                fetch('/tanggapan/' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // 'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tanggapan: result.value })
                }).then(response => response.json())
                .then(data => {
                    if(data.success) {
                        row.find('.tanggapan-input').val(result.value);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Tanggapan tersimpan.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tanggapan gagal disimpan.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal menyimpan tanggapan.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });
        });
    });
</script>
@endsection
