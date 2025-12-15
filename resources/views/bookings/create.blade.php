@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-5">
            <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Pesan Paket: {{ $package->destination }}</h2>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <!-- Package Summary -->
                        <div class="alert alert-light border mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Paket</p>
                                    <h6 class="fw-bold">{{ $package->destination }}, {{ $package->country }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Durasi</p>
                                    <h6 class="fw-bold">{{ $package->duration_days }} Hari {{ $package->duration_nights }} Malam</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Harga per Orang</p>
                                    <h6 class="fw-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Slot Tersedia</p>
                                    <h6 class="fw-bold">{{ $package->available_slots }} / {{ $package->max_participants }}</h6>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <div class="mb-4">
                                <label for="number_of_people" class="form-label fw-bold">Jumlah Peserta <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('number_of_people') is-invalid @enderror" 
                                       id="number_of_people" name="number_of_people" value="{{ old('number_of_people', 1) }}" 
                                       min="1" max="{{ $package->available_slots }}" required>
                                @error('number_of_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maksimal {{ $package->available_slots }} peserta</small>
                            </div>

                            <div class="mb-4">
                                <label for="departure_date" class="form-label fw-bold">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('departure_date') is-invalid @enderror" 
                                       id="departure_date" name="departure_date" value="{{ old('departure_date') }}" required>
                                @error('departure_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="return_date" class="form-label fw-bold">Tanggal Kembali</label>
                                <input type="date" class="form-control @error('return_date') is-invalid @enderror" 
                                       id="return_date" name="return_date" value="{{ old('return_date') }}">
                                @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="notes" class="form-label fw-bold">Catatan (Opsional)</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="3" placeholder="Tambahkan catatan khusus untuk pemesanan Anda">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price Summary -->
                            <div class="card bg-light border-0 mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="text-muted small mb-0">Total Harga</p>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="fw-bold text-primary mb-0" id="total_price">
                                                Rp {{ number_format($package->price, 0, ',', '.') }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                                <i class="bi bi-ticket-perforated me-2"></i>Lanjutkan ke Pembayaran
                            </button>
                        </form>

                        <div class="alert alert-info mt-4 mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Setelah pemesanan, Anda akan diminta untuk melakukan pembayaran. Pemesanan akan dikonfirmasi setelah pembayaran diterima.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    const pricePerPerson = {{ $package->price }};
    const numberInput = document.getElementById('number_of_people');
    const totalPriceDisplay = document.getElementById('total_price');

    function updateTotalPrice() {
        const number = parseInt(numberInput.value) || 1;
        const total = number * pricePerPerson;
        totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    numberInput.addEventListener('change', updateTotalPrice);
    numberInput.addEventListener('input', updateTotalPrice);
</script>
@endsection
@endsection
