@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-edit text-primary me-2"></i> Edit Layanan</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="description" rows="3" class="form-control" required>{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prosedur Layanan</label>
                    <textarea name="procedure" rows="3" class="form-control">{{ old('procedure', $service->procedure) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keunggulan</label>
                    <textarea name="advantages" rows="3" class="form-control">{{ old('advantages', $service->advantages) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $service->order) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gambar</label>
                        @if($service->image)
                        <div class="mb-2"><img src="{{ Storage::url($service->image) }}" style="max-height: 80px;"></div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_active" class="form-check-input" {{ $service->is_active ? 'checked' : '' }}>
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