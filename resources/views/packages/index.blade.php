@extends('layouts.app')

@section('title', 'Paket Perjalanan')

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-5">
            <h2 class="fw-bold display-5 mb-3">Paket Perjalanan</h2>
            <p class="text-muted lead">Temukan dan pilih paket perjalanan impian Anda</p>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <form action="{{ route('packages.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control form-control-lg" 
                               placeholder="Cari destinasi..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="sort" class="form-select form-select-lg">
                            <option value="">Urutkan</option>
                            <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga: Terendah</option>
                            <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga: Tertinggi</option>
                            <option value="newest" @selected(request('sort') == 'newest')>Terbaru</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-search me-2"></i>Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Packages Grid -->
        <div class="row">
            @forelse($packages as $package)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card destination-card shadow-sm h-100">
                        <div class="position-relative">
                               <img src="{{ $package->image_url }}" 
                                   class="card-img-top" alt="{{ $package->destination }}">
                            <span class="badge bg-primary badge-price">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $package->destination }}</h5>
                            <p class="text-muted small">{{ $package->country }}</p>
                            <p class="card-text text-muted small">{{ Str::limit($package->description, 100) }}</p>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $package->duration_days }} Hari {{ $package->duration_nights }} Malam
                                </small>
                                <small class="text-muted d-block">
                                    <i class="bi bi-people me-1"></i>
                                    Slot: {{ $package->available_slots }} / {{ $package->max_participants }}
                                </small>
                            </div>

                            @if($package->available_slots > 0)
                                <div class="progress mb-3" style="height: 5px;">
                                    <div class="progress-bar" style="width: {{ ($package->available_slots / $package->max_participants) * 100 }}%"></div>
                                </div>
                            @else
                                <div class="alert alert-warning py-2 px-3 mb-3">
                                    <small>Slot Penuh</small>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ route('packages.show', $package->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                            @auth
                                @if($package->available_slots > 0)
                                    <a href="{{ route('bookings.create', $package->id) }}" class="btn btn-primary btn-sm flex-grow-1">
                                        <i class="bi bi-ticket me-1"></i>Pesan
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-ticket me-1"></i>Pesan
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-search me-2" style="font-size: 2rem;"></i>
                        <p class="mb-0">Paket tidak ditemukan</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                {{ $packages->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
