@extends('layouts.app')

@section('title', 'Kelola Profil Perusahaan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-building text-primary me-2"></i> Kelola Profil Perusahaan</h1>
        <div>
            <a href="{{ route('admin.company.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Profil
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
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
                            <th>Nama Perusahaan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($company->logo)
                                <img src="{{ Storage::url($company->logo) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 8px;">
                                @else
                                <div style="height: 40px; width: 40px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->phone ?? '-' }}</td>
                            <td>{{ $company->email ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.company.edit', $company->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteCompany({{ $company->id }})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data perusahaan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function deleteCompany(id) {
    if(confirm('Yakin ingin menghapus profil perusahaan ini?')) {
        $.ajax({
            url: `/admin/company/${id}`,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() { location.reload(); }
        });
    }
}
</script>
@endsection