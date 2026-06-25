@extends('layouts.app')

@section('title', $ship->name . ' - Detail Kapal Pandu')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .info-item {
        padding: 10px;
        background: #f8f9fa;
        border-radius: 10px;
    }
    .spec-box {
        transition: all 0.3s ease;
    }
    .spec-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0066cc, #00aaff);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #0066cc, #00aaff);
        color: white;
        border: none;
    }
    .btn-outline-gradient {
        background: transparent;
        border: 2px solid #0066cc;
        color: #0066cc;
    }
    .pilot-mini {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
        padding: 10px 15px;
        background: #f0f7ff;
        border-radius: 10px;
        border-left: 3px solid #0066cc;
    }
    .pilot-mini-photo {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #0066cc;
    }
    .pilot-mini-placeholder {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #0066cc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pilot-mini-name {
        font-weight: 700;
        color: #0066cc;
        font-size: 0.95rem;
    }
    .pilot-mini-call {
        font-size: 0.8rem;
        color: #555;
    }
    #shipMap {
        height: 300px;
        width: 100%;
        border-radius: 12px;
        z-index: 1;
    }
    .text-black {
        color: #000000 !important;
    }
    .map-coord {
        font-size: 12px;
        padding: 8px 0;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="page-hero position-relative" style="height: 250px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white">
            <h1 class="display-4 fw-bold mb-2">{{ $ship->name }}</h1>
            <p class="lead">Call Sign: {{ $ship->call_sign }} | Registrasi: {{ $ship->registration_number }}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fleet') }}" class="text-white text-decoration-none">Armada</a></li>
                    <li class="breadcrumb-item active text-white">{{ $ship->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Kiri: Foto Kapal + PETA -->
            <div class="col-lg-6 mb-4">
                <!-- Foto Kapal -->
                <div class="position-relative">
                    @if($ship->photo)
                    <img src="{{ Storage::url($ship->photo) }}" class="img-fluid rounded-4 shadow" alt="{{ $ship->name }}" style="width: 100%;">
                    @else
                    <img src="https://images.unsplash.com/photo-1572213426852-0e4edc62e5b3?w=600&h=400&fit=crop" class="img-fluid rounded-4 shadow" alt="Kapal" style="width: 100%;">
                    @endif
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-{{ $ship->status_badge }} px-3 py-2 rounded-pill">
                            <i class="fas fa-{{ $ship->status == 'available' ? 'check-circle' : ($ship->status == 'on_duty' ? 'ship' : ($ship->status == 'maintenance' ? 'tools' : 'ban')) }} me-1"></i>
                            @if($ship->status == 'available') Tersedia
                            @elseif($ship->status == 'on_duty') Bertugas
                            @elseif($ship->status == 'maintenance') Perawatan
                            @else Tidak Aktif
                            @endif
                        </span>
                    </div>
                </div>

                <!-- PETA DI BAWAH FOTO KAPAL -->
@if($ship->current_latitude && $ship->current_longitude)
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-header bg-primary text-white py-2 rounded-top-4">
        <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Posisi Kapal</h6>
    </div>
    <div class="card-body p-0">
        <!-- IFRAME GOOGLE MAPS - PASTI MUNCUL -->
        <iframe 
            src="https://www.google.com/maps?q={{ $ship->current_latitude }},{{ $ship->current_longitude }}&z=14&output=embed" 
            width="100%" 
            height="300" 
            style="border:0; display:block;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
        <div class="p-2 bg-light map-coord">
            <div class="p-2 bg-light map-coord">
    <div class="row text-center">
        <div class="col-4">
            <div><i class="fas fa-map-pin text-primary"></i> <strong>Latitude:</strong></div>
            <div class="fw-bold">{{ $ship->current_latitude }}</div>
        </div>
        <div class="col-4">
            <div><i class="fas fa-map-pin text-primary"></i> <strong>Longitude:</strong></div>
            <div class="fw-bold">{{ $ship->current_longitude }}</div>
        </div>
        <div class="col-4">
            <div><i class="fas fa-clock text-primary"></i> <strong>Update:</strong></div>
            <div class="fw-bold">{{ $ship->last_position_update ? $ship->last_position_update->format('d/m/Y H:i') : '-' }}</div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endif
            </div>

            <div class="col-lg-6 mb-4">

<!-- Informasi Kapal -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <h5 class="fw-bold mb-3">
            <i class="fas fa-info-circle text-primary me-2"></i>
            Informasi Kapal
        </h5>

        <!-- FOTO PROFIL PANDU -->
        <div class="text-center mb-4 pb-3 border-bottom">

            @if($ship->pilot_photo)
                <img src="{{ Storage::url($ship->pilot_photo) }}"
                     alt="Pandu"
                     style="
                        width:100px;
                        height:100px;
                        border-radius:50%;
                        object-fit:cover;
                        border:3px solid #0066cc;
                     ">
            @else
                <div style="
                    width:100px;
                    height:100px;
                    border-radius:50%;
                    background:#0066cc;
                    margin:auto;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">
                    <i class="fas fa-user text-white fa-2x"></i>
                </div>
            @endif

            <h6 class="fw-bold mt-3 mb-1">
                {{ $ship->pilot_name ?? 'Belum diisi' }}
            </h6>

            <small class="text-muted">
                <i class="fas fa-id-card"></i>
                Call Sign: {{ $ship->call_sign }}
            </small>

        </div>

        <div class="row">

            <div class="col-6">
                <small class="text-muted">Nama Kapal</small>
                <div class="fw-bold">{{ $ship->name }}</div>
            </div>

            <div class="col-6 mt-2">
                <small class="text-muted">Nomor Registrasi</small>
                <div class="fw-bold">
                    {{ $ship->registration_number ?? '-' }}
                </div>
            </div>

            <div class="col-6 mt-2">
                <small class="text-muted">Tipe Kapal</small>
                <div class="fw-bold">
                    {{ $ship->type ?? '-' }}
                </div>
            </div>

            <div class="col-6 mt-2">
                <small class="text-muted">Kapasitas</small>
                <div class="fw-bold">
                    {{ $ship->capacity ?? '-' }} Orang
                </div>
            </div>

            <div class="col-6 mt-2">
                <small class="text-muted">Kecepatan Maks</small>
                <div class="fw-bold">
                    {{ $ship->speed ?? '-' }} Knot
                </div>
            </div>

            <div class="col-12 mt-2">
                <small class="text-muted">Deskripsi</small>
                <div class="fw-bold">
                    {{ $ship->description ?? '-' }}
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Spesifikasi Teknis -->
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">
            <i class="fas fa-ruler-combined text-primary me-2"></i>
            Spesifikasi Teknis
        </h5>

        <div class="row text-center">

            <div class="col-4">
                <div class="border rounded-3 p-2 bg-light">
                    <i class="fas fa-arrows-alt-h fa-2x text-primary mb-1"></i>
                    <div class="fw-bold">
                        {{ $ship->length ?? '-' }}
                        <small>m</small>
                    </div>
                    <small class="text-muted">Panjang</small>
                </div>
            </div>

            <div class="col-4">
                <div class="border rounded-3 p-2 bg-light">
                    <i class="fas fa-arrows-alt-v fa-2x text-primary mb-1"></i>
                    <div class="fw-bold">
                        {{ $ship->width ?? '-' }}
                        <small>m</small>
                    </div>
                    <small class="text-muted">Lebar</small>
                </div>
            </div>

            <div class="col-4">
                <div class="border rounded-3 p-2 bg-light">
                    <i class="fas fa-water fa-2x text-primary mb-1"></i>
                    <div class="fw-bold">
                        {{ $ship->draft ?? '-' }}
                        <small>m</small>
                    </div>
                    <small class="text-muted">Draft</small>
                </div>
            </div>

        </div>
    </div>
</div>

        <!-- Tombol Aksi -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('tracking') }}" class="btn btn-primary rounded-pill px-4 me-2">
                    <i class="fas fa-map-marker-alt me-2"></i> Lihat Semua Kapal di Peta
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-envelope me-2"></i> Ajukan Layanan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = parseFloat('{{ $ship->current_latitude ?? 0 }}');
        var lng = parseFloat('{{ $ship->current_longitude ?? 0 }}');
        
        console.log('Koordinat:', lat, lng);
        
        if (lat != 0 && lng != 0 && !isNaN(lat) && !isNaN(lng)) {
            var map = L.map('shipMap').setView([lat, lng], 14);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            
            var icon = L.divIcon({
                html: '<div style="background:#0066cc; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid white; box-shadow:0 2px 5px rgba(0,0,0,0.2);">' +
                      '<i class="fas fa-ship" style="color:white; font-size:14px;"></i>' +
                      '</div>',
                iconSize: [30, 30]
            });
            
            L.marker([lat, lng], { icon: icon })
                .addTo(map)
                .bindPopup('<b>{{ $ship->name }}</b><br>Pandu: {{ $ship->pilot_name ?? "-" }}')
                .openPopup();
            
            setTimeout(function() {
                map.invalidateSize();
                console.log('Map resized');
            }, 500);
        } else {
            document.getElementById('shipMap').innerHTML = '<div class="text-center p-4 text-muted">Belum ada koordinat</div>';
        }
    });
</script>
@endsection