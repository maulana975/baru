<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()->with(['package', 'payment'])->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('bookings.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'number_of_people' => 'required|integer|min:1',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'nullable|date|after:departure_date',
            'notes' => 'nullable|string|max:500',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        // Check available slots
        if ($package->available_slots < $validated['number_of_people']) {
            return back()->with('error', 'Slot tidak cukup untuk jumlah peserta!');
        }

        $total_price = $package->price * $validated['number_of_people'];

        $booking = Auth::user()->bookings()->create([
            'package_id' => $validated['package_id'],
            'number_of_people' => $validated['number_of_people'],
            'departure_date' => $validated['departure_date'],
            'return_date' => $validated['return_date'],
            'total_price' => $total_price,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Update available slots
        $package->decrement('available_slots', $validated['number_of_people']);

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking pending yang bisa diubah!');
        }

        $validated = $request->validate([
            'number_of_people' => 'required|integer|min:1',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'nullable|date|after:departure_date',
            'notes' => 'nullable|string|max:500',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking pending yang bisa dibatalkan!');
        }

        // Restore available slots
        $booking->package->increment('available_slots', $booking->number_of_people);

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan!');
    }
}
