@extends('layouts.app')

@section('title', 'Edit Mitra Kerja Sama')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-edit text-primary me-2"></i> Edit Mitra Kerja Sama</h1>
        <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.partnerships.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Mitra <span class="text-danger">*</span></label>
                    <input type="text" name="partner_name" class="form-control" value="{{ old('partner_name', $partner->partner_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="description" rows="3" class="form-control" required>{{ old('description', $partner->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengalaman Kolaborasi</label>
                    <textarea name="collaboration_experience" rows="3" class="form-control">{{ old('collaboration_experience', $partner->collaboration_experience) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Peluang Kemitraan</label>
                    <textarea name="partnership_opportunity" rows="3" class="form-control">{{ old('partnership_opportunity', $partner->partnership_opportunity) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-control" value="{{ old('website', $partner->website) }}" placeholder="https://example.com">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Logo</label>
                        @if($partner->logo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($partner->logo) }}" style="height: 60px; object-fit: cover; border-radius: 8px;">
                        </div>
                        @endif
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_active" class="form-check-input" {{ $partner->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Aktif</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection