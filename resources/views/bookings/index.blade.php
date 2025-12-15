@extends('layouts.app')

@section('title', 'Pemesanan Saya')

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-5">
            <h2 class="fw-bold display-5 mb-3">Pemesanan Saya</h2>
            <p class="text-muted lead">Kelola dan pantau semua pemesanan perjalanan Anda</p>
        </div>

        @if($bookings->isEmpty())
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                <p class="mt-3 mb-0">Anda belum memiliki pemesanan</p>
                <a href="{{ route('packages.index') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-search me-2"></i>Cari Paket
                </a>
            </div>
        @else
            <div class="row">
                @foreach($bookings as $booking)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 mb-3 mb-lg-0">
                                        <h5 class="fw-bold mb-2">{{ $booking->package->destination }}</h5>
                                        <p class="text-muted mb-2">
                                            <i class="bi bi-geo-alt-fill me-2"></i>{{ $booking->package->country }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            {{ $booking->departure_date->format('d M Y') }}
                                        </small>
                                    </div>

                                    <div class="col-lg-2 mb-3 mb-lg-0">
                                        <p class="text-muted small mb-2">Jumlah Peserta</p>
                                        <h6 class="fw-bold">{{ $booking->number_of_people }} Orang</h6>
                                    </div>

                                    <div class="col-lg-2 mb-3 mb-lg-0">
                                        <p class="text-muted small mb-2">Total Harga</p>
                                        <h6 class="fw-bold text-primary">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </h6>
                                    </div>

                                    <div class="col-lg-2 mb-3 mb-lg-0">
                                        <p class="text-muted small mb-2">Status</p>
                                        @switch($booking->status)
                                            @case('pending')
                                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                                @break
                                            @case('confirmed')
                                                <span class="badge bg-info">Dikonfirmasi</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success">Selesai</span>
                                                @break
                                        @endswitch
                                    </div>

                                    <div class="col-lg-3 text-lg-end">
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i>Lihat Detail
                                        </a>
                                        @if($booking->status == 'pending')
                                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;" 
                                                  onsubmit="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash me-1"></i>Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
