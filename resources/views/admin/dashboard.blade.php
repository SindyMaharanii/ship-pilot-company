@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- ===== FULL WIDTH ===== -->
<div class="container-fluid px-0">

    <!-- ===== HERO SECTION - SAMA PERSIS DENGAN PUBLIC ===== -->
    <section class="hero-section position-relative" style="height: 100vh; background: linear-gradient(135deg, #001a33 0%, #003366 100%); overflow: hidden;">
        <!-- ADMIN PANEL di Hero (cuma ini yang beda) -->
        <div class="position-absolute top-0 start-0 w-100 p-3" style="z-index: 10;">
            <div class="admin-panel-bar" style="background: rgba(255, 249, 230, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffc107; border-radius: 12px; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; box-shadow: 0 2px 8px rgba(255, 193, 7, 0.15); margin: 0 20px;">
                <div class="admin-title" style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-crown text-warning"></i>
                    <span style="font-weight: 700; color: #1a1a2e;">Mode Admin</span>
                    <span style="background: #0066cc; color: white; padding: 4px 16px; border-radius: 20px; font-size: 11px; font-weight: 600;">Akses Penuh</span>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    <a href="{{ route('admin.ships.index') }}" class="btn btn-primary btn-sm" style="border-radius: 8px; font-size: 13px; padding: 6px 16px;">
                        <i class="fas fa-ship me-1"></i> Armada
                    </a>
                    <a href="{{ route('admin.ships.create') }}" class="btn btn-success btn-sm" style="border-radius: 8px; font-size: 13px; padding: 6px 16px;">
                        <i class="fas fa-plus me-1"></i> Tambah Kapal
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px; font-size: 13px; padding: 6px 16px;" target="_blank">
                        <i class="fas fa-eye me-1"></i> Lihat Publik
                    </a>
                </div>
            </div>
        </div>

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('https://images.unsplash.com/photo-1572213426852-0e4edc62e5b3?w=1920&h=1080&fit=crop') center/cover no-repeat; opacity: 0.3; transform: scale(1.1); animation: zoomBg 20s infinite;"></div>
        <div class="container h-100 position-relative">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 text-white" data-aos="fade-right">
                    <h1 class="display-1 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Pandu Kapal<br>Profesional
                    </h1>
                    <p class="lead mb-4" style="font-size: 1.5rem;">Keselamatan dan Kepercayaan adalah Prioritas Utama Kami</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('services') }}" class="btn btn-gradient btn-lg px-4 py-3 rounded-pill" style="background: linear-gradient(135deg, #0066cc 0%, #004d99 100%); color: white; border: none; transition: all 0.3s ease;">
                            <i class="fas fa-info-circle"></i> Layanan Kami
                        </a>
                        <a href="{{ route('tracking') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-map-marker-alt"></i> Lacak Kapal
                        </a>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                    <div class="card bg-dark bg-opacity-50 backdrop-blur rounded-4 p-4" style="backdrop-filter: blur(10px); background: rgba(0,0,0,0.3) !important;">
                        <h4 class="text-white text-center mb-3">Hubungi Kami Sekarang</h4>
                        <div class="text-center text-white mb-3">
                            <i class="fas fa-phone-alt fa-3x pulse-animation" style="animation: pulse 2s ease-in-out infinite;"></i>
                            <p class="mt-2 mb-0">+62 123 4567 890</p>
                            <small>24/7 Emergency Call</small>
                        </div>
                        <a href="{{ route('contact') }}" class="btn btn-warning rounded-pill">Hubungi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes zoomBg { 0%, 100% { transform: scale(1.1); } 50% { transform: scale(1.2); } }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        .backdrop-blur { backdrop-filter: blur(10px); background: rgba(0,0,0,0.3) !important; }
        .pulse-animation { animation: pulse 2s ease-in-out infinite; }
    </style>

    <!-- ===== SISA KONTEN DASHBOARD ===== -->
    <div class="container-fluid px-4 py-4">

        <!-- ===== STATISTIK ===== -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Total Armada</h5>
                        <h2 class="mb-0">{{ $totalShips ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Tersedia</h5>
                        <h2 class="mb-0">{{ $activeShips ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Bertugas</h5>
                        <h2 class="mb-0">{{ $onDutyShips ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <h5 class="card-title">Pesan Masuk</h5>
                        <h2 class="mb-0">{{ $pendingContacts ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== LAYANAN ===== -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h4 class="mb-0">Layanan Unggulan</h4>
                    <p class="text-muted mb-0 small">Layanan pandu kapal profesional</p>
                </div>
                <div>
                    <button class="btn btn-success btn-sm" onclick="alert('Tambah Layanan')">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="alert('Lihat Semua Layanan')">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </button>
                </div>
            </div>
            <div class="row">
                @forelse($services ?? [] as $service)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-3 position-relative admin-section">
                    <button class="admin-edit-btn" onclick="alert('Edit layanan: {{ $service->name }}')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <div class="card h-100 text-center p-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto">
                            <i class="fas fa-{{ $service->icon ?? 'anchor' }} fa-2x text-primary"></i>
                        </div>
                        <h5 class="mt-2">{{ $service->name }}</h5>
                        <p class="small text-muted">{{ Str::limit($service->description, 60) }}</p>
                        <a href="{{ route('services') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            Selengkapnya
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada layanan.</p>
                    <button class="btn btn-success btn-sm" onclick="alert('Tambah Layanan')">
                        <i class="fas fa-plus me-1"></i> Tambah Layanan
                    </button>
                </div>
                @endforelse
            </div>
        </div>

        <!-- ===== ARMADA ===== -->
        <div class="bg-light p-4 rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h4 class="mb-0">Armada Kapal Pandu</h4>
                    <p class="text-muted mb-0 small">Kapal modern dengan teknologi terkini</p>
                </div>
                <div>
                    <a href="{{ route('admin.ships.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Kapal
                    </a>
                    <a href="{{ route('admin.ships.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
            <div class="row">
                @forelse($ships ?? [] as $ship)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6 mb-3 position-relative admin-section">
                    <button class="admin-edit-btn" onclick="location.href='{{ route('admin.ships.edit', $ship->id) }}'">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <div class="card h-100">
                        @if($ship->photo)
                        <img src="{{ Storage::url($ship->photo) }}" class="card-img-top" style="height:150px; object-fit:cover;">
                        @else
                        <img src="https://via.placeholder.com/300x150?text=Kapal" class="card-img-top" style="height:150px; object-fit:cover;">
                        @endif
                        <div class="card-body text-center">
                            <h6 class="fw-bold">{{ $ship->name }}</h6>
                            <small class="text-muted">{{ $ship->call_sign }}</small>
                            <br>
                            <span class="badge bg-{{ $ship->status_badge ?? 'secondary' }}">
                                {{ $ship->status_text ?? $ship->status }}
                            </span>
                            <div class="mt-2 d-grid gap-1">
                                <a href="{{ route('ship.detail', $ship->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('admin.ships.edit', $ship->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada kapal.</p>
                    <a href="{{ route('admin.ships.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Kapal
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- ===== MITRA ===== -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h4 class="mb-0">Mitra Kerja Sama</h4>
                    <p class="text-muted mb-0 small">Mitra terpercaya yang telah bekerja sama</p>
                </div>
                <div>
                    <button class="btn btn-success btn-sm" onclick="alert('Tambah Mitra')">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="alert('Lihat Semua Mitra')">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </button>
                </div>
            </div>
            <div class="row">
                @forelse($partnerships ?? [] as $partner)
                <div class="col-xl-2 col-lg-3 col-md-3 col-4 mb-3 position-relative admin-section">
                    <button class="admin-edit-btn" style="font-size:10px; padding:2px 12px;" onclick="alert('Edit mitra: {{ $partner->partner_name }}')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <div class="card text-center p-3 h-100">
                        @if($partner->logo)
                        <img src="{{ Storage::url($partner->logo) }}" class="mx-auto" style="height:50px; object-fit:contain;">
                        @else
                        <i class="fas fa-building fa-3x text-secondary"></i>
                        @endif
                        <p class="small fw-bold mt-2 mb-0">{{ $partner->partner_name }}</p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada mitra.</p>
                    <button class="btn btn-success btn-sm" onclick="alert('Tambah Mitra')">
                        <i class="fas fa-plus me-1"></i> Tambah Mitra
                    </button>
                </div>
                @endforelse
            </div>
        </div>

        <!-- ===== CTA ===== -->
        <div class="text-white p-5 rounded-3 text-center" style="background: linear-gradient(135deg, #0066cc, #004d99);">
            <h2 class="fw-bold">Siap Bekerja Sama dengan Kami?</h2>
            <p class="lead">Hubungi kami sekarang untuk mendapatkan layanan pandu kapal terbaik</p>
            <a href="{{ route('contact') }}" class="btn btn-warning btn-lg rounded-pill px-5">
                <i class="fas fa-envelope me-2"></i> Hubungi Kami Sekarang
            </a>
        </div>

    </div>

</div>

<style>
    /* ===== CARD STATS ===== */
    .card-stats {
        background: #0066cc !important;
        color: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2);
        transition: all 0.3s ease;
    }
    .card-stats:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
    }
    .card-stats .card-body {
        padding: 20px;
    }
    .card-stats .card-title {
        font-size: 14px;
        opacity: 0.85;
        font-weight: 400;
        margin-bottom: 2px;
    }
    .card-stats h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1.2;
    }

    /* ===== ADMIN EDIT BUTTON ===== */
    .admin-edit-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 10;
        background: rgba(255, 193, 7, 0.95);
        color: #1a1a2e;
        border: none;
        border-radius: 30px;
        padding: 3px 12px;
        font-size: 10px;
        font-weight: 600;
        opacity: 0;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(255,193,7,0.3);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .admin-edit-btn:hover {
        opacity: 1 !important;
        transform: scale(1.05);
        background: #ffc107;
    }
    .admin-section:hover .admin-edit-btn {
        opacity: 0.8;
    }
    .admin-edit-btn i {
        font-size: 9px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card-stats h2 {
            font-size: 1.6rem;
        }
        .card-stats .card-title {
            font-size: 12px;
        }
        .admin-panel-bar {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
            padding: 12px 16px !important;
            margin: 0 10px !important;
        }
        .admin-panel-bar .admin-title {
            justify-content: center;
        }
        .admin-panel-bar > div:last-child {
            justify-content: center;
        }
        .hero-section {
            height: 80vh !important;
        }
        .hero-section h1 {
            font-size: 2.5rem !important;
        }
        .hero-section .lead {
            font-size: 1rem !important;
        }
    }
    @media (max-width: 576px) {
        .card-stats h2 {
            font-size: 1.2rem;
        }
        .container-fluid {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }
        .hero-section {
            height: 70vh !important;
        }
        .hero-section h1 {
            font-size: 2rem !important;
        }
    }
</style>
@endsection