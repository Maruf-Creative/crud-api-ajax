<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Data Mahasiswa RESTful API & AJAX PTM12</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --color-bg: #f8fafc;
            --color-surface: #ffffff;
            --color-border: #e2e8f0;
            --color-primary: #1e40af;
            --color-primary-hover: #1d4ed8;
            --color-text-main: #0f172a;
            --color-text-muted: #64748b;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--color-bg);
            color: var(--color-text-main);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .app-navbar {
            background-color: var(--color-surface);
            border-bottom: 1px solid var(--color-border);
            padding: 0.875rem 0;
        }

        .brand-badge {
            font-size: 0.75rem;
            letter-spacing: 0.02em;
            font-weight: 600;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .badge-online {
            background-color: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .badge-offline {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .stat-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            padding: 1.15rem 1.25rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .content-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .custom-table {
            margin-bottom: 0;
        }

        .custom-table thead th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
            background: #f8fafc;
            border-bottom: 1px solid var(--color-border);
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .custom-table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.885rem;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .font-code {
            font-family: var(--font-mono);
            font-size: 0.825rem;
            letter-spacing: -0.02em;
            color: #334155;
            background: #f1f5f9;
            padding: 0.2rem 0.45rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .student-avatar {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #e0e7ff;
            color: #3730a3;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .badge-jurusan {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.55rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-ti { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .badge-si { background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; }
        .badge-mi { background-color: #fae8ff; color: #86198f; border: 1px solid #f5d0fe; }
        .badge-tk { background-color: #ccfbf1; color: #115e59; border: 1px solid #99f6e4; }
        .badge-default { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        .btn-action {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.15s ease;
        }

        .btn-action-edit {
            background-color: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .btn-action-edit:hover {
            background-color: #fef3c7;
            color: #92400e;
        }

        .btn-action-delete {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .btn-action-delete:hover {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .modal-content {
            border: 1px solid var(--color-border);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--color-border);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--color-border);
            background: #fafafa;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid var(--color-border);
            padding: 0.6rem 0.85rem;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .form-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.35rem;
        }

        .spin {
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<header class="app-navbar sticky-top">
    <div class="container-xl d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-2 p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
                <i class="bi bi-mortarboard-fill fs-5"></i>
            </div>
            <div>
                <h1 class="h6 mb-0 fw-bold">Portal Mahasiswa</h1>
                <small class="text-muted d-block" style="font-size: 0.75rem;">Integrasi RESTful API & AJAX Laravel</small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span id="api-status-badge" class="brand-badge badge-online d-none d-sm-inline-flex align-items-center gap-1">
                <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                <span id="api-status-text">API Online</span>
            </span>
            <button class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1 px-3" id="btn-refresh" title="Muat Ulang Data dari API" aria-label="Sinkronkan data dari API">
                <i class="bi bi-arrow-clockwise" id="refresh-icon"></i>
                <span class="d-none d-md-inline">Sinkron Data</span>
            </button>
            <button class="btn btn-primary btn-sm d-flex align-items-center gap-1 px-3" id="btn-tambah" type="button">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Data</span>
            </button>
        </div>
    </div>
</header>

<main class="container-xl py-4">

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted d-block small mb-1 fw-medium">Total Mahasiswa Terdaftar</span>
                    <h3 class="mb-0 fw-bold" id="metric-total">0</h3>
                </div>
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted d-block small mb-1 fw-medium">Program Studi Aktif</span>
                    <h3 class="mb-0 fw-bold" id="metric-jurusan">0</h3>
                </div>
                <div class="stat-icon bg-info-subtle text-info">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted d-block small mb-1 fw-medium">Status Sinkronisasi</span>
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <span class="badge bg-success-subtle text-success border border-success-subtle fw-medium" style="font-size: 0.8rem; border-radius: 6px;">
                            <i class="bi bi-check-circle-fill me-1"></i> Terhubung
                        </span>
                        <small class="text-muted font-monospace" id="last-sync-time" style="font-size: 0.75rem;">--:--</small>
                    </div>
                </div>
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-database-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="p-3 border-bottom d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center bg-white">
            <div class="d-flex align-items-center gap-2">
                <h2 class="h6 mb-0 fw-bold text-slate-800">Daftar Mahasiswa</h2>
                <span class="badge bg-secondary-subtle text-secondary font-monospace" id="table-count-badge" style="border-radius: 6px;">0 Data</span>
            </div>

            <div class="d-flex flex-wrap gap-2 align-items-center">
                <div style="min-width: 170px;">
                    <select class="form-select form-select-sm" id="filter-jurusan" aria-label="Filter berdasarkan program studi">
                        <option value="">Semua Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                    </select>
                </div>

                <div class="input-group input-group-sm" style="max-width: 250px;">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" id="search-input" placeholder="Cari nama, NIM, email..." aria-label="Cari data mahasiswa berdasarkan nama, NIM, atau email">
                </div>
            </div>
        </div>

        <div class="text-center py-5" id="loading-spinner">
            <div class="spinner-border text-primary spinner-border-sm me-2" role="status"></div>
            <span class="text-muted small">Memuat data dari RESTful API Laravel...</span>
        </div>

        <div class="table-responsive">
            <table class="table custom-table align-middle" id="students-table" style="display: none;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Kontak</th>
                        <th class="text-end" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="students-body">
                </tbody>
            </table>
        </div>

        <div class="text-center py-5" id="empty-state" style="display: none;">
            <div class="bg-light d-inline-flex p-3 rounded-circle text-muted mb-2">
                <i class="bi bi-inbox fs-2"></i>
            </div>
            <h6 class="fw-bold mb-1">Belum Ada Data Mahasiswa</h6>
            <p class="text-muted small mb-3">Data mahasiswa kosong atau tidak ditemukan dengan filter yang dipilih.</p>
            <button class="btn btn-outline-primary btn-sm" id="btn-tambah-empty">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa Baru
            </button>
        </div>
    </div>
</main>

<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="studentModalLabel">Tambah Mahasiswa</h5>
                    <small class="text-muted" id="studentModalSub">Masukkan informasi mahasiswa dengan lengkap</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="student-form" onsubmit="event.preventDefault(); return false;">
                <div class="modal-body">
                    <input type="hidden" id="student-id">

                    <div class="mb-3">
                        <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-hash"></i></span>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Contoh: 2024001" maxlength="20" autocomplete="off">
                        </div>
                        <div class="invalid-feedback d-block" id="error-nim"></div>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Ahmad Fauzi" maxlength="255" autocomplete="off">
                        </div>
                        <div class="invalid-feedback d-block" id="error-nama"></div>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Program Studi / Jurusan <span class="text-danger">*</span></label>
                        <select class="form-select" id="jurusan" name="jurusan">
                            <option value="">— Pilih Program Studi —</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Manajemen Informatika">Manajemen Informatika</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                        </select>
                        <div class="invalid-feedback d-block" id="error-jurusan"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" maxlength="255" autocomplete="off">
                        </div>
                        <div class="invalid-feedback d-block" id="error-email"></div>
                    </div>

                    <div class="mb-2">
                        <label for="no_hp" class="form-label">Nomor Telepon / WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" maxlength="15" autocomplete="off">
                        </div>
                        <div class="invalid-feedback d-block" id="error-no_hp"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm px-4" id="btn-simpan">
                        <span class="spinner-border spinner-border-sm d-none me-1" id="btn-spinner" role="status"></span>
                        <span id="btn-simpan-text">Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {
    var API_URL = "{{ url('api/students') }}";
    var studentModal = new bootstrap.Modal(document.getElementById('studentModal'));
    var rawStudentsData = [];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    function getInitials(name) {
        if (!name) return 'M';
        var parts = name.trim().split(' ');
        if (parts.length >= 2) {
            return (parts[0][0] + parts[1][0]).toUpperCase();
        }
        return name.substring(0, 2).toUpperCase();
    }

    function getJurusanBadge(jurusan) {
        var cls = 'badge-default';
        var icon = 'bi-tag';
        if (jurusan === 'Teknik Informatika') { cls = 'badge-ti'; icon = 'bi-laptop'; }
        else if (jurusan === 'Sistem Informasi') { cls = 'badge-si'; icon = 'bi-diagram-3'; }
        else if (jurusan === 'Manajemen Informatika') { cls = 'badge-mi'; icon = 'bi-folder'; }
        else if (jurusan === 'Teknik Komputer') { cls = 'badge-tk'; icon = 'bi-cpu'; }

        return '<span class="badge-jurusan ' + cls + '"><i class="bi ' + icon + '"></i> ' + escHtml(jurusan) + '</span>';
    }

    function updateSyncTime() {
        var now = new Date();
        var h = String(now.getHours()).padStart(2, '0');
        var m = String(now.getMinutes()).padStart(2, '0');
        var s = String(now.getSeconds()).padStart(2, '0');
        $('#last-sync-time').text(h + ':' + m + ':' + s);
    }

    function setApiStatus(isOnline) {
        var $badge = $('#api-status-badge');
        var $text = $('#api-status-text');
        if (isOnline) {
            $badge.removeClass('badge-offline').addClass('badge-online');
            $text.text('API Online');
        } else {
            $badge.removeClass('badge-online').addClass('badge-offline');
            $text.text('API Offline');
        }
    }

    function renderTable(dataList) {
        if (!dataList || dataList.length === 0) {
            $('#students-body').html('');
            $('#students-table').hide();
            $('#empty-state').show();
            $('#table-count-badge').text('0 Data');
            return;
        }

        var rows = '';
        $.each(dataList, function (i, s) {
            var initials = getInitials(s.nama);
            rows += '<tr>' +
                '<td class="text-center text-muted fw-medium font-code" style="background:transparent; border:none; padding-left:1rem;">' + (i + 1) + '</td>' +
                '<td>' +
                    '<div class="d-flex align-items-center gap-2">' +
                        '<div class="student-avatar">' + initials + '</div>' +
                        '<div>' +
                            '<div class="fw-semibold text-slate-900">' + escHtml(s.nama) + '</div>' +
                            '<small class="text-muted d-block" style="font-size:0.775rem;">' + escHtml(s.email) + '</small>' +
                        '</div>' +
                    '</div>' +
                '</td>' +
                '<td><span class="font-code">' + escHtml(s.nim) + '</span></td>' +
                '<td>' + getJurusanBadge(s.jurusan) + '</td>' +
                '<td>' +
                    '<div class="d-flex align-items-center gap-1 text-slate-700" style="font-size:0.85rem;">' +
                        '<i class="bi bi-telephone text-muted"></i> ' +
                        (s.no_hp ? escHtml(s.no_hp) : '<span class="text-muted">-</span>') +
                    '</div>' +
                '</td>' +
                '<td class="text-end">' +
                    '<div class="d-inline-flex gap-1">' +
                        '<button class="btn btn-action btn-action-edit btn-edit" data-id="' + s.id + '" title="Edit Data Mahasiswa" aria-label="Edit data ' + escAttr(s.nama) + '">' +
                            '<i class="bi bi-pencil-fill"></i>' +
                        '</button>' +
                        '<button class="btn btn-action btn-action-delete btn-delete" data-id="' + s.id + '" data-nama="' + escAttr(s.nama) + '" title="Hapus Data" aria-label="Hapus data ' + escAttr(s.nama) + '">' +
                            '<i class="bi bi-trash3-fill"></i>' +
                        '</button>' +
                    '</div>' +
                '</td>' +
                '</tr>';
        });

        $('#students-body').html(rows);
        $('#empty-state').hide();
        $('#students-table').show();
        $('#table-count-badge').text(dataList.length + ' Data');
    }

    function applyFilterAndSearch() {
        var query = $.trim($('#search-input').val()).toLowerCase();
        var selectedJurusan = $('#filter-jurusan').val();

        var filtered = rawStudentsData.filter(function (item) {
            var matchJurusan = !selectedJurusan || item.jurusan === selectedJurusan;
            var matchQuery = !query ||
                (item.nama && item.nama.toLowerCase().indexOf(query) !== -1) ||
                (item.nim && item.nim.toLowerCase().indexOf(query) !== -1) ||
                (item.email && item.email.toLowerCase().indexOf(query) !== -1);
            return matchJurusan && matchQuery;
        });

        renderTable(filtered);
    }

    $('#search-input').on('input', applyFilterAndSearch);
    $('#filter-jurusan').on('change', applyFilterAndSearch);

    function loadStudents(silent) {
        if (!silent) {
            $('#loading-spinner').show();
            $('#students-table').hide();
            $('#empty-state').hide();
        }
        $('#refresh-icon').addClass('spin');

        $.ajax({
            url: API_URL,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                $('#loading-spinner').hide();
                $('#refresh-icon').removeClass('spin');
                setApiStatus(true);

                if (res.success && Array.isArray(res.data)) {
                    rawStudentsData = res.data;
                    $('#metric-total').text(rawStudentsData.length);

                    var uniqueJurusan = new Set(rawStudentsData.map(function(s) { return s.jurusan; }).filter(Boolean)).size;
                    $('#metric-jurusan').text(uniqueJurusan);

                    updateSyncTime();
                    applyFilterAndSearch();
                } else {
                    rawStudentsData = [];
                    $('#metric-total').text('0');
                    $('#metric-jurusan').text('0');
                    renderTable([]);
                }
            },
            error: function () {
                $('#loading-spinner').hide();
                $('#refresh-icon').removeClass('spin');
                setApiStatus(false);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: 'Tidak dapat terhubung ke RESTful API Laravel. Pastikan server web dan database MySQL aktif.',
                    confirmButtonColor: '#1e40af'
                });
            }
        });
    }

    loadStudents();

    $('#btn-refresh').on('click', function () {
        loadStudents(true);
    });

    $('#btn-tambah, #btn-tambah-empty').on('click', function () {
        resetForm();
        $('#studentModalLabel').text('Tambah Mahasiswa Baru');
        $('#studentModalSub').text('Lengkapi data formulir di bawah ini');
        $('#btn-simpan-text').text('Simpan Data');
        studentModal.show();
    });

    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        resetForm();
        $('#studentModalLabel').text('Edit Data Mahasiswa');
        $('#studentModalSub').text('Perbarui informasi mahasiswa');
        $('#btn-simpan-text').text('Perbarui Data');

        $.ajax({
            url: API_URL + '/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res.success && res.data) {
                    var s = res.data;
                    $('#student-id').val(s.id);
                    $('#nim').val(s.nim);
                    $('#nama').val(s.nama);
                    $('#jurusan').val(s.jurusan);
                    $('#email').val(s.email);
                    $('#no_hp').val(s.no_hp || '');
                    studentModal.show();
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengambil Data',
                    text: 'Data mahasiswa dengan ID tersebut tidak ditemukan.',
                    confirmButtonColor: '#1e40af'
                });
            }
        });
    });

    function submitStudentForm() {
        clearErrors();

        var nim     = $.trim($('#nim').val());
        var nama    = $.trim($('#nama').val());
        var jurusan = $('#jurusan').val();
        var email   = $.trim($('#email').val());
        var no_hp   = $.trim($('#no_hp').val());
        var isValid = true;

        if (!nim) {
            showFieldError('nim', 'NIM wajib diisi.');
            isValid = false;
        }

        if (!nama) {
            showFieldError('nama', 'Nama Lengkap wajib diisi.');
            isValid = false;
        }

        if (!jurusan) {
            showFieldError('jurusan', 'Program Studi / Jurusan wajib dipilih.');
            isValid = false;
        }

        if (!email) {
            showFieldError('email', 'Alamat Email wajib diisi.');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showFieldError('email', 'Format email tidak valid (contoh: nama@domain.com).');
            isValid = false;
        }

        if (no_hp && !/^[0-9+\s-]{8,18}$/.test(no_hp)) {
            showFieldError('no_hp', 'Nomor telepon tidak valid.');
            isValid = false;
        }

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Formulir',
                text: 'Harap lengkapi semua kolom yang bertanda bintang (*) dengan benar.',
                confirmButtonColor: '#1e40af'
            });
            return false;
        }

        var id     = $('#student-id').val();
        var isEdit = (id !== '' && id !== undefined);

        var formData = {
            nim:     nim,
            nama:    nama,
            jurusan: jurusan,
            email:   email,
            no_hp:   no_hp
        };

        $('#btn-spinner').removeClass('d-none');
        $('#btn-simpan').prop('disabled', true);

        $.ajax({
            url:      isEdit ? (API_URL + '/' + id) : API_URL,
            type:     isEdit ? 'PUT' : 'POST',
            data:     formData,
            dataType: 'json',
            success: function (res) {
                $('#btn-spinner').addClass('d-none');
                $('#btn-simpan').prop('disabled', false);

                if (res.success) {
                    studentModal.hide();
                    loadStudents(true);

                    Swal.fire({
                        icon: 'success',
                        title: isEdit ? 'Berhasil Diperbarui!' : 'Berhasil Ditambahkan!',
                        text: res.message || 'Data mahasiswa telah tersimpan ke database.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            },
            error: function (xhr) {
                $('#btn-spinner').addClass('d-none');
                $('#btn-simpan').prop('disabled', false);

                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        showFieldError(field, messages[0]);
                    });

                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Server Gagal',
                        text: 'Terdapat data yang belum sesuai atau duplikat (NIM/Email). Periksa isian Anda.',
                        confirmButtonColor: '#1e40af'
                    });
                } else {
                    var msg = 'Terjadi kesalahan sistem (HTTP ' + xhr.status + ').';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: msg,
                        confirmButtonColor: '#1e40af'
                    });
                }
            }
        });

        return false;
    }

    $('#btn-simpan').on('click', submitStudentForm);
    $('#student-form input').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            submitStudentForm();
        }
    });

    $(document).on('click', '.btn-delete', function () {
        var id   = $(this).data('id');
        var nama = $(this).data('nama');

        Swal.fire({
            title: 'Hapus Data Mahasiswa?',
            html: 'Apakah Anda yakin ingin menghapus data <strong>' + escHtml(nama) + '</strong>?<br><small class="text-muted">Data yang dihapus dari MySQL tidak dapat dikembalikan.</small>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: API_URL + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            loadStudents(true);

                            Swal.fire({
                                icon: 'success',
                                title: 'Data Terhapus',
                                text: res.message || 'Data mahasiswa berhasil dihapus.',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menghapus',
                            text: 'Terjadi kesalahan saat menghapus data (HTTP ' + xhr.status + ').',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                });
            }
        });
    });

    function resetForm() {
        document.getElementById('student-form').reset();
        $('#student-id').val('');
        clearErrors();
    }

    function clearErrors() {
        $('#student-form').find('.form-control, .form-select').removeClass('is-invalid');
        $('#student-form').find('.invalid-feedback').text('');
    }

    function showFieldError(field, message) {
        $('#' + field).addClass('is-invalid');
        $('#error-' + field).text(message);
    }

    function escHtml(str) {
        if (!str) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    function escAttr(str) {
        if (!str) return '';
        return str.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    $(document).on('input change', '#student-form .form-control, #student-form .form-select', function () {
        $(this).removeClass('is-invalid');
        $('#error-' + $(this).attr('id')).text('');
    });
});
</script>

</body>
</html>
