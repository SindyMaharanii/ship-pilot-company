@extends('layouts.app')

@section('title', 'Hubungi Kami - Ship Pilot Company')

@section('content')
<!-- Hero Section -->
<section class="page-hero position-relative" style="height: 400px; background: linear-gradient(135deg, #001a33 0%, #003366 100%);">
    <div class="container h-100 d-flex align-items-center">
        <div class="text-white" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead">Hubungi kami untuk informasi lebih lanjut</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-5">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert" data-aos="fade-up">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="row g-4">
            <!-- TELEPON -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card border-0 shadow-lg rounded-4 text-center h-100">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background: #e3f2fd; color: #0066cc;">
                            <i class="fas fa-phone-alt" style="font-size: 28px;"></i>
                        </div>
                        <h5 class="fw-bold">Telepon</h5>
                        <p class="text-muted mb-2">Layanan 24 Jam</p>
                        <h6 class="text-primary">{{ $contact->phone ?? '+62 123 4567 890' }}</h6>
                        <hr>
                        <small class="text-muted">Emergency Hotline: +62 123 4567 891</small>
                    </div>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-lg rounded-4 text-center h-100">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background: #e3f2fd; color: #0066cc;">
                            <i class="fas fa-envelope" style="font-size: 28px;"></i>
                        </div>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted mb-2">Balasan dalam 24 jam</p>
                        <h6 class="text-primary">{{ $contact->email ?? 'info@shippilot.com' }}</h6>
                        <hr>
                        <small class="text-muted">maharanisindy@gmail.com</small>
                    </div>
                </div>
            </div>

            <!-- ALAMAT -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-lg rounded-4 text-center h-100">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background: #e3f2fd; color: #0066cc;">
                            <i class="fas fa-map-marker-alt" style="font-size: 28px;"></i>
                        </div>
                        <h5 class="fw-bold">Alamat</h5>
                        <p class="text-muted mb-2">Kantor Cabang Batam Wilayah 1</p>
                        <h6 class="text-primary">{{ $contact->address ?? 'Batam, Kepulauan Riau' }}</h6>
                        <hr>
                        <small class="text-muted">Lihat peta di bawah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        


<!-- Contact Form & Map -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-gradient-primary text-white py-3 rounded-top-4">
                        <h4 class="fw-bold mb-0"><i class="fas fa-paper-plane me-2"></i> Kirim Pesan</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                                    </div>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                                    </div>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-phone text-primary"></i></span>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Perusahaan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                                        <input type="text" name="company" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Subjek <span class="text-danger">*</span></label>
                                <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                                    <option value="">Pilih Subjek</option>
                                    <option value="informasi">Informasi Layanan</option>
                                    <option value="kerjasama">Pengajuan Kerja Sama</option>
                                    <option value="keluhan">Keluhan/Saran</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tipe Kerja Sama (Jika ada)</label>
                                <input type="text" name="partnership_type" class="form-control" placeholder="Contoh: Joint Venture, Kerjasama Operasional, Preferred Partner">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pesan <span class="text-danger">*</span></label>
                                <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required placeholder="Tulis pesan Anda di sini..."></textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agree" required>
                                <label class="form-check-label small" for="agree">
                                    Saya setuju dengan <a href="#" class="text-primary">kebijakan privasi</a> dan data saya akan digunakan sesuai ketentuan.
                                </label>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100 py-2 rounded-pill fw-bold" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-gradient-primary text-white py-3 rounded-top-4">
                        <h4 class="fw-bold mb-0"><i class="fas fa-map me-2"></i> Lokasi Kantor</h4>
                    </div>
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0027353343007!2d104.00787040000002!3d1.1585188000000048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d989b1eefdfda5%3A0xeef92a8b168a568b!2sPelindo%20Jasa%20Maritim!5e0!3m2!1sid!2sid!4v1780043818157!5m2!1sid!2sid" 
                            width="100%" 
                            height="400" 
                            style="border:0; border-radius: 0 0 12px 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center">
                            <div class="col-6">
                                <i class="fas fa-clock text-primary mb-1 d-block"></i>
                                <strong>Senin - Kamis</strong>
                                <small class="d-block">08:00 - 17:00</small>
                            </div>
                            <div class="col-6">
                                <i class="fas fa-clock text-primary mb-1 d-block"></i>
                                <strong>Jumat</strong>
                                <small class="d-block">07:30 - 16:30</small>
                            </div>
                        </div>
                        <div class="row text-center mt-2">
                            <div class="col-12">
                                <small class="text-muted">
                                    <i class="fas fa-times-circle text-danger me-1"></i> 
                                    Sabtu - Minggu & Hari Libur Nasional: TUTUP
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="card border-0 shadow-lg rounded-4 mt-4">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-3">Ikuti Kami di Media Sosial</h5>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="btn btn-outline-success rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Pertanyaan Umum</h2>
            <p class="subtitle">Informasi yang sering ditanyakan seputar layanan kami</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion" data-aos="fade-up">
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <strong><i class="fas fa-clock text-primary me-2"></i> Bagaimana cara mengajukan layanan pandu?</strong>
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Anda dapat mengajukan layanan melalui form kontak di atas, atau menghubungi hotline kami di +62 123 4567 890. Tim kami akan segera merespon permohonan Anda.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <strong><i class="fas fa-handshake text-primary me-2"></i> Bagaimana prosedur pengajuan kerja sama?</strong>
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Silakan isi form kontak dengan memilih subjek "Pengajuan Kerja Sama" dan jelaskan jenis kerja sama yang Anda inginkan. Tim partnership kami akan menghubungi Anda untuk diskusi lebih lanjut.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <strong><i class="fas fa-tachometer-alt text-primary me-2"></i> Berapa lama waktu respon layanan?</strong>
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Waktu respon rata-rata 15-30 menit untuk area prioritas. Untuk area lainnya maksimal 1 jam setelah permohonan diterima.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <strong><i class="fas fa-credit-card text-primary me-2"></i> Apa metode pembayaran yang tersedia?</strong>
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Kami menerima pembayaran melalui transfer bank, kartu kredit, dan untuk mitra korporasi dapat dilakukan secara invoice dengan tenor yang disepakati.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    // Initialize contact map
    var contactMap = L.map('contactMap').setView([-6.2088, 106.8456], 15);
    
    // Gunakan tile layer yang benar (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(contactMap);
    
    // Custom icon untuk marker
    var officeIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `<div style="background-color: #0066cc; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                <i class="fas fa-building" style="color: white; font-size: 20px;"></i>
              </div>`,
        iconSize: [40, 40],
        popupAnchor: [0, -20]
    });
    
    // Marker dengan koordinat kantor Anda
    // Ganti koordinat ini dengan koordinat kantor sebenarnya
    var officeLat = -6.2088;  // Ganti dengan latitude kantor Anda
    var officeLng = 106.8456; // Ganti dengan longitude kantor Anda
    
    L.marker([officeLat, officeLng], {icon: officeIcon})
        .addTo(contactMap)
        .bindPopup(`
            <b>Ship Pilot Company</b><br>
            Kantor Pusat<br>
            Jl. Contoh No. 123, Jakarta<br>
            <a href="https://maps.app.goo.gl/5Bnmo6wvfAN2r8a29" target="_blank" style="color: #0066cc;">
                <i class="fas fa-external-link-alt"></i> Buka di Google Maps
            </a>
        `)
        .openPopup();
</script>
@endsection

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0066cc, #00aaff);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #0066cc, #00aaff);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,204,0.3);
        color: white;
    }
</style>
@endsection