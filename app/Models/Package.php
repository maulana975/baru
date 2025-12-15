<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'destination',
        'country',
        'description',
        'itinerary',
        'image',
        'duration_days',
        'duration_nights',
        'price',
        'max_participants',
        'available_slots',
        'status',
    ];

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Accessor to get a usable image URL for the package.
    public function getImageUrlAttribute()
    {
        // If an image is stored (uploaded), use storage path
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        // Map common destinations to public images
        $dest = strtolower($this->destination ?? '');

        if (str_contains($dest, 'bali')) {
            return asset('images/bali.webp');
        }
        if (str_contains($dest, 'london')) {
            return asset('images/london.jpg');
        }
        if (str_contains($dest, 'paris')) {
            return asset('images/paris.jpg');
        }
        if (str_contains($dest, 'swiss') || str_contains($dest, 'switzerland')) {
            return asset('images/swiss.webp');
        }
        if (str_contains($dest, 'tokyo')) {
            return asset('images/tokyo.jpg');
        }

        // Fallback default
        return asset('images/kyoto.jpg');
    }
}
