@extends('layouts.app')

@section('title', 'Mitra Kerja Sama - SPJM Batam')

@section('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #002f6c, #0066cc);
    }
    .partner-card {
        transition: all 0.3s ease;
    }
    .partner-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    .partner-logo-img {
        transition: all 0.3s ease;
    }
    .partner-card:hover .partner-logo-img {
        transform: scale(1.05);
    }
    .partner-testimonial-swiper {
        padding-bottom: 50px;
    }
    .swiper-pagination-bullet-active {
        background: #0066cc !important;
    }
</style>
@endsection

@section('content')
<section class="page-hero position-relative" style="height: 400px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3">Mitra Kerja Sama</h1>
            <p class="lead">Bersama membangun sinergi pelayanan kepanduan dan kemaritiman yang andal di wilayah perairan Batam</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Mitra</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <div class="card border-0 shadow-lg rounded-4 bg-gradient-primary text-white overflow-hidden">
                    <div class="card-body p-5">
                        <i class="fas fa-handshake fa-4x mb-3"></i>
                        <h2 class="fw-bold mb-3">Sinergi & Kolaborasi Kemitraan Maritim</h2>
                        <p class="lead mb-4">Kami terbuka untuk menjalin kemitraan strategis dengan keagenan kapal, perusahaan pelayaran, dan stakeholders maritim guna meningkatkan efisiensi operasional pelabuhan.</p>
                        <a href="{{ route('contact') }}" class="btn btn-warning btn-lg rounded-pill px-5">
                            <i class="fas fa-envelope me-2"></i> Ajukan Kerja Sama Kemitraan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Keuntungan Bermitra dengan SPJM Batam</h2>
            <p class="subtitle">Kolaborasi prima demi kelancaran arus logistik dan keselamatan pelayaran</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-anchor text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Prioritas Pelayanan Pandu</h5>
                    <p class="text-muted">Alokasi waktu dan kesiapan petugas pandu (Pilot) serta kapal tunda yang responsif untuk kelancaran *berthing* dan *unberthing*.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-shield-alt text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Standar Safety Internasional</h5>
                    <p class="text-muted">Jaminan penanganan pemanduan kapal yang memenuhi regulasi keselamatan pelayaran nasional dan ISPO/ISM Code.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-network-wired text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Integrasi Sistem Sistem digital</h5>
                    <p class="text-muted">Kemudahan koordinasi bersandar melalui platform monitoring posisi kapal terpadu secara real-time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Mitra Strategis & Pelayaran</h2>
            <p class="subtitle">Otoritas maritim dan perusahaan terpercaya yang bersinergi dalam operasional kepanduan</p>
        </div>
        <div class="row">
            @forelse($partnerships as $partner)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden partner-card">
                    <div class="card-body p-4 text-center">
                        <div class="partner-logo-container mb-3">
                            @if($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->partner_name }}" class="img-fluid partner-logo-img" style="height: 100px; object-fit: contain;">
                            @else
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-building fa-4x text-primary"></i>
                            </div>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-2">{{ $partner->partner_name }}</h4>
                        <p class="text-muted small mb-3">{{ $partner->description }}</p>
                        
                        @if($partner->collaboration_experience)
                        <div class="alert alert-light text-start small mt-3">
                            <i class="fas fa-briefcase text-primary me-2"></i>
                            <strong>Pengalaman Kolaborasi:</strong>
                            <p class="mb-0 mt-1">{{ $partner->collaboration_experience }}</p>
                        </div>
                        @endif
                        
                        @if($partner->partnership_opportunity)
                        <div class="alert alert-info text-start small mt-2">
                            <i class="fas fa-gift text-primary me-2"></i>
                            <strong>Peluang Kemitraan:</strong>
                            <p class="mb-0 mt-1">{{ $partner->partnership_opportunity }}</p>
                        </div>
                        @endif
                        
                        @if($partner->website)
                        <a href="{{ $partner->website }}" target="_blank" class="btn btn-outline-primary rounded-pill mt-3 w-100">
                            <i class="fas fa-external-link-alt me-2"></i> Kunjungi Website
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada data mitra kerja sama yang terdaftar.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Kategori Lingkup Kerja Sama</h2>
            <p class="subtitle">Bentuk kolaborasi pelayanan maritim yang kami laksanakan di kawasan pelabuhan</p>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4" data-aos="flip-left" data-aos-delay="0">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
                    <i class="fas fa-ship fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Pelayanan Pemanduan (Pilotage)</h6>
                    <small class="text-muted">Pemanduan kapal asing dan domestik di perairan wajib pandu Batam</small>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="flip-left" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
                    <i class="fas fa-dolly fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Pelayanan Penundaan (Towage)</h6>
                    <small class="text-muted">Penyediaan kapal tunda (Tugboat) untuk menyandarkan kapal di dermaga</small>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="flip-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
                    <i class="fas fa-file-contract fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Keagenan Kapal (Shipping Agency)</h6>
                    <small class="text-muted">Sinergi pengurusan dokumen dan administrasi clearance pelabuhan</small>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="flip-left" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
                    <i class="fas fa-landmark fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Sinergi Otoritas & Regulator</h6>
                    <small class="text-muted">Kolaborasi keselamatan pelayaran bersama KSOP dan BP Batam</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Tanggapan Mitra Maritim</h2>
            <p class="subtitle">Apa yang mereka katakan mengenai standar pelayanan kepanduan kami</p>
        </div>
        <div class="swiper partner-testimonial-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0">Capt. H. Supriyanto</h6>
                                <small class="text-muted">Operations Manager, PT Pelayaran Nasional Indonesia</small>
                            </div>
                        </div>
                        <p class="text-muted">"Koordinasi pemanduan di wilayah Batam sangat sigap. Kehadiran kapal tunda dan petugas pandu selalu *on-time* sesuai jadwal sandar."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0">Hendrik Wijaya</h6>
                                <small class="text-muted">Pimpinan Cabang, Keagenan Kapal Batam Berjaya</small>
                            </div>
                        </div>
                        <p class="text-muted">"Sistem administrasi kepanduan terintegrasi dengan baik, memudahkan kami sebagai agen kapal untuk mengestimasi waktu *clearance* kapal tangker."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/81.jpg" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0">Capt. Lin Wei Dong</h6>
                                <small class="text-muted">Master Mariner, Regional Shipping Ltd</small>
                            </div>
                        </div>
                        <p class="text-muted">"Excellent maneuver and high safety standard from the pilot team during tough wind conditions at Batam anchorage zone."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination mt-4 position-relative"></div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.partner-testimonial-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                },
            });
        }
    });
</script>
@endsection