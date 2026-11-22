<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet 3: Cemilan & Dessert</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Latar Belakang Utama Soft Pink dengan Gambar Background Dessert */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FCE4EC; /* Base Soft Pink */
            background-image: url("{{ asset('images/bg-dessert.jpg') }}"); /* Panggil gambar jika disimpan di public/images */
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
        }

        /* Container & Card Dashboard dengan Pink Pekat / Bright Soft Pink */
        .dashboard-container {
            background-color: rgba(255, 240, 245, 0.92); /* Transparan Soft Pink agar gambar latar tetap sedikit terlihat */
            backdrop-filter: blur(4px);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(180, 83, 9, 0.15);
        }

        .card-custom {
            background-color: #F8BBD0 !important; /* Pink lebih cerah & pekat dari latar */
            border: 1px solid #F48FB1 !important;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Header Amber khusus tugas */
        .header-amber {
            background-color: #B45309 !important; /* Dark Amber Header */
            color: #ffffff !important;
        }

        /* Styling Tabel Rapi */
        .table-custom {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom tbody tr:hover {
            background-color: #FDF2F8 !important;
        }

        /* Input Controls & Form Styling */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #F48FB1;
        }

        .form-control:focus {
            border-color: #B45309;
            box-shadow: 0 0 0 0.25rem rgba(180, 83, 9, 0.25);
        }

        .btn-amber {
            background-color: #B45309;
            color: white;
        }
        .btn-amber:hover {
            background-color: #92400E;
            color: white;
        }
    </style>
</head>
<body class="py-4">

<div class="container dashboard-container my-3">
    <!-- Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-warning">
        <div>
            <h2 class="fw-bold text-dark mb-0">Rekap Penjualan Snack & Dessert</h2>
            <small class="text-muted">Financial Tracker & Sales Report System</small>
        </div>
        <span class="badge header-amber fs-6 px-3 py-2 rounded-pill shadow-sm">Pemrograman Web: Kelompok 6</span>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Filter & Import (Pink Pekat / Cerah) -->
    <div class="card card-custom mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <!-- Filter Tanggal & Export Form -->
                <div class="col-lg-7">
                    <form action="{{ route('snack.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label fw-bold text-dark">Dari:</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label fw-bold text-dark">Sampai:</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary shadow-sm">Filter</button>
                            <a href="{{ route('snack.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success shadow-sm">
                                Export Excel
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Import Form -->
                <div class="col-lg-5">
                    <form action="{{ route('snack.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                        @csrf
                        <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                        <button type="submit" class="btn btn-primary shadow-sm">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table (Clean White Inside Pink Container) -->
    <div class="card card-custom p-2">
        <div class="table-responsive table-custom">
            <table class="table table-hover align-middle mb-0">
                <thead class="header-amber">
                    <tr>
                        <th class="py-3 ps-3">ID Transaksi</th>
                        <th class="py-3">Nama Snack / Dessert</th>
                        <th class="py-3">Jumlah</th>
                        <th class="py-3">Harga Satuan</th>
                        <th class="py-3">Total Harga</th>
                        <th class="py-3">Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr>
                            <td class="ps-3 fw-bold text-secondary">{{ $trx->transaction_id }}</td>
                            <td class="fw-semibold">{{ $trx->nama_item }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $trx->jumlah }}</span></td>
                            <td>Rp {{ number_format($trx->harga_satuan, 0, ',', '.') }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $trx->tanggal_transaksi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>