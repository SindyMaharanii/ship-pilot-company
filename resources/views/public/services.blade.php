@extends('layouts.app')

@section('title', 'Layanan Kami - PT Pelindo Jasa Maritim Batam')

@section('content')
<!-- Hero Section -->
<section class="page-hero position-relative" style="height: 400px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3">Layanan Maritim</h1>
            <p class="lead">Solusi layanan kemaritiman terintegrasi, andal, dan berkelas dunia di perairan Batam</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Layanan</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Tiga Pilar Utama Layanan SPJM</h2>
            <p class="subtitle text-muted">Sebagai penyedia layanan terintegrasi (one-stop service), operasional SPJM didukung oleh pilar-pilar utama:</p>
        </div>
        <div class="row">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-hover border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="service-icon-large text-center mb-4">
                                <div class="bg-gradient-primary rounded-circle p-3 d-inline-block">
                                    <!-- ICON DEFAULT SHIP (TANPA ICON DARI DATABASE) -->
                                    <i class="fas fa-ship fa-3x text-white"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold text-center mb-3">{{ $service->name }}</h4>
                            <p class="text-muted text-center mb-4">{{ $service->description }}</p>
                            
                            @if($service->procedure)
                            <div class="mb-3">
                                <h6 class="fw-bold">
                                    <i class="fas fa-list-check text-primary me-2"></i> Prosedur Layanan:
                                </h6>
                                <p class="small text-muted mb-0">{{ $service->procedure }}</p>
                            </div>
                            @endif
                            
                            @if($service->advantages)
                            <div class="mb-3">
                                <h6 class="fw-bold">
                                    <i class="fas fa-star text-primary me-2"></i> Keunggulan:
                                </h6>
                                <p class="small text-muted mb-0">{{ $service->advantages }}</p>
                            </div>
                            @endif
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-gradient rounded-pill px-4 w-100">Ajukan Layanan <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada data pilar layanan yang tersedia.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Service Process (Alur Pelayanan Digital) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Mekanisme Pengajuan Layanan (Sistem Phinnisi)</h2>
            <p class="subtitle text-muted">Mekanisme pelayanan kapal yang terintegrasi penuh secara digital demi transparansi dan efisiensi</p>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="text-center">
                    <div class="process-step bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="display-6 fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold">E-Booking Mandiri</h5>
                    <p class="text-muted small">Perusahaan pelayaran melakukan request pelayanan kapal melalui sistem Phinnisi terintegrasi Inaportnet.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="process-step bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="display-6 fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold">Verifikasi & Penjadwalan</h5>
                    <p class="text-muted small">Sistem memverifikasi dokumen secara digital dan menyusun rencana kerja pandu & tunda (PPK/SPK).</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="process-step bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="display-6 fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold">Eksekusi Lapangan</h5>
                    <p class="text-muted small">Petugas pandu (Pilot) dan armada kapal tunda melaksanakan pemanduan kapal ke/dari dermaga.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="process-step bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="display-6 fw-bold">4</span>
                    </div>
                    <h5 class="fw-bold">Billing & Release</h5>
                    <p class="text-muted small">E-Nota tagihan diterbitkan secara otomatis secara elektronik untuk mendukung transparansi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <p class="subtitle text-muted">Pertanyaan seputar regulasi dan standar pelayanan SPJM di Wilayah Kerja Batam</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion" data-aos="fade-up">
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <strong>Bagaimana cara mengajukan permohonan jasa maritim SPJM Batam?</strong>
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Pengajuan permohonan wajib dilakukan secara digital melalui sistem aplikasi <strong>Phinnisi</strong> yang sudah terintegrasi dengan <strong>Inaportnet</strong> Kementerian Perhubungan BUMN Pelindo. Kami tidak menerima pengajuan manual guna menjaga transparansi pelayanan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <strong>Berapa standar kapasitas kapal tunda (tugboat) yang dioperasikan SPJM Batam?</strong>
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Kami mengoperasikan armada kapal penunda berstandar internasional dengan berbagai kapasitas daya kuda (Horse Power / HP) yang memadai untuk melayani kapal kargo kecil, kontainer, hingga kapal tanker raksasa yang melintasi Selat Malaka dan wilayah labuh jangkar Batam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <strong>Apakah seluruh SDM Pandu SPJM Batam bersertifikat resmi?</strong>
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Ya, 100% petugas pandu (Marine Pilot) kami merupakan profesional yang memegang sertifikasi resmi dari Direktorat Jenderal Perhubungan Laut dan dilatih khusus untuk menguasai karakteristik geografis perairan Selat Malaka dan Kepulauan Riau yang padat.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <strong>Apakah layanan marine SPJM beroperasi selama 24 jam?</strong>
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Tentu. Layanan operasional pemanduan dan penundaan kapal SPJM Batam melayani pelanggan penuh selama 24 jam sehari, 7 hari seminggu (24/7) guna menjamin kelancaran arus logistik laut nasional maupun internasional.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #004080, #0066cc);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #004080, #0066cc);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #002b59, #004d99);
        color: white;
        box-shadow: 0 4px 15px rgba(0,64,128,0.3);
    }
    .process-step {
        transition: all 0.3s ease;
    }
    .process-step:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(0,102,204,0.3);
    }
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection