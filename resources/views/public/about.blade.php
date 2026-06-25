@extends('layouts.app')

@section('title', 'Tentang Kami - Ship Pilot Company')

@section('content')
<!-- Hero Section -->
<section class="page-hero position-relative" style="height: 400px; background: linear-gradient(135deg, #001a33 0%, #003366 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('https://images.unsplash.com/photo-1572213426852-0e4edc62e5b3?w=1920&h=400&fit=crop') center/cover no-repeat; opacity: 0.3;"></div>
    <div class="container h-100 position-relative d-flex align-items-center">
        <div class="text-white" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-3">Tentang Perusahaan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Tentang Kami</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Company Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop" alt="PT Pelindo Jasa Maritim Cabang Batam" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute bottom-0 end-0 bg-primary text-white p-3 rounded-start-4" style="transform: translateY(20px);">
                        <div class="text-center">
                            <div class="display-4 fw-bold">{{ date('Y') - 2021 }}+</div>
                            <small>Tahun Pasca Merger</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="mb-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3" style="border: 1px solid rgba(0,102,204,0.2);">
    <i class="fas fa-building me-1"></i> Profil Perusahaan
</span>
                    <h2 class="display-5 fw-bold mb-3">{{ $company->name ?? 'PT Pelindo Jasa Maritim Cabang Batam' }}</h2>
                    <p class="lead text-muted">{{ $company->description ?? 'Subholding PT Pelabuhan Indonesia (Persero) yang berfokus pada penyediaan layanan jasa purnajual maritim yang terintegrasi, andal, dan mengutamakan keselamatan tinggi di wilayah perairan Batam dan sekitarnya.' }}</p>
                </div>
                
                <div class="row mt-4">
                    <!-- 1. Armada Tugboat -->
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 55px; height: 55px; min-width: 55px; background: #e3f2fd; color: #0066cc;">
                                <i class="fas fa-ship" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 14px;">Armada Tugboat</div>
                                <small class="text-muted" style="font-size: 11px;">Kapal Tunda &amp; Pandu</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 2. Marine Services -->
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 55px; height: 55px; min-width: 55px; background: #e3f2fd; color: #0066cc;">
                                <i class="fas fa-anchor" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 14px;">Marine Services</div>
                                <small class="text-muted" style="font-size: 11px;">Pemanduan &amp; Penundaan</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 3. Mitra Strategis -->
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 55px; height: 55px; min-width: 55px; background: #e3f2fd; color: #0066cc;">
                                <i class="fas fa-handshake" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 14px;">Mitra Strategis</div>
                                <small class="text-muted" style="font-size: 11px;">Keagenan &amp; Pelayaran</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 4. Kawasan Batam -->
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 55px; height: 55px; min-width: 55px; background: #e3f2fd; color: #0066cc;">
                                <i class="fas fa-map-marked-alt" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 14px;">Kawasan Batam</div>
                                <small class="text-muted" style="font-size: 11px;">Perairan Selat Malaka</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah Perusahaan dengan Timeline -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Sejarah Perusahaan</h2>
            <p class="subtitle">PT Pelindo Jasa Maritim (SPJM) merupakan anak perusahaan dari PT Pelabuhan Indonesia (Persero) yang bergerak di bidang penyediaan jasa kemaritiman terintegrasi. Pasca-merger pelabuhan nasional pada tahun 2021, SPJM hadir di Batam untuk mengonsolidasikan dan meningkatkan standar layanan marine (seperti pemanduan, penundaan, penyediaan air, dan logistik maritim). Berada di posisi geografis yang super strategis dekat Selat Malaka, SPJM Batam berkomitmen penuh menjaga keselamatan pelayaran dan efisiensi waktu tambat kapal (port stay) bagi industri maritim domestik maupun internasional.</p>
        </div>
        <div class="timeline" data-aos="fade-up">
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">Era Pra-Integrasi (Pelindo I)</div>
                    <h5 class="fw-bold">Sebelum 2021</h5>
                    <p class="text-muted">Sebelum dilakukannya integrasi pelabuhan nasional, pelayanan jasa kepelabuhanan dan maritim di wilayah Batam, Kepulauan Riau, dikelola oleh PT Pelabuhan Indonesia I (Persero) atau Pelindo I melalui kantor cabang domestik setempat. Fokus utamanya adalah melayani arus selat malaka dan pemanduan kapal.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">Merger Akbar & Kelahiran SPJM</div>
                    <h5 class="fw-bold">01 Oktober 2021</h5>
                    <p class="text-muted">Presiden Joko Widodo meresmikan penggabungan (merger) empat wilayah kerja Pelindo (Pelindo I, II, III, dan IV) menjadi satu PT Pelabuhan Indonesia (Persero) melalui PP No. 101 Tahun 2021. Bersamaan dengan ini, dibentuk sub-holding PT Pelindo Jasa Maritim (SPJM) sebagai entitas yang mengoordinasikan seluruh layanan laut, pemanduan (piloting), penundaan (towage), serta fasilitas kemaritiman lainnya di seluruh Indonesia.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">Serah Operasi & Ekspansi Wilayah Batam</div>
                    <h5 class="fw-bold">Januari 2022</h5>
                    <p class="text-muted">Secara bertahap, Pelindo (Holding) menyerahkan operasional bisnis pelayanan jasa maritim kepada SPJM secara nasional, termasuk wilayah strategis Batam. Langkah ini diambil guna menstandardisasi pelayanan pemanduan dan penundaan kapal di Selat Malaka serta area labuh jangkar perairan Batam demi meningkatkan daya saing logistik laut internasional.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">Transformasi Digital & Optimalisasi Layanan</div>
                    <h5 class="fw-bold">2023 - Sekarang</h5>
                    <p class="text-muted">SPJM Batam berfokus penuh pada digitalisasi sistem manajemen maritim (seperti integrasi ke sistem Phinnisi / Inaportnet). Batam diposisikan sebagai salah satu hub aktivitas maritim krusial karena berbatasan langsung dengan jalur perdagangan global tersibuk di dunia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-eye text-primary fa-3x"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi</h3>
                        <p class="text-muted text-center lead">{{ $company->vision ?? 'Menjadi pemimpin jasa kemaritiman yang terintegrasi dan berkelas dunia.' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-bullseye text-primary fa-3x"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary mt-1 me-3"></i>
                                <span class="text-muted">Mewujudkan jaringan ekosistem maritim nasional melalui pengelolaan jasa kemaritiman yang handal, efisien, agile dan memenuhi harapan seluruh stakeholder untuk mendukung pertumbuhan ekonomi indonesia.</span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nilai-Nilai Perusahaan (AKHLAK) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Nilai-Nilai Perusahaan</h2>
            <p class="subtitle text-muted">Core values AKHLAK yang menjadi dasar operasional kami di SPJM</p>
        </div>
        <div class="row">
            <!-- 1. AMANAH -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-user-check text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Amanah</h5>
                    <p class="text-muted">Memegang teguh kepercayaan yang diberikan dengan penuh tanggung jawab dan moralitas tinggi.</p>
                </div>
            </div>

            <!-- 2. KOMPETEN -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-graduation-cap text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Kompeten</h5>
                    <p class="text-muted">Terus belajar, mengembangkan kapabilitas diri, dan menyelesaikan tugas dengan kualitas terbaik.</p>
                </div>
            </div>

            <!-- 3. HARMONIS -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-hands text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Harmonis</h5>
                    <p class="text-muted">Saling peduli, menghargai perbedaan latar belakang, dan membangun lingkungan kerja yang kondusif.</p>
                </div>
            </div>

            <!-- 4. LOYAL -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-heart text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Loyal</h5>
                    <p class="text-muted">Berdedikasi tinggi dan mengutamakan kepentingan Bangsa, Negara, serta menjaga nama baik perusahaan.</p>
                </div>
            </div>

            <!-- 5. ADAPTIF -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-sync-alt text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Adaptif</h5>
                    <p class="text-muted">Cepat menyesuaikan diri, terus berinovasi mengikuti teknologi, dan bertindak proaktif menghadapi perubahan.</p>
                </div>
            </div>

            <!-- 6. KOLABORATIF -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mx-auto mb-3">
                        <i class="fas fa-handshake text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Kolaboratif</h5>
                    <p class="text-muted">Membangun kerja sama yang sinergis dan terbuka dengan berbagai pihak untuk memberi nilai tambah.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sertifikasi -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Sertifikasi & Penghargaan</h2>
            <p class="subtitle">Pengakuan atas kualitas layanan kami</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-6 mb-4" data-aos="zoom-in" data-aos-delay="0">
                <div class="text-center">
                    <i class="fas fa-certificate text-primary fa-4x mb-3"></i>
                    <h6 class="fw-bold">ISO 9001:2015</h6>
                    <small class="text-muted">Quality Management</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="text-center">
                    <i class="fas fa-certificate text-primary fa-4x mb-3"></i>
                    <h6 class="fw-bold">ISO 14001:2015</h6>
                    <small class="text-muted">Environment Management</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="text-center">
                    <i class="fas fa-shield-alt text-primary fa-4x mb-3"></i>
                    <h6 class="fw-bold">OHSAS 18001</h6>
                    <small class="text-muted">Safety Management</small>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-center">
                    <i class="fas fa-trophy text-primary fa-4x mb-3"></i>
                    <h6 class="fw-bold">Best Marine Service</h6>
                    <small class="text-muted">2023 Award</small>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .page-hero .breadcrumb-item+.breadcrumb-item::before {
        color: white;
        content: "›";
    }
</style>
@endsection