@extends('layouts.app')

@section('title', 'Armada Kapal Pandu - Ship Pilot Company')

@section('content')
<!-- Hero Section -->
<section class="page-hero position-relative" style="height: 400px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3">Armada Kapal Pandu</h1>
            <p class="lead">Kapal-kapal modern dengan teknologi terkini dan standar keselamatan tinggi</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Armada</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h5 class="fw-bold mb-0"><i class="fas fa-filter text-primary me-2"></i> Filter Armada</h5>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="d-flex gap-2 justify-content-md-end">
                    <button class="btn btn-outline-primary rounded-pill filter-btn active" data-filter="all">Semua</button>
                    <button class="btn btn-outline-primary rounded-pill filter-btn" data-filter="available">Tersedia</button>
                    <button class="btn btn-outline-primary rounded-pill filter-btn" data-filter="on_duty">Bertugas</button>
                    <button class="btn btn-outline-primary rounded-pill filter-btn" data-filter="maintenance">Perawatan</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fleet Grid -->
<section class="py-5">
    <div class="container">
        <div class="row" id="fleetContainer">
            @forelse($ships as $ship)
            <div class="col-lg-4 col-md-6 mb-4 fleet-item" data-status="{{ $ship->status }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-hover border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="position-relative">
                        @if($ship->photo)
                        <img src="{{ Storage::url($ship->photo) }}" class="card-img-top" alt="{{ $ship->name }}" style="height: 280px; object-fit: cover;">
                        @else
                        <img src="https://images.unsplash.com/photo-1572213426852-0e4edc62e5b3?w=400&h=280&fit=crop" class="card-img-top" alt="Kapal" style="height: 280px; object-fit: cover;">
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-{{ $ship->status_badge }} px-3 py-2 rounded-pill">
                                <i class="fas fa-{{ $ship->status == 'available' ? 'check-circle' : ($ship->status == 'on_duty' ? 'ship' : ($ship->status == 'maintenance' ? 'tools' : 'ban')) }} me-1"></i>
                                @if($ship->status == 'available') Tersedia
                                @elseif($ship->status == 'on_duty') Bertugas
                                @elseif($ship->status == 'maintenance') Perawatan
                                @else Tidak Aktif
                                @endif
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-dark text-white p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                            <h4 class="fw-bold mb-0">{{ $ship->name }}</h4>
                            <small><i class="fas fa-id-card me-1"></i> {{ $ship->call_sign }}</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-qrcode text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Registrasi</small>
                                        <span class="fw-bold small">{{ $ship->registration_number }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Di dalam card fleet, setelah call sign -->
<div class="d-flex align-items-center justify-content-center gap-2 mt-2 mb-2">
    @if($ship->pilot_photo)
        <img src="{{ Storage::url($ship->pilot_photo) }}" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; border: 2px solid #0066cc;">
    @else
        <div style="width: 30px; height: 30px; border-radius: 50%; background: #0066cc; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-user text-white fa-sm"></i>
        </div>
    @endif
    <span class="small fw-bold">{{ $ship->pilot_name ?? 'Belum diisi' }}</span>
</div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tachometer-alt text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Kecepatan</small>
                                        <span class="fw-bold small">{{ $ship->speed ?? '-' }} Knot</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-ruler-combined text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Panjang</small>
                                        <span class="fw-bold small">{{ $ship->length ?? '-' }} m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Kapasitas</small>
                                        <span class="fw-bold small">{{ $ship->capacity ?? '-' }} org</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($ship->current_latitude && $ship->current_longitude)
                        <div class="alert alert-info py-2 mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <small>Update: {{ $ship->last_position_update ? $ship->last_position_update->diffForHumans() : '-' }}</small>
                        </div>
                        @endif
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('ship.detail', $ship->id) }}" class="btn btn-gradient rounded-pill">
                                <i class="fas fa-info-circle me-2"></i> Detail Kapal
                            </a>
                            <a href="{{ route('tracking') }}" class="btn btn-outline-gradient rounded-pill">
                                <i class="fas fa-map-marker-alt me-2"></i> Lacak Posisi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada data kapal.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Fleet Stats -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4" data-aos="fade-up">
                <div class="text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="fas fa-ship text-primary fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $ships->count() }}</h3>
                    <p class="text-muted">Total Armada</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="fas fa-check-circle text-success fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $ships->where('status', 'available')->count() }}</h3>
                    <p class="text-muted">Kapal Tersedia</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="fas fa-ship text-info fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $ships->where('status', 'on_duty')->count() }}</h3>
                    <p class="text-muted">Sedang Bertugas</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="fas fa-tools text-warning fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $ships->where('status', 'maintenance')->count() }}</h3>
                    <p class="text-muted">Dalam Perawatan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
            
            // Filter items
            document.querySelectorAll('.fleet-item').forEach(item => {
                if (filter === 'all' || item.getAttribute('data-status') === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.5s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Add animation style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .filter-btn.active {
            background: linear-gradient(135deg, #0066cc, #00aaff);
            color: white;
            border-color: transparent;
        }
        .bg-gradient-dark {
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
        }
    `;
    document.head.appendChild(style);
</script>
@endsection