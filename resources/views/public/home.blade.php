@extends('layouts.app')

@section('title', 'Home - PORTALIS')

@section('styles')
<style>
    #homeMap {
        height: 350px;
        width: 100%;
        border-radius: 8px;
        z-index: 1;
        background: #e9ecef;
    }
    .pilot-avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #0066cc;
    }
    .pilot-placeholder-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #0066cc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @keyframes zoomBg {
        0%, 100% { transform: scale(1.1); }
        50% { transform: scale(1.2); }
    }
    .backdrop-blur {
        backdrop-filter: blur(10px);
        background: rgba(0,0,0,0.3) !important;
    }
    .testimonial-swiper { padding-bottom: 50px; }
    .swiper-pagination-bullet-active { background: #0066cc !important; }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('content')
<!-- Hero Section -->
@php
    $company = App\Models\Company::first();
@endphp

<section class="hero-section position-relative" style="height: 100vh; background: linear-gradient(135deg, #001a33 0%, #003366 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('https://images.unsplash.com/photo-1572213426852-0e4edc62e5b3?w=1920&h=1080&fit=crop') center/cover no-repeat; opacity: 0.3; transform: scale(1.1); animation: zoomBg 20s infinite;"></div>
    <div class="container h-100 position-relative">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8 text-white" data-aos="fade-right">
                <h1 class="display-1 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    {{ $company->name ?? 'Pandu Kapal Profesional' }}
                </h1>
                <p class="lead mb-4" style="font-size: 1.5rem;">{{ $company->description ?? 'Keselamatan dan Kepercayaan adalah Prioritas Utama Kami' }}</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('services') }}" class="btn btn-gradient btn-lg px-4 py-3 rounded-pill">
                        <i class="fas fa-info-circle"></i> Layanan Kami
                    </a>
                    <a href="{{ route('tracking') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                        <i class="fas fa-map-marker-alt"></i> Lacak Kapal
                    </a>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                <div class="card bg-dark bg-opacity-50 backdrop-blur rounded-4 p-4">
                    <h4 class="text-white text-center mb-3">Hubungi Kami Sekarang</h4>
                    <div class="text-center text-white mb-3">
                        <i class="fas fa-phone-alt fa-3x pulse-animation"></i>
                        <p class="mt-2 mb-0">{{ $company->phone ?? '+62 123 4567 890' }}</p>
                        <small>24/7 Emergency Call</small>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-warning rounded-pill">Hubungi Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Layanan Unggulan</h2>
            <p class="subtitle">Layanan pandu kapal profesional dengan standar internasional</p>
        </div>
        <div class="row">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-hover h-100 text-center p-4 shadow-sm rounded-4">
                    <div class="service-icon mx-auto">
                        <i class="fas fa-ship fa-2x"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">{{ $service->name }}</h5>
                    <p class="text-muted">{{ Str::limit($service->description, 100) }}</p>
                    <a href="{{ route('services') }}" class="btn btn-outline-gradient rounded-pill mt-3">Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada layanan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-5 text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4" data-aos="fade-up">
                <div class="display-1 fw-bold text-white" style="font-size: 3rem; font-weight: 800;">
                    {{ $totalShips ?? 0 }}
                </div>
                <p class="mt-2">Kapal Berhasil Dipandu</p>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="display-1 fw-bold text-white" style="font-size: 3rem; font-weight: 800;">
                    {{ $totalShips ?? 0 }}
                </div>
                <p class="mt-2">Armada Kapal</p>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="display-1 fw-bold text-white" style="font-size: 3rem; font-weight: 800;">
                    98
                </div>
                <p class="mt-2">Client Satisfaction (%)</p>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="display-1 fw-bold text-white" style="font-size: 3rem; font-weight: 800;">
                    {{ $totalPartnerships ?? 0 }}
                </div>
                <p class="mt-2">Mitra Kerja Sama</p>
            </div>
        </div>
    </div>
</section>

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

<!-- Armada Kapal Pandu -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Armada Kapal Pandu</h2>
            <p class="subtitle">Kapal-kapal modern dengan teknologi terkini</p>
        </div>
        <div class="row">
            @forelse($ships as $ship)
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-hover h-100 rounded-4 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        @if($ship->photo)
                        <img src="{{ Storage::url($ship->photo) }}" class="card-img-top" alt="{{ $ship->name }}" style="height: 220px; object-fit: cover;">
                        @else
                        <img src="https://via.placeholder.com/400x220?text=Kapal+Pandu" class="card-img-top" alt="Kapal" style="height: 220px; object-fit: cover;">
                        @endif
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-{{ $ship->status_badge ?? 'secondary' }} px-3 py-2 rounded-pill">
                                @if($ship->status == 'available') <i class="fas fa-check-circle"></i> Tersedia
                                @elseif($ship->status == 'on_duty') <i class="fas fa-ship"></i> Bertugas
                                @elseif($ship->status == 'maintenance') <i class="fas fa-tools"></i> Perawatan
                                @else <i class="fas fa-ban"></i> Tidak Aktif
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $ship->name }}</h5>
                            <p class="text-muted small mb-3">Call Sign: {{ $ship->call_sign }}</p>
                            
                            <!-- ===== FOTO PANDU (AVATAR KECIL) ===== -->
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                                @if($ship->pilot_photo)
                                    <img src="{{ Storage::url($ship->pilot_photo) }}" 
                                         style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid #0066cc;">
                                @else
                                    <div style="width: 35px; height: 35px; border-radius: 50%; background: #0066cc; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user text-white" style="font-size: 14px;"></i>
                                    </div>
                                @endif
                                <span class="small fw-bold text-primary">{{ $ship->pilot_name ?? 'Belum Ditugaskan' }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('ship.detail', $ship->id) }}" class="btn btn-gradient rounded-pill btn-sm w-100 mt-2">Detail Kapal</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada armada kapal terdaftar.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('fleet') }}" class="btn btn-gradient btn-lg rounded-pill px-5">Lihat Semua Armada <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Mengapa Memilih Kami?</h2>
            <p class="subtitle">Keunggulan yang membuat kami menjadi yang terpercaya</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="text-center p-4">
                    <div class="service-icon mx-auto" style="width: 60px; height: 60px; background: #0066cc; color:#fff; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                        <i class="fas fa-shield-alt fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Keamanan Terjamin</h5>
                    <p class="text-muted">Sistem keamanan berlapis dengan standar operasional internasional</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4">
                    <div class="service-icon mx-auto" style="width: 60px; height: 60px; background: #0066cc; color:#fff; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">24/7 Layanan</h5>
                    <p class="text-muted">Siap melayani kebutuhan pandu dan sandar kapal kapan saja, 24 jam penuh</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4">
                    <div class="service-icon mx-auto" style="width: 60px; height: 60px; background: #0066cc; color:#fff; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                        <i class="fas fa-certificate fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Bersertifikat</h5>
                    <p class="text-muted">Didukung oleh SDM yang memiliki lisensi resmi dan sertifikasi maritim</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Apa Kata Klien Kami?</h2>
            <p class="subtitle">Testimoni dari mitra dan klien yang telah menggunakan jasa kami</p>
        </div>
        <div class="swiper testimonial-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="fas fa-quote-left fa-2x text-primary opacity-50 mb-3"></i>
                        <p class="mb-4">"Pelayanan profesional dan tepat waktu. Kapal pandu yang handal dan komunikasi yang baik."</p>
                        <div>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <h6 class="mt-3 fw-bold">Capt. James Wilson</h6>
                        <small class="text-muted">Master Mariner, International Shipping</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="fas fa-quote-left fa-2x text-primary opacity-50 mb-3"></i>
                        <p class="mb-4">"Tim yang sangat profesional dan responsif. Sangat direkomendasikan untuk jasa pandu kapal."</p>
                        <div>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <h6 class="mt-3 fw-bold">Michael Tan</h6>
                        <small class="text-muted">CEO, Tan Logistik Group</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="fas fa-quote-left fa-2x text-primary opacity-50 mb-3"></i>
                        <p class="mb-4">"Kapal pandu yang modern dan terawat. Pelayanan yang memuaskan dan harga kompetitif."</p>
                        <div>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <h6 class="mt-3 fw-bold">Sarah Wijaya</h6>
                        <small class="text-muted">Operations Director, PT Samudera Lines</small>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination mt-4 position-relative"></div>
        </div>
    </div>
</section>

<!-- Partner -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Mitra Kerja Sama</h2>
            <p class="subtitle">Bersama membangun kemitraan yang kuat dan saling menguntungkan</p>
        </div>
        <div class="row">
            @forelse($partnerships as $partner)
            <div class="col-xl-2 col-lg-3 col-md-3 col-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                <div class="card text-center p-3 h-100 border shadow-sm rounded-4">
                    @if($partner->logo)
                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->partner_name }}" class="mx-auto" style="height: 60px; object-fit: contain;">
                    @else
                    <div style="height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-building fa-3x text-secondary"></i>
                    </div>
                    @endif
                    <p class="small fw-bold mt-2 mb-0">{{ $partner->partner_name }}</p>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada mitra.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: linear-gradient(135deg, #0066cc, #003366);">
    <div class="container text-center text-white">
        <div data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-4">Siap Bekerja Sama dengan Kami?</h2>
            <p class="lead mb-4">Hubungi kami sekarang untuk mendapatkan layanan pandu kapal terbaik</p>
            <a href="{{ route('contact') }}" class="btn btn-warning btn-lg rounded-pill px-5">
                <i class="fas fa-envelope"></i> Hubungi Kami Sekarang
            </a>
        </div>
    </div>
</section>

<script>
    // Swiper Testimonial
    new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: { 768: { slidesPerView: 2 }, 992: { slidesPerView: 3 } }
    });
</script>
@endsection
