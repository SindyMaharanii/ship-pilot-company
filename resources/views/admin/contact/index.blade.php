@extends('layouts.app')

@section('title', 'Kelola Halaman Kontak')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-address-card text-primary me-2"></i> Kelola Halaman Kontak</h1>
        <div>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                <i class="fas fa-undo me-1"></i> Reset
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
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
            <form action="{{ route('admin.contact.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat Kantor</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $contact->address ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $contact->phone ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link Google Maps (Embed)</label>
                        <input type="text" name="map_embed" class="form-control" value="{{ old('map_embed', $contact->map_embed ?? '') }}">
                        <small class="text-muted">Masukkan link embed dari Google Maps</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $contact->description ?? '') }}</textarea>
                </div>

                <hr>

                <h5 class="fw-bold mb-3"><i class="fas fa-share-alt text-primary me-2"></i> Media Sosial</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $contact->facebook ?? '') }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $contact->instagram ?? '') }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Twitter</label>
                        <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $contact->twitter ?? '') }}" placeholder="https://twitter.com/...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $contact->linkedin ?? '') }}" placeholder="https://linkedin.com/...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $contact->whatsapp ?? '') }}" placeholder="https://wa.me/...">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection