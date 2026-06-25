@extends('layouts.app')

@section('title', 'Tambah Kapal Pandu')

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
                <i class="fas fa-plus me-1"></i> Tambah Kapal
            </li>
        </ol>
    </nav>

    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="fas fa-plus text-primary me-2"></i> Tambah Kapal Pandu
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
            <form action="{{ route('admin.ships.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Kapal <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pandu</label>
                        <input type="text" name="pilot_name" class="form-control" placeholder="Contoh: Capt. Budi Santoso">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Foto Pandu / Kapten</label>
                        <input type="file" name="pilot_photo" class="form-control" accept="image/*">
                        <small class="text-muted">Upload foto pandu (format: JPG, PNG, max 2MB)</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Call Sign <span class="text-danger">*</span></label>
                        <input type="text" name="call_sign" class="form-control @error('call_sign') is-invalid @enderror" required>
                        @error('call_sign')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Registrasi</label>
                        <input type="text" name="registration_number" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe Kapal</label>
                        <input type="text" name="type" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="available">Tersedia</option>
                            <option value="on_duty">Bertugas</option>
                            <option value="maintenance">Perawatan</option>
                            <option value="offline">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kapasitas (Orang)</label>
                        <input type="number" name="capacity" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kecepatan (Knot)</label>
                        <input type="text" name="speed" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Panjang (Meter)</label>
                        <input type="text" name="length" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lebar (Meter)</label>
                        <input type="text" name="width" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Draft (Meter)</label>
                        <input type="text" name="draft" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Spesifikasi Teknis</label>
                    <textarea name="technical_specs" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kapal</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Upload foto kapal (max 2MB)</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Kapal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection