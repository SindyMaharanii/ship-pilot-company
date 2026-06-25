@extends('layouts.app')

@section('title', 'Manajemen Kapal Pandu')

@section('styles')
<style>
    /* ===== BADGE STATUS ===== */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-status .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }
    .badge-status.available { background: #dcfce7; color: #166534; }
    .badge-status.available .dot { background: #22c55e; }
    .badge-status.on_duty { background: #dbeafe; color: #1e40af; }
    .badge-status.on_duty .dot { background: #3b82f6; }
    .badge-status.maintenance { background: #fef3c7; color: #92400e; }
    .badge-status.maintenance .dot { background: #f59e0b; }
    .badge-status.offline { background: #fee2e2; color: #991b1b; }
    .badge-status.offline .dot { background: #ef4444; }

    /* ===== CALL SIGN ===== */
    .call-sign {
        font-family: 'Courier New', monospace;
        font-size: 13px;
        color: #475569;
        background: #f1f5f9;
        padding: 3px 12px;
        border-radius: 6px;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    /* ===== TABLE ===== */
    .table-ship thead th {
        background: #f8fafc;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px 16px;
    }
    .table-ship tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-ship tbody tr:hover {
        background: #f8fafc;
    }
    .table-ship tbody tr:last-child td {
        border-bottom: none;
    }

    .table-ship .position-text {
        font-size: 13px;
        color: #64748b;
    }
    .table-ship .position-text i {
        color: #3b82f6;
        margin-right: 4px;
    }
    .table-ship .time-text {
        font-size: 13px;
        color: #94a3b8;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-group {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    .action-group .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        border: none;
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
    }
    .action-group .btn-action:hover {
        transform: scale(1.08);
    }
    .action-group .btn-edit { background: #dbeafe; color: #3b82f6; }
    .action-group .btn-edit:hover { background: #3b82f6; color: white; }
    .action-group .btn-map { background: #dcfce7; color: #22c55e; }
    .action-group .btn-map:hover { background: #22c55e; color: white; }
    .action-group .btn-position { background: #fef3c7; color: #f59e0b; }
    .action-group .btn-position:hover { background: #f59e0b; color: white; }
    .action-group .btn-history { background: #f3e8ff; color: #8b5cf6; }
    .action-group .btn-history:hover { background: #8b5cf6; color: white; }
    .action-group .btn-delete { background: #fee2e2; color: #ef4444; }
    .action-group .btn-delete:hover { background: #ef4444; color: white; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .table-ship {
            font-size: 13px;
        }
        .table-ship thead th,
        .table-ship tbody td {
            padding: 10px 12px;
        }
        .action-group .btn-action {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }
    }
    @media (max-width: 576px) {
        .table-ship {
            font-size: 12px;
        }
        .table-ship thead th,
        .table-ship tbody td {
            padding: 6px 8px;
        }
        .table-ship .call-sign {
            font-size: 11px;
            padding: 1px 8px;
        }
        .badge-status {
            font-size: 10px;
            padding: 3px 10px;
        }
        .action-group .btn-action {
            width: 24px;
            height: 24px;
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    <!-- ===== BREADCRUMB ===== -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" style="color: #3b82f6; text-decoration: none;">
                    <i class="fas fa-home me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" style="color: #94a3b8;">
                <i class="fas fa-ship me-1"></i> Manajemen Kapal
            </li>
        </ol>
    </nav>

    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">
                <i class="fas fa-ship text-primary me-2"></i> Manajemen Kapal Pandu
            </h1>
            <p class="text-muted mb-0">Kelola data armada kapal pandu</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
            <a href="{{ route('admin.ships.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Kapal
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- ===== TABLE ===== -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-ship">
                    <thead>
                        <tr>
                            <th style="width:50px;"><i class="fas fa-hashtag"></i></th>
                            <th><i class="fas fa-ship me-1"></i> Nama Kapal</th>
                            <th><i class="fas fa-broadcast-tower me-1"></i> Call Sign</th>
                            <th><i class="fas fa-tag me-1"></i> Tipe</th>
                            <th><i class="fas fa-circle me-1"></i> Status</th>
                            <th><i class="fas fa-map-pin me-1"></i> Posisi</th>
                            <th><i class="fas fa-clock me-1"></i> Update</th>
                            <th style="width:200px;"><i class="fas fa-cog me-1"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ships as $ship)
                        <tr>
                            <td class="text-center text-muted" style="font-weight:500;">{{ $ship->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($ship->photo)
                                    <img src="{{ Storage::url($ship->photo) }}" alt="{{ $ship->name }}" style="width:32px; height:32px; border-radius:8px; object-fit:cover; border:1px solid #e2e8f0;">
                                    @else
                                    <span style="width:32px; height:32px; border-radius:8px; background:#dbeafe; display:flex; align-items:center; justify-content:center; color:#3b82f6; font-size:14px; border:1px solid #bae6fd;">
                                        <i class="fas fa-ship"></i>
                                    </span>
                                    @endif
                                    {{ $ship->name }}
                                </div>
                            </td>
                            <td><span class="call-sign">{{ $ship->call_sign }}</span></td>
                            <td>{{ $ship->type ?? '-' }}</td>
                            <td>
                                <span class="badge-status {{ $ship->status }}">
                                    <span class="dot"></span>
                                    {{ $ship->status_text ?? $ship->status }}
                                </span>
                            </td>
                            <td>
                                @if($ship->current_latitude && $ship->current_longitude)
                                <span class="position-text">
                                    <i class="fas fa-location-dot"></i>
                                    {{ number_format($ship->current_latitude, 4) }}, {{ number_format($ship->current_longitude, 4) }}
                                </span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="time-text">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $ship->last_position_update ? $ship->last_position_update->diffForHumans() : '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.ships.edit', $ship->id) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('tracking') }}" class="btn-action btn-map" title="Lihat di Peta" target="_blank">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-position" onclick="updatePosition({{ $ship->id }})" title="Update Posisi">
                                        <i class="fas fa-location-dot"></i>
                                    </button>
                                    <a href="{{ route('admin.ships.history', $ship->id) }}" class="btn-action btn-history" title="Riwayat">
                                        <i class="fas fa-history"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-delete" onclick="deleteShip({{ $ship->id }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-ship fa-2x text-muted mb-2 d-block" style="opacity:0.3;"></i>
                                Tidak ada data kapal
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $ships->links() }}
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL UPDATE POSISI ===== -->
<div class="modal fade" id="positionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-location-dot me-2"></i> Update Posisi Kapal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="positionForm">
                <div class="modal-body">
                    <input type="hidden" id="ship_id">
                    <div class="mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" id="latitude" class="form-control" placeholder="Contoh: -6.2088" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" id="longitude" class="form-control" placeholder="Contoh: 106.8456" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="status" class="form-select">
                            <option value="available">Tersedia</option>
                            <option value="on_duty">Bertugas</option>
                            <option value="maintenance">Perawatan</option>
                            <option value="offline">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Posisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function deleteShip(id) {
    if(confirm('Apakah Anda yakin ingin menghapus kapal ini?')) {
        $.ajax({
            url: `/admin/ships/${id}`,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) { location.reload(); },
            error: function(xhr) { alert('Gagal menghapus kapal!'); }
        });
    }
}

let currentShipId = null;
function updatePosition(id) {
    currentShipId = id;
    $('#ship_id').val(id);
    $('#latitude').val('');
    $('#longitude').val('');
    $('#positionModal').modal('show');
}

$('#positionForm').on('submit', function(e) {
    e.preventDefault();

    let lat = $('#latitude').val();
    let lng = $('#longitude').val();
    let status = $('#status').val();

    if (!lat || !lng) {
        alert('Latitude dan Longitude harus diisi!');
        return;
    }

    let submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Memproses...');

    $.ajax({
        url: `/admin/ships/${currentShipId}/update-position`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            latitude: lat,
            longitude: lng,
            status: status
        },
        success: function(response) {
            $('#positionModal').modal('hide');
            alert('✅ Posisi kapal berhasil diupdate!');
            location.reload();
        },
        error: function(xhr) {
            alert('❌ Error: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'));
            submitBtn.prop('disabled', false).html('Update Posisi');
        }
    });
});

$('.status-select').on('change', function() {
    const shipId = $(this).data('id');
    const status = $(this).val();

    $.ajax({
        url: `/admin/ships/${shipId}/update-status`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: status
        },
        success: function(response) {
            console.log('Status berhasil diupdate');
        },
        error: function() {
            alert('Gagal mengupdate status');
            location.reload();
        }
    });
});
</script>
@endsection