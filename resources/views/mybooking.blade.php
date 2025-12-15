@extends('layouts.app')

@section('title', 'Pemesanan Saya')

@section('content')
<div class="container mt-5 pt-3">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-5 fw-bold">Pemesanan Saya</h1>
            <p class="text-muted lead">Kelola dan lihat riwayat pemesanan Anda</p>
        </div>
        <div class="col-lg-4 text-end">
            <a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Pesan Paket
            </a>
        </div>
    </div>

    <!-- Filter and Stats -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Total Pemesanan</h6>
                            <h3 class="fw-bold text-primary">{{ $bookings->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pending</h6>
                            <h3 class="fw-bold text-warning">{{ $bookings->where('status', 'pending')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Dikonfirmasi</h6>
                            <h3 class="fw-bold text-success">{{ $bookings->where('status', 'confirmed')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Selesai</h6>
                            <h3 class="fw-bold text-info">{{ $bookings->where('status', 'completed')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="row">
        <div class="col-lg-12">
            @if($bookings->count() > 0)
                @forelse($bookings as $booking)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-lg-3 mb-3 mb-lg-0">
                                                <img src="{{ $booking->package->image_url }}" 
                                                    alt="{{ $booking->package->destination }}"
                                                    class="img-fluid rounded" style="max-height: 150px; object-fit: cover; width: 100%;">
                                        </div>
                                        <div class="col-lg-9">
                                            <h5 class="fw-bold mb-2">{{ $booking->package->destination }}, {{ $booking->package->country }}</h5>
                                            <p class="text-muted mb-2">
                                                <i class="bi bi-calendar-event me-2"></i>
                                                {{ $booking->departure_date ? $booking->departure_date->format('d M Y') : '-' }}
                                                @if($booking->return_date)
                                                    - {{ $booking->return_date->format('d M Y') }}
                                                @endif
                                            </p>
                                            <p class="text-muted mb-2">
                                                <i class="bi bi-people me-2"></i>
                                                {{ $booking->number_of_people }} Peserta
                                            </p>
                                            <p class="text-muted mb-0">
                                                <i class="bi bi-hash me-2"></i>
                                                ID Pemesanan: <span class="fw-bold">#{{ $booking->id }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-lg-end">
                                        <h4 class="fw-bold text-primary mb-3">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </h4>
                                        <div class="mb-3">
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge bg-success px-3 py-2">Dikonfirmasi</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge bg-primary px-3 py-2">Selesai</span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                            @endif
                                        </div>
                                        <div class="btn-group-vertical w-100" role="group">
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye me-2"></i>Lihat Detail
                                            </a>
                                            @if($booking->status == 'pending')
                                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Batalkan pemesanan ini?')">
                                                        <i class="bi bi-trash me-2"></i>Batalkan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <h5 class="mt-3">Belum Ada Pemesanan</h5>
                        <p class="text-muted">Anda belum memiliki pemesanan. <a href="{{ route('packages.index') }}">Mulai pesan sekarang!</a></p>
                    </div>
                @endforelse
            @else
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Belum Ada Pemesanan</h5>
                    <p class="text-muted">Anda belum memiliki pemesanan. <a href="{{ route('packages.index') }}">Mulai pesan sekarang!</a></p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
