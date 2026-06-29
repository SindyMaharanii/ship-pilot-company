@extends('layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="fas fa-envelope text-primary me-2"></i> Detail Pesan</h1>
        <div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Nama Pengirim</label>
                    <p>{{ $contact->name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Email</label>
                    <p>{{ $contact->email }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Telepon</label>
                    <p>{{ $contact->phone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Perusahaan</label>
                    <p>{{ $contact->company ?? '-' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Subjek</label>
                    <p>{{ $contact->subject }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Tipe Kerja Sama</label>
                    <p>{{ $contact->partnership_type ?? '-' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="fw-bold">Pesan</label>
                    <div class="border rounded p-3 bg-light">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="fw-bold">Status</label>
                    <p>
                        @if($contact->status == 'pending')
                        <span class="badge bg-warning">Belum Dibaca</span>
                        @elseif($contact->status == 'read')
                        <span class="badge bg-info">Sudah Dibaca</span>
                        @else
                        <span class="badge bg-success">Sudah Dibalas</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.contacts.reply', $contact->id) }}" class="btn btn-success">
                    <i class="fas fa-reply me-1"></i> Tandai Sudah Dibalas
                </a>
                <button onclick="deleteContact({{ $contact->id }})" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function deleteContact(id) {
    if(confirm('Yakin ingin menghapus pesan ini?')) {
        $.ajax({
            url: `/admin/contacts/${id}`,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                window.location.href = '{{ route("admin.contacts.index") }}';
            }
        });
    }
}
</script>
@endsection