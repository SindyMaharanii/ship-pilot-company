@extends('layouts.app')

@section('title', 'Riwayat Pelacakan - ' . $ship->name)

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
                <i class="fas fa-history me-1"></i> Riwayat {{ $ship->name }}
            </li>
        </ol>
    </nav>

    <!-- ===== HEADER ===== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="fas fa-history text-primary me-2"></i> Riwayat Pelacakan - {{ $ship->name }}
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

    <!-- ===== TABLE ===== -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status</th>
                            <th>Kecepatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tracked_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $item->latitude }}</td>
                            <td>{{ $item->longitude }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->speed ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada riwayat pelacakan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $history->links() }}
            </div>
        </div>
    </div>
</div>
@endsection