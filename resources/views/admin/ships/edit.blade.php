@extends('layouts.app')

@section('title', 'Edit Kapal Pandu')

@section('content')
<div class="container-fluid py-4">

    <!-- ===== BREADCRUMB ===== -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.ships.index') }}">
                    <i class="fas fa-ship me-1"></i> Manajemen Kapal
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-edit me-1"></i> Edit Kapal
            </li>
        </ol>
    </nav>

    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="fas fa-edit text-primary me-2"></i> Edit Kapal Pandu
        </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
            <a href="{{ route('admin.ships.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-list me-1"></i> Lihat Semua Kapal
            </a>
        </div>
    </div>

    <!-- ===== FORM ===== -->
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.ships.update', $ship->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Kapal <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $ship->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pandu / Kapten</label>
                        <input type="text" name="pilot_name" class="form-control" value="{{ old('pilot_name', $ship->pilot_name) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Foto Pandu / Kapten</label>
                        @if($ship->pilot_photo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($ship->pilot_photo) }}" alt="Foto Pandu" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #0066cc;">
                        </div>
                        @endif
                        <input type="file" name="pilot_photo" class="form-control" accept="image/*">
                        <small class="text-muted">Upload foto pandu (format: JPG, PNG, max 2MB)</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Call Sign <span class="text-danger">*</span></label>
                        <input type="text" name="call_sign" class="form-control" value="{{ old('call_sign', $ship->call_sign) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Registrasi</label>
                        <input type="text" name="registration_number" class="form-control" value="{{ old('registration_number', $ship->registration_number) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe Kapal</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type', $ship->type) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="available" {{ $ship->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="on_duty" {{ $ship->status == 'on_duty' ? 'selected' : '' }}>Bertugas</option>
                            <option value="maintenance" {{ $ship->status == 'maintenance' ? 'selected' : '' }}>Perawatan</option>
                            <option value="offline" {{ $ship->status == 'offline' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kapasitas (Orang)</label>
                        <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $ship->capacity) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kecepatan (Knot)</label>
                        <input type="text" name="speed" class="form-control" value="{{ old('speed', $ship->speed) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Panjang (Meter)</label>
                        <input type="text" name="length" class="form-control" value="{{ old('length', $ship->length) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lebar (Meter)</label>
                        <input type="text" name="width" class="form-control" value="{{ old('width', $ship->width) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Draft (Meter)</label>
                        <input type="text" name="draft" class="form-control" value="{{ old('draft', $ship->draft) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $ship->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Spesifikasi Teknis</label>
                    <textarea name="technical_specs" rows="3" class="form-control">{{ old('technical_specs', $ship->technical_specs) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Posisi Latitude</label>
                        <input type="text" name="current_latitude" class="form-control" value="{{ old('current_latitude', $ship->current_latitude) }}" placeholder="Contoh: -6.2088">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Posisi Longitude</label>
                        <input type="text" name="current_longitude" class="form-control" value="{{ old('current_longitude', $ship->current_longitude) }}" placeholder="Contoh: 106.8456">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kapal</label>
                    @if($ship->photo)
                    <div class="mb-2">
                        <img src="{{ Storage::url($ship->photo) }}" alt="Foto Kapal" style="max-width: 150px; border-radius: 10px;">
                    </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Upload foto baru jika ingin mengganti</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection