@extends('layouts.app')

@section('title', $ship->name . ' - Detail Kapal Pandu')

@section('styles')
<style>
    /* ===== GLOBAL ===== */
    .info-item {
        padding: 12px 16px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
        transition: background 0.2s;
    }
    .info-item:hover {
        background: #eef4ff;
    }
    .info-item label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        margin-bottom: 2px;
    }
    .info-item h6 {
        margin-bottom: 0;
        font-weight: 700;
        color: #1a2a3a;
    }

    .spec-box {
        padding: 16px 12px;
        background: #f8f9fa;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }
    .spec-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 102, 204, 0.12);
        background: #ffffff;
    }
    .spec-box i {
        font-size: 1.8rem;
    }
    .spec-box small {
        display: block;
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 4px;
    }
    .spec-box h5 {
        font-weight: 700;
        margin-top: 2px;
        margin-bottom: 0;
        color: #1a2a3a;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #004a99, #0073e6);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #0066cc, #0099ff);
        color: #fff;
        border: none;
        transition: all 0.3s;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 102, 204, 0.35);
        color: #fff;
    }

    .btn-outline-gradient {
        background: transparent;
        border: 2px solid #0066cc;
        color: #0066cc;
        transition: all 0.3s;
    }
    .btn-outline-gradient:hover {
        background: #0066cc;
        color: #fff;
        transform: translateY(-2px);
    }

    .card-hover {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.10) !important;
    }

    /* ===== FOTO KAPAL ===== */
    .ship-photo-wrapper {
        border-radius: 16px;
        overflow: hidden;
    }

    .ship-photo-wrapper img {
        transition: transform 0.5s ease;
    }

    .ship-photo-wrapper img:hover {
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ship-photo-wrapper {
            min-height: 250px !important;
        }
        .ship-photo-wrapper img {
            min-height: 250px !important;
        }
    }

    /* Status Badge di atas foto */
    .status-badge {
        font-size: 0.8rem;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        backdrop-filter: blur(4px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ship-photo-card {
            min-height: 280px;
        }
    }

    /* ===== ROW EQUAL HEIGHT ===== */
    .equal-height-row {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .equal-height-row .col-left {
        display: flex;
        flex-direction: column;
    }
    .equal-height-row .col-left .card {
        flex: 1;
        height: 100%;
        border-radius: 16px;
        overflow: hidden;
    }
    .equal-height-row .col-left .card .card-body {
        padding: 0;
        height: 100%;
        display: flex;
        align-items: stretch;
    }

    .equal-height-row .col-right {
        display: flex;
        flex-direction: column;
    }
    .equal-height-row .col-right .right-stack {
        display: flex;
        flex-direction: column;
        height: 100%;
        gap: 16px;
    }
    .equal-height-row .col-right .right-stack .card:first-child {
        flex: 1;
    }
    .equal-height-row .col-right .right-stack .card:last-child {
        flex-shrink: 0;
    }

    /* ===== PERBAIKI JARAK VESSELFINDER ===== */
    #vesselfinder-ship {
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        line-height: 0 !important;
        font-size: 0 !important;
        width: 100% !important;
        height: 350px !important;
        overflow: hidden !important;
        border-radius: 0 0 16px 16px !important;
    }

    #vesselfinder-ship iframe,
    #vesselfinder-ship object,
    #vesselfinder-ship embed,
    #vesselfinder-ship div,
    #vesselfinder-ship * {
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        vertical-align: bottom !important;
        line-height: 0 !important;
        font-size: 0 !important;
    }

    .vesselfinder-map,
    .vesselfinder-container {
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        line-height: 0 !important;
    }

    /* ===== BADGE ===== */
    .status-badge {
        font-size: 0.75rem;
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .equal-height-row {
            flex-direction: column;
        }
        .ship-photo-card {
            min-height: 250px;
        }
        #vesselfinder-ship {
            height: 250px !important;
        }
        .page-hero {
            height: 140px !important;
        }
        .page-hero h1 {
            font-size: 1.8rem !important;
        }
        .btn-lg {
            font-size: 0.95rem;
            padding: 10px 24px !important;
        }
        .equal-height-row .col-right .right-stack {
            gap: 12px;
        }
    }

    @media (min-width: 769px) and (max-width: 991px) {
        .ship-photo-card {
            min-height: 300px;
        }
    }
</style>
@endsection

@section('content')
<!-- ===== HERO ===== -->
<section class="page-hero position-relative" style="height: 200px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white">
            <h1 class="display-4 fw-bold mb-1">{{ $ship->name }}</h1>
            <p class="lead mb-1">Call Sign: {{ $ship->call_sign }} | Registrasi: {{ $ship->registration_number }}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none opacity-75">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fleet') }}" class="text-white text-decoration-none opacity-75">Armada</a></li>
                    <li class="breadcrumb-item active text-white fw-semibold">{{ $ship->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<section class="py-4">
    <div class="container">

        <!-- ===== ROW 1: FOTO PANDU + INFORMASI KAPAL ===== -->
<div class="row g-4">

    <!-- KIRI: Pandu -->
    <div class="col-lg-4">
        <div class="d-flex align-items-center h-100">
            <div class="card border-0 shadow-lg rounded-4 card-hover w-100" style="max-height: 420px;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center p-4">
                    <h5 class="fw-bold mb-3 text-primary">
                        <i class="fas fa-user-helmet-safety me-2"></i> Pandu Kapal
                    </h5>

                    @if($ship->pilot_photo)
                        <img src="{{ Storage::url($ship->pilot_photo) }}" 
                             alt="Pilot {{ $ship->name }}"
                             style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #0066cc;">
                    @else
                        <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #0066cc, #0099ff); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    @endif

                    <div class="fw-bold fs-5 text-primary mt-3">
                        {{ $ship->pilot_name ?? 'Belum diisi' }}
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-id-card me-1"></i> Call Sign: {{ $ship->call_sign }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KANAN: Informasi Kapal -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 h-100 card-hover">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4 text-primary">
                    <i class="fas fa-info-circle me-2"></i> Informasi Kapal
                </h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Nama Kapal</label>
                            <h6>{{ $ship->name }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Call Sign</label>
                            <h6>{{ $ship->call_sign }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Nomor Registrasi</label>
                            <h6>{{ $ship->registration_number ?? '-' }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Tipe Kapal</label>
                            <h6>{{ $ship->type ?? '-' }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Kapasitas</label>
                            <h6>{{ $ship->capacity ?? '-' }} Orang</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>Kecepatan Maks</label>
                            <h6>{{ $ship->speed ?? '-' }} Knot</h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-item">
                            <label>Deskripsi</label>
                            <p class="mb-0 text-dark">{{ $ship->description ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- ===== ROW 2: FOTO KAPAL + SPESIFIKASI + POSISI ===== -->
        <div class="row g-4 mt-1">

            <!-- KIRI: Foto Kapal -->
            <div class="col-lg-4">
                <div class="d-flex align-items-center h-100">
                    <div class="card border-0 shadow-lg rounded-4 card-hover w-100">
                        <div class="card-body p-0">
                            <div class="ship-photo-wrapper" style="width: 100%; height: 100%; min-height: 350px; position: relative; display: flex; align-items: center; justify-content: center; background: #e9ecef; overflow: hidden; border-radius: 16px;">
                                @if($ship->photo)
                                    <img src="{{ Storage::url($ship->photo) }}" 
                                         alt="{{ $ship->name }}" 
                                         style="width: 100%; height: 100%; min-height: 350px; object-fit: cover; object-position: center;">
                                @else
                                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; min-height: 350px; background: #f1f3f5; color: #adb5bd;">
                                        <i class="fas fa-ship" style="font-size: 4rem; margin-bottom: 10px;"></i>
                                        <span class="fw-semibold">Tidak ada foto</span>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge status-badge bg-{{ $ship->status_badge }}" style="font-size: 0.8rem; padding: 8px 20px; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 12px rgba(0,0,0,0.25);">
                                        @if($ship->status == 'available') 
                                            <i class="fas fa-check-circle me-1"></i> Tersedia
                                        @elseif($ship->status == 'on_duty') 
                                            <i class="fas fa-ship me-1"></i> Bertugas
                                        @elseif($ship->status == 'maintenance') 
                                            <i class="fas fa-tools me-1"></i> Perawatan
                                        @else
                                            <i class="fas fa-times-circle me-1"></i> Tidak Aktif
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN: Spesifikasi + Posisi -->
            <div class="col-lg-8">
                <div class="d-flex flex-column gap-3">
                    
                    <!-- Spesifikasi -->
                    <div class="card border-0 shadow-lg rounded-4 card-hover">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4 text-primary">
                                <i class="fas fa-ruler-combined me-2"></i> Spesifikasi Teknis
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="spec-box">
                                        <i class="fas fa-arrows-alt-h text-primary"></i>
                                        <small>Panjang</small>
                                        <h5>{{ $ship->length ?? '-' }} m</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="spec-box">
                                        <i class="fas fa-arrows-alt-v text-primary"></i>
                                        <small>Lebar</small>
                                        <h5>{{ $ship->width ?? '-' }} m</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="spec-box">
                                        <i class="fas fa-water text-primary"></i>
                                        <small>Draft</small>
                                        <h5>{{ $ship->draft ?? '-' }} m</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Posisi Kapal (VesselFinder) -->
                    <div class="card border-0 shadow-lg rounded-4 card-hover overflow-hidden" style="border-radius: 16px !important;">
                        <div class="card-header bg-gradient-primary text-white" style="padding: 8px 16px !important; border-bottom: none !important;">
                            <h5 class="fw-bold mb-0" style="font-size: 0.95rem; line-height: 1.2;">
                                <i class="fas fa-map-marker-alt me-2"></i> Posisi Kapal
                                <small class="fw-normal ms-2" style="font-size: 0.65rem; opacity: 0.8;">- Perairan Batam</small>
                            </h5>
                            <small class="fw-normal d-block" style="font-size: 0.6rem; opacity: 0.7; margin-top: -1px;">Data posisi kapal real-time dari VesselFinder</small>
                        </div>
                        <div id="vesselfinder-ship"></div>
                        <script type="text/javascript">
                            var width = "100%";
                            var height = "350";
                            var names = true;
                            var mmsi = "{{ $ship->mmsi ?? '525100089' }}";
                            var show_track = true;
                        </script>
                        <script type="text/javascript" src="https://www.vesselfinder.com/aismap.js"></script>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===== TOMBOL AKSI ===== -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('tracking') }}" class="btn btn-gradient btn-lg rounded-pill px-5 me-2 mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i> Lihat Semua Kapal
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-gradient btn-lg rounded-pill px-5 mb-2">
                    <i class="fas fa-envelope me-2"></i> Ajukan Layanan
                </a>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function setEqualHeight() {
            var leftCard = document.querySelector('.equal-height-row .col-left .card');
            var rightStack = document.querySelector('.equal-height-row .col-right .right-stack');
            if (leftCard && rightStack) {
                leftCard.style.height = 'auto';
                var rightHeight = rightStack.offsetHeight;
                if (rightHeight > 0) {
                    leftCard.style.height = rightHeight + 'px';
                }
            }
        }
        setTimeout(setEqualHeight, 200);
        window.addEventListener('resize', setEqualHeight);
        
        // Re-run after VesselFinder loads
        setTimeout(setEqualHeight, 1000);
        setTimeout(setEqualHeight, 2000);
    });
</script>
@endpush
@endsection