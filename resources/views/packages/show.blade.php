@extends('layouts.app')

@section('title', $package->destination)

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="row">
            <!-- Package Image -->
            <div class="col-lg-7 mb-4">
                 <img src="{{ $package->image_url }}" 
                     class="img-fluid rounded-3 shadow-sm" alt="{{ $package->destination }}" style="height: 500px; object-fit: cover; width: 100%;">
            </div>

            <!-- Package Info -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-2">{{ $package->destination }}</h2>
                        <p class="text-muted mb-3">
                            <i class="bi bi-geo-alt-fill me-2"></i>{{ $package->country }}
                        </p>

                        <div class="mb-4">
                            <span class="display-5 fw-bold text-primary">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                            <small class="text-muted d-block">/per orang</small>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Durasi Perjalanan</h6>
                            <p class="text-muted mb-2">
                                <i class="bi bi-calendar-event me-2"></i>
                                {{ $package->duration_days }} Hari, {{ $package->duration_nights }} Malam
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Ketersediaan</h6>
                            <div class="progress mb-2" style="height: 25px;">
                                <div class="progress-bar" style="width: {{ ($package->available_slots / $package->max_participants) * 100 }}%">
                                    <small class="text-white fw-bold">{{ $package->available_slots }} Slot Tersedia</small>
                                </div>
                            </div>
                            <small class="text-muted">Dari {{ $package->max_participants }} Slot Total</small>
                        </div>

                        @auth
                            @if($package->available_slots > 0)
                                <a href="{{ route('bookings.create', $package->id) }}" class="btn btn-primary btn-lg w-100 fw-bold">
                                    <i class="bi bi-ticket-perforated me-2"></i>Pesan Sekarang
                                </a>
                            @else
                                <button class="btn btn-secondary btn-lg w-100 fw-bold" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Slot Penuh
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 fw-bold">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Pesan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Description and Itinerary -->
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h3 class="fw-bold mb-4">Deskripsi Paket</h3>
                    <p class="text-muted lh-lg">{{ $package->description }}</p>
                </div>

                @if($package->itinerary)
                    <div class="mb-5">
                        <h3 class="fw-bold mb-4">Itinerary</h3>
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                {!! nl2br(e($package->itinerary)) !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Features -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-4">Fasilitas Termasuk</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-airplane-fill text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Tiket Penerbangan</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-hotel text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Akomodasi Hotel</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bus-front-fill text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Transportasi Lokal</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cup-hot text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Makan & Minum</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Pemandu Wisata</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check text-primary me-3" style="font-size: 1.5rem;"></i>
                                <span>Asuransi Perjalanan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Info Pemesanan</h5>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status Paket</label>
                            <div>
                                @if($package->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Hubungi Kami</label>
                            <p class="mb-2">
                                <i class="bi bi-telephone-fill me-2"></i>
                                <a href="tel:085236328522" class="text-decoration-none">085236328522</a>
                            </p>
                            <p class="mb-0">
                                <i class="bi bi-whatsapp me-2"></i>
                                <a href="https://wa.me/6285236328522" target="_blank" class="text-decoration-none">Chat WhatsApp</a>
                            </p>
                        </div>

                        <hr>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Untuk pertanyaan lebih lanjut, silahkan hubungi tim kami</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
