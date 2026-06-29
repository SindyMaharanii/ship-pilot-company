@extends('layouts.app')

@section('title', 'Edit Profil Perusahaan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-edit text-primary me-2"></i> Edit Profil Perusahaan</h1>
        <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

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
            <form action="{{ route('admin.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Logo</label>
                        @if($company->logo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($company->logo) }}" style="max-height: 80px;">
                        </div>
                        @endif
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $company->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sejarah</label>
                    <textarea name="history" rows="5" class="form-control">{{ old('history', $company->history) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="vision" rows="3" class="form-control">{{ old('vision', $company->vision) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Misi</label>
                    <textarea name="mission" rows="3" class="form-control">{{ old('mission', $company->mission) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $company->address) }}">
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