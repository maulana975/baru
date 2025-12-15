@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5 pt-3">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-5 fw-bold">Dashboard Admin</h1>
            <p class="text-muted lead">Kelola paket perjalanan dan pemesanan</p>
        </div>
        <div class="col-lg-4 text-end">
            <a href="{{ route('packages.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Paket Baru
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Total Paket</h6>
                            <h3 class="fw-bold mb-0">{{ $totalPackages }}</h3>
                        </div>
                        <div class="icon-circle bg-primary bg-opacity-10" style="color: var(--primary-color); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.5rem;">
                            <i class="bi bi-backpack-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Total Pemesanan</h6>
                            <h3 class="fw-bold mb-0">{{ $totalBookings }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: #28a745; background-opacity: 0.1; color: #28a745; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.5rem;">
                            <i class="bi bi-ticket-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Pemesanan Pending</h6>
                            <h3 class="fw-bold mb-0">{{ $pendingBookings }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: #ffc107; background-opacity: 0.1; color: #ffc107; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.5rem;">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h3 class="fw-bold mb-0">{{ $totalUsers }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: #17a2b8; background-opacity: 0.1; color: #17a2b8; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.5rem;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Packages Management -->
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-list-check me-2"></i>Daftar Paket Perjalanan
                    </h5>
                </div>
                <div class="card-body">
                    @if($packages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Destinasi</th>
                                        <th>Negara</th>
                                        <th>Harga</th>
                                        <th>Durasi</th>
                                        <th>Slot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $package)
                                        <tr>
                                            <td class="fw-bold">{{ $package->destination }}</td>
                                            <td>{{ $package->country }}</td>
                                            <td>
                                                <span class="badge bg-success">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                            </td>
                                            <td>{{ $package->duration_days }} H {{ $package->duration_nights }} M</td>
                                            <td>
                                                <span class="badge bg-info">{{ $package->available_slots }}/{{ $package->max_participants }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus paket ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada paket. <a href="{{ route('packages.create') }}">Buat paket baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-ticket-detailed me-2"></i>Pemesanan Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Paket</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBookings as $booking)
                                        <tr>
                                            <td class="fw-bold">#{{ $booking->id }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $booking->user->name }}</div>
                                                <div class="text-muted small">{{ $booking->user->email }}</div>
                                            </td>
                                            <td>{{ $booking->package->destination }}</td>
                                            <td>{{ $booking->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if($booking->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($booking->status == 'confirmed')
                                                    <span class="badge bg-success">Dikonfirmasi</span>
                                                @elseif($booking->status == 'completed')
                                                    <span class="badge bg-primary">Selesai</span>
                                                @else
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada pemesanan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
