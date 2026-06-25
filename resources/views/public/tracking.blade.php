@extends('layouts.app') 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #0066cc, #004d99);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .tracking-container {
            display: flex;
            height: calc(100vh - 70px);
        }
        .sidebar {
            width: 380px;
            background: white;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .sidebar-header {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }
        .search-box {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .search-box input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }
        .ships-list {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }
        .ship-item {
            padding: 12px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .ship-item:hover {
            background: #e3f2fd;
            transform: translateX(5px);
            border-left-color: #0066cc;
        }
        .ship-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 1rem;
        }
        .ship-pilot {
            font-size: 12px;
            color: #0066cc;
            margin-bottom: 3px;
        }
        .ship-pilot i {
            margin-right: 3px;
        }
        .ship-call {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }
        .ship-status {
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 12px;
            display: inline-block;
        }
        .status-available { background: #d4edda; color: #155724; }
        .status-on_duty { background: #d1ecf1; color: #0c5460; }
        .status-maintenance { background: #fff3cd; color: #856404; }
        .map-container {
            flex: 1;
            position: relative;
        }
        #map {
            height: 100%;
            width: 100%;
        }
        .loading {
            text-align: center;
            padding: 20px;
            color: #999;
        }
        .popup-ship {
            min-width: 260px;
            padding: 8px;
        }
        .popup-ship h4 {
            color: #0066cc;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .popup-ship hr {
            margin: 8px 0;
        }
        .pilot-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0066cc;
        }
        .pilot-avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0066cc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        footer {
            background: linear-gradient(135deg, #001a33, #000d1a);
            color: white;
            padding: 30px;
            text-align: center;
        }
        @media (max-width: 768px) {
            .tracking-container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                max-height: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div style="font-size: 1.5rem; font-weight: bold;">
            <i class="fas fa-ship"></i> Ship Pilot Company
        </div>
        <div>
            <a href="/">Beranda</a>
            <a href="/about">Tentang</a>
            <a href="/services">Layanan</a>
            <a href="/fleet">Armada</a>
            <a href="/tracking">Pelacakan</a>
            <a href="/partnerships">Mitra</a>
            <a href="/contact">Kontak</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="tracking-container">
        <!-- Sidebar Kiri -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-ship"></i> Daftar Kapal & Pandu</h3>
                <small>Klik kapal untuk melihat posisi di peta</small>
            </div>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Cari nama kapal atau nama pandu...">
            </div>
            <div class="ships-list" id="shipsList">
                <div class="loading">
                    <i class="fas fa-spinner fa-spin"></i> Memuat data kapal...
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="map-container">
            <div id="map"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-ship"></i> Ship Pilot Company</h5>
                    <p>Melayani pandu kapal profesional dan terpercaya.</p>
                </div>
                <div class="col-md-4">
                    <h5>Kontak Kami</h5>
                    <p>Batam, Kepulauan Riau<br>(0778) 123456<br>info@shippilot.com</p>
                </div>
                <div class="col-md-4">
                    <h5>Jam Kerja</h5>
                    <p>Senin-Kamis: 08:00-17:00<br>Jumat: 07:30-16:30<br>Sabtu-Minggu: Tutup</p>
                </div>
            </div>
            <hr>
            <div>&copy; 2026 Ship Pilot Company. All rights reserved.</div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let map;
        let markers = {};
        let shipsData = [];
        
        // Inisialisasi peta
        function initMap() {
            map = L.map('map').setView([1.1, 103.9], 9);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            console.log('✅ Peta siap');
        }
        
        // Ambil data kapal
        function loadShips() {
            console.log('Mengambil data kapal...');
            $.ajax({
                url: '/api/ship-locations',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data kapal:', data.length);
                    shipsData = data;
                    updateShipList(data);
                    updateMapMarkers(data);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    $('#shipsList').html('<div class="loading">❌ Gagal memuat data</div>');
                }
            });
        }
        
        // Update daftar kapal di sidebar
        function updateShipList(ships) {
            let search = $('#searchInput').val().toLowerCase();
            let filtered = ships.filter(s => 
                s.name.toLowerCase().includes(search) || 
                (s.pilot_name && s.pilot_name.toLowerCase().includes(search))
            );
            
            if (filtered.length === 0) {
                $('#shipsList').html('<div class="loading">📭 Tidak ada kapal</div>');
                return;
            }
            
            let html = '';
            filtered.forEach(ship => {
                let statusClass = '';
                let statusText = '';
                
                if (ship.status === 'available') {
                    statusClass = 'status-available';
                    statusText = 'Tersedia';
                } else if (ship.status === 'on_duty') {
                    statusClass = 'status-on_duty';
                    statusText = 'Bertugas';
                } else {
                    statusClass = 'status-maintenance';
                    statusText = 'Perawatan';
                }
                
                html += `
                    <div class="ship-item" onclick="focusShip(${ship.id}, ${ship.current_latitude || 0}, ${ship.current_longitude || 0})">
                        <div class="ship-name">
                            <i class="fas fa-ship"></i> ${ship.name}
                        </div>
                        ${ship.pilot_name ? `<div class="ship-pilot"><i class="fas fa-user-helmet-safety"></i> Pandu: ${ship.pilot_name}</div>` : ''}
                        <div class="ship-call"><i class="fas fa-id-card"></i> Call Sign: ${ship.call_sign || '-'}</div>
                        <div><span class="ship-status ${statusClass}">${statusText}</span></div>
                    </div>
                `;
            });
            $('#shipsList').html(html);
        }
        
        // Update marker di peta dengan popup lengkap + FOTO PANDU
        function updateMapMarkers(ships) {
            // Hapus marker lama
            for (let id in markers) {
                if (markers[id]) map.removeLayer(markers[id]);
            }
            markers = {};
            
            let markerCount = 0;
            
            ships.forEach(ship => {
                if (ship.current_latitude && ship.current_longitude) {
                    let lat = parseFloat(ship.current_latitude);
                    let lng = parseFloat(ship.current_longitude);
                    let color = '#28a745';
                    let statusIcon = '✅';
                    let statusText = 'Tersedia';
                    
                    if (ship.status === 'on_duty') {
                        color = '#17a2b8';
                        statusIcon = '🚢';
                        statusText = 'Bertugas';
                    } else if (ship.status === 'maintenance') {
                        color = '#ffc107';
                        statusIcon = '🔧';
                        statusText = 'Perawatan';
                    }
                    
                    let icon = L.divIcon({
                        html: `<div style="background:${color}; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid white; box-shadow:0 2px 5px rgba(0,0,0,0.2); cursor:pointer;">
                                    <i class="fas fa-ship" style="color:white; font-size:14px;"></i>
                                </div>`,
                        iconSize: [32, 32],
                        popupAnchor: [0, -16]
                    });
                    
                    // Foto pandu (avatar)
                    let pilotAvatar = '';
                    if (ship.pilot_photo) {
                        pilotAvatar = `<img src="${ship.pilot_photo}" class="pilot-avatar" alt="Pandu">`;
                    } else {
                        pilotAvatar = `<div class="pilot-avatar-placeholder"><i class="fas fa-user fa-2x"></i></div>`;
                    }
                    
                    // Popup dengan informasi lengkap + foto pandu
                    let popupContent = `
                        <div class="popup-ship">
                            <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 10px;">
                                ${pilotAvatar}
                                <div>
                                    <h4 style="margin: 0;"><i class="fas fa-ship"></i> ${ship.name}</h4>
                                    ${ship.pilot_name ? `<div style="color: #0066cc; font-size: 12px;"><i class="fas fa-user-helmet-safety"></i> ${ship.pilot_name}</div>` : ''}
                                </div>
                            </div>
                            <hr>
                            <table style="width:100%; font-size:12px; line-height:1.6;">
                                <tr>
                                    <td style="width:85px;"><i class="fas fa-id-card"></i> <strong>Call Sign:</strong></td>
                                    <td>${ship.call_sign || '-'}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-tag"></i> <strong>Status:</strong></td>
                                    <td>${statusIcon} ${statusText}</small></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-map-marker-alt"></i> <strong>Posisi:</strong></td>
                                    <td>${lat.toFixed(5)}, ${lng.toFixed(5)}</small></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-clock"></i> <strong>Update:</strong></td>
                                    <td>${formatTimeAgo(ship.last_position_update)}</small></td>
                                </tr>
                            </table>
                            <hr>
                            <a href="/ship/${ship.id}" class="btn btn-primary btn-sm w-100" style="font-size:11px;">
                                <i class="fas fa-info-circle"></i> Lihat Detail Kapal
                            </a>
                        </div>
                    `;
                    
                    let marker = L.marker([lat, lng], { icon: icon })
                        .addTo(map)
                        .bindPopup(popupContent, { maxWidth: 300 });
                    
                    // Tooltip saat hover (nama kapal & pandu)
                    let tooltipText = `${ship.name}`;
                    if (ship.pilot_name) tooltipText += ` - Pandu: ${ship.pilot_name}`;
                    marker.bindTooltip(tooltipText, { 
                        permanent: false, 
                        direction: 'top',
                        offset: [0, -18]
                    });
                    
                    markers[ship.id] = marker;
                    markerCount++;
                }
            });
            
            console.log('📍 Marker ditambahkan:', markerCount);
        }
        
        // Format waktu yang lalu
        function formatTimeAgo(dateString) {
            if (!dateString) return 'belum update';
            let date = new Date(dateString);
            let now = new Date();
            let diff = Math.floor((now - date) / 60000);
            
            if (diff < 1) return 'baru saja';
            if (diff < 60) return `${diff} menit lalu`;
            if (diff < 1440) return `${Math.floor(diff / 60)} jam lalu`;
            return `${Math.floor(diff / 1440)} hari lalu`;
        }
        
        // Fokus ke kapal
        function focusShip(id, lat, lng) {
            if (lat && lng && lat !== 0 && lng !== 0) {
                map.setView([lat, lng], 14);
                if (markers[id]) {
                    markers[id].openPopup();
                }
            } else {
                alert('Kapal ini belum memiliki koordinat posisi.');
            }
        }
        
        // Search filter realtime (bisa cari nama kapal atau nama pandu)
        $('#searchInput').on('keyup', function() {
            updateShipList(shipsData);
        });
        
        // Jalankan
        $(document).ready(function() {
            initMap();
            loadShips();
            setInterval(loadShips, 30000);
        });
    </script>
</body>
</html>