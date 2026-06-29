<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ship Pilot Company - Perusahaan Kapal Pandu Profesional')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        /* ===== CSS VARIABLES - WARNA KONSISTEN ===== */
        :root {
            --primary-blue: #0066cc;
            --primary-blue-dark: #004d99;
            --primary-blue-light: #e6f0ff;
            --primary-blue-gradient: linear-gradient(135deg, #0066cc, #004d99);
        }

        /* Custom Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        /* ===== TOMBOL PRIMARY ===== */
        .btn-primary {
            background: var(--primary-blue) !important;
            border-color: var(--primary-blue) !important;
        }
        .btn-primary:hover {
            background: var(--primary-blue-dark) !important;
            border-color: var(--primary-blue-dark) !important;
        }
        .btn-primary:active {
            background: var(--primary-blue-dark) !important;
            border-color: var(--primary-blue-dark) !important;
        }
        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.3) !important;
        }
        
        /* ===== LINK ===== */
        a {
            color: var(--primary-blue);
        }
        a:hover {
            color: var(--primary-blue-dark);
        }
        .text-primary {
            color: var(--primary-blue) !important;
        }
        
        /* ===== BACKGROUND ===== */
        .bg-primary {
            background: var(--primary-blue) !important;
        }
        .bg-gradient-primary {
            background: var(--primary-blue-gradient) !important;
        }
        
        /* ===== BADGE ===== */
        .badge-primary {
            background: var(--primary-blue) !important;
        }
        
        /* ===== CARD STATS ===== */
        .card-stats {
            background: var(--primary-blue) !important;
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
        
        /* ===== BREADCRUMB ===== */
        .breadcrumb-item a {
            color: var(--primary-blue) !important;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            color: var(--primary-blue-dark) !important;
            text-decoration: underline;
        }
        .breadcrumb-item.active {
            color: #6c757d !important;
        }
        
        /* ===== NAVBAR ===== */
        .navbar.bg-primary {
            background: var(--primary-blue) !important;
        }
        .navbar {
            transition: all 0.3s ease;
            padding: 1rem 0;
        }
        .navbar-scrolled {
            background: rgba(0, 51, 102, 0.95) !important;
            backdrop-filter: blur(10px);
            padding: 0.5rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link:hover {
            transform: translateY(-2px);
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #ffc107;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 80%;
        }
        .admin-badge {
            background: #ffc107;
            color: #000;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }
        
        /* ===== BUTTON GRADIENT ===== */
        .btn-gradient {
            background: var(--primary-blue-gradient);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,102,204,0.3);
            color: white;
        }
        .btn-outline-gradient {
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            transition: all 0.3s ease;
        }
        .btn-outline-gradient:hover {
            background: var(--primary-blue-gradient);
            color: white;
            transform: translateY(-3px);
        }
        
        /* ===== CARD HOVER ===== */
        .card-hover {
            transition: all 0.4s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        /* ===== SECTION TITLE ===== */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-blue-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .section-title .subtitle {
            color: #666;
            font-size: 1.1rem;
        }
        
        /* ===== FLOATING ANIMATION ===== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        /* ===== PULSE ANIMATION ===== */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
        
        /* ===== COUNTER NUMBER ===== */
        .counter-number {
            font-size: 3rem;
            font-weight: 800;
            background: var(--primary-blue-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            background: linear-gradient(135deg, #001a33 0%, #000d1a 100%);
            position: relative;
            overflow: hidden;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-blue), #00aaff, var(--primary-blue));
        }
        
        /* ===== TIMELINE ===== */
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-blue), #00aaff);
            transform: translateX(-50%);
        }
        .timeline-item {
            margin-bottom: 50px;
            position: relative;
        }
        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: relative;
            width: calc(50% - 40px);
        }
        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
        }
        .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            width: 20px;
            height: 2px;
            background: var(--primary-blue);
        }
        .timeline-item:nth-child(odd) .timeline-content::before {
            left: -20px;
        }
        .timeline-item:nth-child(even) .timeline-content::before {
            right: -20px;
        }
        .timeline-year {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .timeline::before {
                left: 20px;
            }
            .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
            }
        }
        
        /* ===== SERVICE ICON ===== */
        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-blue-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }
        .card-hover:hover .service-icon {
            transform: scale(1.1) rotate(360deg);
        }
        .service-icon i {
            font-size: 2rem;
            color: white;
        }
        
        /* ===== STATS SECTION ===== */
        .stats-section {
            background: var(--primary-blue-gradient);
            position: relative;
            overflow: hidden;
        }
        .stats-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }
        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        /* ===== PARTNER LOGO ===== */
        .partner-logo {
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        .partner-logo:hover {
            filter: grayscale(0);
            opacity: 1;
            transform: scale(1.05);
        }
        
        /* ===== LOADING ===== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.5s ease;
        }
        .loader {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ===== BACK TO TOP ===== */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary-blue-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        .back-to-top:hover {
            transform: translateY(-5px);
        }
        
        /* ===== ADMIN PANEL BAR ===== */
        .admin-panel-bar {
            background: #fff9e6;
            border: 1px solid #ffc107;
            border-radius: 12px;
            padding: 14px 24px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.15);
        }
        .admin-panel-bar .admin-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-panel-bar .admin-title i {
            font-size: 20px;
            color: #f59e0b;
        }
        .admin-panel-bar .admin-title span {
            font-weight: 700;
            font-size: 16px;
            color: #1a1a2e;
        }
        .admin-panel-bar .badge-admin {
            background: var(--primary-blue);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .admin-panel-bar .btn-group-admin {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .admin-panel-bar .btn-group-admin .btn {
            border-radius: 8px;
            font-size: 13px;
            padding: 6px 16px;
            font-weight: 500;
        }
        
        /* ===== ADMIN EDIT BUTTON ===== */
        .admin-edit-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            background: rgba(255, 193, 7, 0.95);
            color: #1a1a2e;
            border: none;
            border-radius: 30px;
            padding: 5px 16px;
            font-size: 11px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255,193,7,0.3);
            display: flex;
            align-items: center;
            gap: 6px;
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
            font-size: 10px;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .admin-panel-bar {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
                padding: 16px;
            }
            .admin-panel-bar .btn-group-admin {
                justify-content: center;
            }
            .section-title h2 {
                font-size: 1.8rem;
            }
            .counter-number {
                font-size: 2rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loader"></div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-ship"></i> PORTALIS
            @auth
                @if(auth()->user()->is_admin)
                    <span class="admin-badge">ADMIN</span>
                @endif
            @endauth
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fleet') }}">Armada</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tracking') }}">Pelacakan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('partnerships') }}">Mitra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                </li>
                @auth
                    @if(auth()->user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}" style="color: #ffc107;">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                     <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contacts.index') }}" style="color: #ffc107;">
            <i class="fas fa-envelope"></i> Pesan Masuk
            @php $unread = App\Models\Contact::where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="badge bg-danger" style="font-size: 9px;">{{ $unread }}</span>
            @endif
        </a>
    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.ships.index') }}" style="color: #ffc107;">
                            <i class="fas fa-ship"></i> Kelola Armada
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="text-decoration: none;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-3 rounded-pill" href="{{ route('login') }}">
                            <i class="fas fa-key"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main style="margin-top: 76px;">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <h5><i class="fas fa-ship"></i> Pusat Operasional Real-Time Armada & Layanan Informasi SPJM (PORTALIS)</h5>
                <p class="mt-3">Melayani pandu kapal profesional dan terpercaya untuk keselamatan pelayaran Anda di perairan Indonesia.</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h5>Kontak Kami</h5>
                <p>
                    <i class="fas fa-map-marker-alt me-2"></i> Batam, Kepulauan Riau<br>
                    <i class="fas fa-phone me-2"></i> (0778) 123456<br>
                    <i class="fas fa-envelope me-2"></i> info@shippilot.com<br>
                    <i class="fas fa-clock me-2"></i> Senin - Kamis: 08:00 - 17:00<br>
                    <i class="fas fa-clock me-2"></i> Jumat: 07:30 - 16:30
                </p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h5>Newsletter</h5>
                <p class="mt-3">Dapatkan informasi terbaru dari kami</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email Anda">
                    <button class="btn btn-warning" type="button">Subscribe</button>
                </div>
            </div>
        </div>
        <hr class="bg-light mt-4">
        <div class="text-center">
            <small>&copy; {{ date('Y') }} Pusat Operasional Real-Time Armada & Layanan Informasi SPJM. All rights reserved. | Designed with <i class="fas fa-heart text-danger"></i> by SM</small>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<div class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.umd.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
    
    // Loading Screen
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('loadingOverlay').style.opacity = '0';
            setTimeout(function() {
                document.getElementById('loadingOverlay').style.display = 'none';
            }, 500);
        }, 500);
    });
    
    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 100) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
        
        // Back to Top Button
        const backToTop = document.getElementById('backToTop');
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
    
    // Back to Top Function
    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Counter Animation
    function animateCounter(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.innerText = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    // Trigger counter when in view
    const observerOptions = {
        threshold: 0.5
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter-number');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, 0, target, 2000);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.stats-section').forEach(section => {
        observer.observe(section);
    });
</script>
@stack('scripts')
</body>
</html>