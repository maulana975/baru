@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-4">
                        <h3 class="fw-bold mb-0">
                            <i class="bi bi-ticket-perforated me-2"></i>Detail Pemesanan
                        </h3>
                    </div>
                    <div class="card-body p-5">
                        <!-- Booking Status -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Status Pemesanan</p>
                                <div>
                                    @switch($booking->status)
                                        @case('pending')
                                            <span class="badge bg-warning text-dark py-2 px-3">
                                                <i class="bi bi-clock me-1"></i>Menunggu Konfirmasi
                                            </span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-info py-2 px-3">
                                                <i class="bi bi-check-circle me-1"></i>Dikonfirmasi
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger py-2 px-3">
                                                <i class="bi bi-x-circle me-1"></i>Dibatalkan
                                            </span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success py-2 px-3">
                                                <i class="bi bi-check-all me-1"></i>Selesai
                                            </span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Nomor Referensi</p>
                                <h6 class="fw-bold font-monospace">BK-{{ sprintf('%06d', $booking->id) }}</h6>
                            </div>
                        </div>

                        <hr>

                        <!-- Package Info -->
                        <h5 class="fw-bold mb-4">Informasi Paket</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Destinasi</p>
                                <h6 class="fw-bold">{{ $booking->package->destination }}, {{ $booking->package->country }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Durasi</p>
                                <h6 class="fw-bold">{{ $booking->package->duration_days }} Hari {{ $booking->package->duration_nights }} Malam</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Harga per Orang</p>
                                <h6 class="fw-bold">Rp {{ number_format($booking->package->price, 0, ',', '.') }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Jumlah Peserta</p>
                                <h6 class="fw-bold">{{ $booking->number_of_people }} Orang</h6>
                            </div>
                        </div>

                        <hr>

                        <!-- Booking Info -->
                        <h5 class="fw-bold mb-4">Informasi Pemesanan</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Tanggal Keberangkatan</p>
                                <h6 class="fw-bold">{{ $booking->departure_date->format('d M Y') }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Tanggal Kembali</p>
                                <h6 class="fw-bold">
                                    @if($booking->return_date)
                                        {{ $booking->return_date->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Tanggal Pemesanan</p>
                                <h6 class="fw-bold">{{ $booking->created_at->format('d M Y H:i') }}</h6>
                            </div>
                        </div>

                        @if($booking->notes)
                            <hr>
                            <h5 class="fw-bold mb-4">Catatan</h5>
                            <div class="alert alert-light border">
                                {{ $booking->notes }}
                            </div>
                        @endif

                        <hr>

                        <!-- Price Summary -->
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="text-muted small mb-0">Harga per Orang</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="fw-bold mb-0">Rp {{ number_format($booking->package->price, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="text-muted small mb-0">Jumlah Peserta</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="fw-bold mb-0">{{ $booking->number_of_people }} x</h6>
                                    </div>
                                </div>
                                <hr class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <p class="fw-bold mb-0">Total Harga</p>
                                    </div>
                                    <div class="col-auto">
                                        <h5 class="fw-bold text-primary mb-0">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Status -->
                @if($booking->payment)
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white py-4">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-credit-card me-2"></i>Status Pembayaran
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Status</p>
                                    <div>
                                        @switch($booking->payment->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                                @break
                                            @case('success')
                                                <span class="badge bg-success">Berhasil</span>
                                                @break
                                            @case('failed')
                                                <span class="badge bg-danger">Gagal</span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Metode Pembayaran</p>
                                    <h6 class="fw-bold">{{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) }}</h6>
                                </div>
                            </div>
                            @if($booking->payment->transaction_id)
                                <p class="text-muted small">
                                    <strong>ID Transaksi:</strong> {{ $booking->payment->transaction_id }}
                                </p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                Pembayaran belum dilakukan. Silakan lakukan pembayaran untuk mengkonfirmasi pemesanan.
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="mt-4">
                    @if($booking->status == 'pending')
                        <div class="d-flex gap-2">
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning flex-grow-1">
                                <i class="bi bi-pencil me-2"></i>Edit Pemesanan
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="flex-grow-1"
                                  onsubmit="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-trash me-2"></i>Batalkan Pemesanan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
