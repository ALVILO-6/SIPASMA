@extends('layouts.base')

@section('title', "Aspirasi Terselesaikan")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .logout-btn, .on-process {
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
        white-space: nowrap;
    }
    .on-process:hover {
        color: #0066CC;
        text-decoration: underline;
    }
    .logout-btn:hover {
        color: #E32636;
        text-decoration: underline;
    }
    .dashboard {
        background: radial-gradient(#1E3A8A 0%, #1E40AF 25%, #1D4ED8 50%, #1E3A5F 75%, #0F172A 100%);
        font-family: 'Open Sans', sans-serif;
    }
    .chart-container {
        padding: 10px;
        display: flex;
        justify-content: center;
        gap: 100px;
        flex-wrap: wrap;
        /* background-color: yellow; */
    }
    .pie-container {
        width: 100%;
        max-width: 400px;
        height: 100%;
        background: linear-gradient(to bottom right, steelblue 0%, skyblue 50%, lightblue 100%);
        border: 2px solid black;
        border-radius: 30px;
        font-family: 'Open Sans', 'sans-serif';
        padding: 20px;
    }
    .line-container {
        width: 100%;
        max-width: 760px;
        height: 380px;
        background: radial-gradient(lightblue 0%, skyblue 50%, steelblue 100%);
        border: 2px solid black;
        border-radius: 30px;
        font-family: 'Open Sans', 'sans-serif';
        padding: 20px;
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
        font-family: 'Open Sans', 'sans-serif';
    }
    .aspirasi-container {
        padding: 20px;
        overflow-x: visible;
        max-width: 100%;
        /* background-color: black; */
    }
    #line-graph {
        width: 100% !important;
        height: 100% !important;
    }
    .cards-container {
        display: flex;
        /* max-width: 1000px; */
        justify-content: center;
        gap: 40px;
        padding: 10px;
        flex-wrap: wrap;
    }
    .card-total {
        padding: 10px;
        border: 2px solid white;
        border-radius: 10px;
        color: white;
        text-shadow: 1px 2px 5px black;
        background: linear-gradient(to bottom right, #0D47A1 0%, #1565C0 25%, #1976D2 50%, #42A5F5 75%, #90CAF9 100%);
    }
    .card-done {
        padding: 10px;
        border: 2px solid white;
        border-radius: 10px;
        color: white;
        text-shadow: 1px 2px 5px black;
        background: linear-gradient(to bottom right, #1B5E20 0%, #2E7D32 25%, #388E3C 50%, #66BB6A 75%, #A5D6A7 100%);
    }
    .card-progress {
        padding: 10px;
        border: 2px solid white;
        border-radius: 10px;
        color: white;
        text-shadow: 1px 2px 5px black;
        background: linear-gradient(to bottom right, #8A6A00 0%, #A67C00 25%, #BF8F00 50%, #D9A800 75%, #E6B800 100%);
    }
    .card-text {
        font-weight: bold;
        font-size: 15px;
    }
    .card-value {
        font-size: 30px;
    }
    .header-one {
        font-size: 30px;
        font-weight: bold;
        color: white;
        text-shadow: 1px 2px 3px black;
    }
    table {
        border-collapse: collapse;
        border-left: none;
        border-right: none;
        border-color: #0066CC;
        width: 100%;
        border-width: 1px;
        max-width: 1500px;
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
    th, td {
        border-collapse: collapse;
        border-width: 0px;
        border-color: #0066CC;
        border-left: none;
        border-right: none;
    }
    thead {
        background-color: darkblue;
        color: lightblue;
        text-align: center;
        border-width: 3px;
    }
    .table-done tbody tr:nth-child(odd) td {
        background-color: #CFE8FF !important;
        color: #0B2E59 !important;
    }

    .table-done tbody tr:nth-child(even) td {
        background-color: #A9D4FF !important;
        color: #0B2E59 !important;
    }
    .swal2-popup, .swal2-confirm, .swal2-cancel, .swal2-textarea {
        font-family: 'Open Sans', 'sans-serif';
        border-radius: 20px;
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
        .logout-btn, .on-process {
            font-size: 16px;
        }
        .logout-btn img, .on-process img {
            width: 24px !important;
        }
        .user-info {
            margin-left: auto;
        }
        .cards-container {
            gap: 16px;
        }
        .card-total, .card-done, .card-progress {
            width: 220px;
        }
        .chart-container {
            gap: 16px;
            padding: 8px;
        }
        .line-container {
            max-width: 100%;
        }
        .aspirasi-container {
            padding: 16px 12px;
        }
        .table-done {
            min-width: 980px;
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
        .cards-container {
            justify-content: stretch;
            gap: 12px;
            padding: 10px 12px;
        }
        .card-total, .card-done, .card-progress {
            width: 100%;
        }
        .card-text {
            font-size: 14px;
        }
        .card-value {
            font-size: 26px;
        }
        .pie-container, .line-container {
            border-radius: 18px;
            padding: 14px;
        }
        .line-container {
            height: 340px;
        }
        .header-one {
            font-size: 24px;
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
            text-align: center;
            padding: 0 16px;
        }
    }
    @media(max-width: 600px) {
        .navbar {
            padding: 8px 10px;
        }
        .logout-btn, .on-process {
            font-size: 14px;
            gap: 8px;
        }
        .cards-container {
            padding: 10px 8px;
        }
        .chart-container {
            padding: 8px;
        }
        .pie-container, .line-container {
            border-radius: 14px;
            padding: 10px;
        }
        .line-container {
            height: 300px;
        }
        .aspirasi-container {
            padding: 12px 8px;
        }
        .header-one {
            font-size: 20px;
        }
        .table-done {
            min-width: 900px;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 12px;
        }
    }
    @media(max-width: 480px) {
        .logout-btn, .on-process {
            font-size: 12px;
            gap: 6px;
        }
        .logout-btn img, .on-process img {
            width: 20px !important;
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
        .card-text {
            font-size: 12px;
        }
        .card-value {
            font-size: 22px;
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
        <a href="/dashboard" class="on-process">
            <img src="icons/OnProcess.png" width="30px;">
            <div>Progress Aspirasi</div>
        </a>
        <span class="user-info">
            <img src="icons/KomisiAdvokasi.png" width="50px;">
            <span>
                <div class="user-nama" style="font-size: 25px;">{{ $name }}</div>
                <div class="user-jabatan" style="font-size: 15px;">{{ $jabatan }}</div>
            </span>
        </span>
    </div>
    <div class="cards-container">
        <div class="card-total">
            <div class="card-text">Jumlah Aspirasi yang Masuk</div>
            <div class="card-value">{{ $total }}</div>
        </div>
        <div class="card-done">
            <div class="card-text">Jumlah Aspirasi yang Diselesaikan</div>
            <div class="card-value">{{ $done }}</div>
        </div>
        <div class="card-progress">
            <div class="card-text">Jumlah Aspirasi yang Sedang Dikerjakan</div>
            <div class="card-value">{{ $progress }}</div>
        </div>
    </div>
    <div class="chart-container">
        <div class="pie-container">
            <canvas id="pie-chart"></canvas>
            <ul id="kategori-list"></ul>
        </div>
        <div class="line-container">
            <canvas id="line-graph"></canvas>
            <ul id="tanggal-list"></ul>
        </div>
    </div>
    <div class="aspirasi-container">
        @if($aspirasi->isEmpty())
            <div class="empty-data">
                <img src="icons/EmptyFolder.png">
                <div class="pic-text" style="font-size: 50px;">Belum ada aspirasi yang diselesaikan...</div>
            </div>
        @else
            <div class="done-data">
                <br>
                <div class="header-one">Daftar Aspirasi yang Sudah Diselesaikan</div>
                <table cellpadding="5px" align="center" border="1" class="table-done">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>PJ</th>
                            <th>Tanggapan</th>
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
                                <td class="nowrap">{{ $advo->nama_pj }}</td>
                                <td>{{ $advo->tanggapan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    function logout() {
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin logout?',
            text: 'Kamu akan dikeluarkan dari sesi.',
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

    Chart.defaults.font.family = "'Open Sans', sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = 'black';

    $(document).ready(function() {
        $('.table-done').DataTable({
            pageLength: 10,
            lengthChange: false,
            scrollX: true,
            autoWidth: false
        });

        pieChart();
        lineGraph();
    });

    function pieChart() {
        fetch('{{ route("pieChart") }}')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const pie = document.getElementById('pie-chart');
            const pieData = data.pie;
            const label = pieData.map(item => item.kat);
            const value = pieData.map(item => item.total);

            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        // label: 'Aspirasi yang Sudah Diselesaikan',
                        data: value,
                        backgroundColor: [
                            '#2563EB',
                            '#64748B',
                            '#10B981',
                            '#F59E0B',
                            '#6366F1'
                        ],
                        borderColor: 'black',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            align: 'center',
                            labels: {
                                boxWidth: 14,
                                padding: 10
                            }
                        },
                        title: {
                            display: true,
                            text: 'Aspirasi yang Sudah Dikerjakan',
                            font: {
                                size: 25
                            }
                        }
                    }
                }
            });
        });
    }

    function lineGraph() {
        fetch('{{ route("lineGraph") }}')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const isMobile = window.innerWidth <= 600;
            const isTablet = window.innerWidth <= 1024;
            const titleSize = isMobile ? 16 : (isTablet ? 20 : 24);
            const axisTitleSize = isMobile ? 12 : (isTablet ? 14 : 16);
            const tickSize = isMobile ? 10 : (isTablet ? 11 : 12);
            const pointSize = isMobile ? 2 : 3;
            const line = document.getElementById('line-graph');
            const lineData = data.line;
            const label = lineData.map(item => item.bulan);
            const value = lineData.map(item => item.total);

            new Chart(line, {
                type: 'line',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah Aspirasi per Bulan',
                        data: value,
                        tension: 0.3,
                        fill: true,
                        borderColor: 'darkblue',
                        backgroundColor: 'rgba(64, 224, 208, 0.3)',
                        borderWidth: 2,
                        pointRadius: pointSize,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // layout: {
                    //     padding: {
                    //         top: 10,
                    //         right: 12,
                    //         bottom: 12,
                    //         left: 12
                    //     }
                    // },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Aspirasi per Bulan',
                            font: {
                                size: titleSize
                            },
                            padding: isMobile ? 8 : 12
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: tickSize
                                }
                            },
                            title: {
                                display: true,
                                text: 'Bulan',
                                font: {
                                    size: axisTitleSize
                                },
                                padding: {
                                    top: isMobile ? 8 : 12
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: tickSize
                                }
                            },
                            title: {
                                display: true,
                                text: 'Total Aspirasi',
                                font: {
                                    size: axisTitleSize
                                },
                                padding: {
                                    bottom: isMobile ? 8 : 12
                                }
                            }
                        }
                    }
                }
            });
        });
    }
</script>
@endsection
