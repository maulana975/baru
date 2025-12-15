@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<header class="hero-section">
    <div class="hero-content">
        <h1>Temukan Petualangan Anda</h1>
        <p class="lead mb-4">Jelajahi destinasi impian Anda dengan paket perjalanan terbaik dari GoldTicket</p>

        <!-- Search Form -->
        <form action="{{ route('packages.index') }}" method="GET" class="p-4 rounded-3" style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); max-width: 600px; margin: 0 auto;">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari destinasi..." value="{{ request('search') }}">
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-search me-2"></i>Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</header>

<!-- Services Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Mengapa Memilih GoldTicket?</h2>
            <p class="text-muted lead">Kami memberikan pengalaman perjalanan terbaik untuk Anda</p>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="service-card shadow-sm">
                    <div class="icon-circle">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Destinasi Terpilih</h5>
                    <p class="text-muted">Pilihan destinasi exotis dari seluruh dunia dengan harga terjangkau</p>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="service-card shadow-sm">
                    <div class="icon-circle">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Terpercaya</h5>
                    <p class="text-muted">Akomodasi dan transportasi terbaik dengan standar kualitas internasional</p>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="service-card shadow-sm">
                    <div class="icon-circle">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Dukungan 24/7</h5>
                    <p class="text-muted">Tim support kami siap membantu kapan saja untuk menjamin kenyamanan Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Destinations Section -->
<section class="section-padding pb-0">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Paket Perjalanan Populer</h2>
            <p class="text-muted lead">Jelajahi destinasi menakjubkan yang telah dipilih khusus untuk Anda</p>
        </div>

        <div class="row">
            @forelse($packages as $package)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card destination-card shadow-sm h-100">
                        <div class="position-relative">
                               <img src="{{ $package->image_url }}" 
                                 class="card-img-top" alt="{{ $package->destination }}">
                            <span class="badge bg-primary badge-price">
                                Mulai Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $package->destination }}, {{ $package->country }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($package->description, 80) }}</p>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $package->duration_days }} Hari {{ $package->duration_nights }} Malam
                                </small>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="bi bi-people me-1"></i>
                                    Slot Tersedia: {{ $package->available_slots }} / {{ $package->max_participants }}
                                </small>
                            </div>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ route('packages.show', $package->id) }}" class="btn btn-outline-primary btn-sm w-50">
                                <i class="bi bi-eye me-1"></i>Lihat Detail
                            </a>
                            @auth
                                <a href="{{ route('bookings.create', $package->id) }}" class="btn btn-primary btn-sm w-50">
                                    <i class="bi bi-ticket me-1"></i>Pesan
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm w-50">
                                    <i class="bi bi-ticket me-1"></i>Pesan
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>
                        Belum ada paket tersedia
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('packages.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-right me-2"></i>Lihat Semua Paket
            </a>
        </div>
    </div>
</section>

<!-- CTA Section (Light Gray Background) -->
<section class="bg-light text-dark text-center" style="background-color: #f5f5f7; min-height: 45vh; display: flex; align-items: center; justify-content: center;">
    <div class="container">
        <h2 class="display-5 fw-bold mb-2 text-dark">Siap untuk Berpetualang?</h2>
        <p class="lead mb-3 text-dark">Wujudkan impian perjalanan Anda bersama GoldTicket!</p>
        
        @auth
            <a href="{{ route('packages.index') }}" class="btn btn-primary btn-md fw-semibold">
                <i class="bi bi-search me-2"></i>Jelajahi Paket
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-md fw-semibold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Memulai
            </a>
        @endauth
    </div>
</section>
@endsection
