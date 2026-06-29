@extends('layouts.app')

@section('title', 'Kelola Mitra Kerja Sama')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-handshake text-primary me-2"></i> Kelola Mitra Kerja Sama</h1>
        <div>
            <a href="{{ route('admin.partnerships.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Mitra
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nama Mitra</th>
                            <th>Deskripsi</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partnerships as $partner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 8px;">
                                @else
                                <div style="height: 40px; width: 40px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $partner->partner_name }}</td>
                            <td>{{ Str::limit($partner->description, 50) }}</td>
                            <td>
                                @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" class="text-primary">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $partner->is_active ? 'success' : 'danger' }}">
                                    {{ $partner->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.partnerships.edit', $partner->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePartner({{ $partner->id }})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data mitra</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function deletePartner(id) {
    if(confirm('Yakin ingin menghapus mitra ini?')) {
        $.ajax({
            url: `/admin/partnerships/${id}`,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() { location.reload(); }
        });
    }
}
</script>
@endsection