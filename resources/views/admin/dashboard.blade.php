@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
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
    .card-stats .card-body { padding: 20px; }
    .card-stats .card-title { font-size: 14px; opacity: 0.85; font-weight: 400; margin-bottom: 2px; }
    .card-stats h2 { font-size: 2.2rem; font-weight: 800; margin: 0; line-height: 1.2; }

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
    .admin-edit-btn:hover { opacity: 1 !important; transform: scale(1.05); background: #ffc107; }
    .admin-section:hover .admin-edit-btn { opacity: 0.8; }

    /* ===== PERBAIKI JARAK PETA ===== */
    .map-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .map-card .card-header {
        padding: 10px 16px;
        background: white;
        border-bottom: 1px solid #e9ecef;
    }
    .map-card .card-header h5 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }
    .map-card .card-header small {
        font-size: 11px;
        color: #6c757d;
        display: block;
        margin-top: 2px;
    }
    .map-card .card-body {
        padding: 0 !important;
    }
    #vesselfinder-admin {
        width: 100%;
        height: 400px;
    }
    .map-wrapper {
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .card-stats h2 { font-size: 1.6rem; }
        .card-stats .card-title { font-size: 12px; }
        #vesselfinder-admin { height: 280px; }
    }
    @media (max-width: 576px) {
        .card-stats h2 { font-size: 1.2rem; }
        #vesselfinder-admin { height: 220px; }
    }
</style>
@endsection

@section('content')
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

    <!-- ===== PETA VESSELFINDER - BATAM (RAPI, TANPA JARAK BERLEBIH) ===== -->
    <div class="map-wrapper">
        <div class="card map-card">
            <div class="card-header">
                <h5><i class="fas fa-map-marker-alt text-primary me-2"></i> Posisi Kapal - Perairan Batam</h5>
                <small>Data posisi kapal real-time dari VesselFinder</small>
            </div>
            <div class="card-body">
                <div id="vesselfinder-admin"></div>
                
                <script type="text/javascript">
                    var width = "100%";
                    var height = "400";
                    var latitude = "1.0878";
                    var longitude = "103.9005";
                    var zoom = "11";
                    var names = true;
                </script>
                <script type="text/javascript" src="https://www.vesselfinder.com/aismap.js"></script>
            </div>
        </div>
    </div>

    <!-- ===== ARMADA KAPAL ===== -->
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
                        
                        <!-- FOTO PANDU -->
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2 mb-2">
                            @if($ship->pilot_photo)
                                <img src="{{ Storage::url($ship->pilot_photo) }}" 
                                     style="width:30px; height:30px; border-radius:50%; object-fit:cover; border:2px solid #0066cc;">
                            @else
                                <div style="width:30px; height:30px; border-radius:50%; background:#0066cc; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-user text-white" style="font-size:12px;"></i>
                                </div>
                            @endif
                            <span class="small fw-bold text-primary">{{ $ship->pilot_name ?? 'Belum Ditugaskan' }}</span>
                        </div>
                        
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

    <!-- ===== MENU ADMIN ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog me-2"></i> Menu Admin</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.ships.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-ship fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Kelola Kapal</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-concierge-bell fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Kelola Layanan</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.partnerships.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-handshake fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Kelola Mitra</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-envelope fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Pesan Masuk</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.company.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-building fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Profil Perusahaan</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.contact.index') }}" class="text-decoration-none">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-address-card fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Kelola Kontak</h6>
                                </div></div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('tracking') }}" class="text-decoration-none" target="_blank">
                                <div class="card bg-light h-100"><div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-0">Tracking Kapal</h6>
                                </div></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection