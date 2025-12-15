<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'destination' => 'Bali',
            'country' => 'Indonesia',
            'description' => 'Nikmati keindahan budaya, alam, dan spiritualitas di Pulau Dewata. Paket ini mencakup kunjungan ke Ubud, Seminyak, Tanah Lot, dan berbagai destinasi wisata menarik lainnya.',
            'itinerary' => 'Hari 1: Tiba di Bali, check-in hotel, rest
Hari 2: Kunjungan ke Ubud - Monkey Forest, Istana Ubud
Hari 3: Tanah Lot, Tegallalang Rice Terrace, Seminyak Beach
Hari 4: Kuta Beach, belanja di Mal lokal, kepulangan',
            'duration_days' => 4,
            'duration_nights' => 3,
            'price' => 2500000,
            'max_participants' => 50,
            'available_slots' => 50,
            'status' => 'active',
        ]);

        Package::create([
            'destination' => 'Kyoto',
            'country' => 'Jepang',
            'description' => 'Rasakan pesona musim gugur di kota seribu kuil dengan perjalanan yang penuh dengan budaya tradisional Jepang. Nikmati pemandangan alam yang menakjubkan dan kuliner autentik.',
            'itinerary' => 'Hari 1: Tiba di Kyoto, Fushimi Inari Shrine
Hari 2: Arashiyama Bamboo Grove, Tenryu-ji Temple
Hari 3: Kinkaku-ji, Ryoan-ji, Gion District
Hari 4: Philosopher Path, Nanzen-ji Temple
Hari 5: Berbelanja souvenir, kepulangan',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price' => 15000000,
            'max_participants' => 40,
            'available_slots' => 40,
            'status' => 'active',
        ]);

        Package::create([
            'destination' => 'Swiss Alps',
            'country' => 'Swiss',
            'description' => 'Jelajahi keindahan Alpen yang megah dan danau jernih dalam petualangan yang tak terlupakan. Paket ini mencakup aktivitas hiking, naik kereta pegunungan, dan pemandangan yang menakjubkan.',
            'itinerary' => 'Hari 1: Tiba di Zurich, transfer ke Interlaken
Hari 2: Jungfraujoch - Top of Europe
Hari 3: Lauterbrunnen Valley, Staubbach Falls
Hari 4: Oeschinen Lake, hiking trail
Hari 5: Kembali ke Zurich, kepulangan',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price' => 25000000,
            'max_participants' => 30,
            'available_slots' => 30,
            'status' => 'active',
        ]);

        Package::create([
            'destination' => 'Tokyo',
            'country' => 'Jepang',
            'description' => 'Jelajahi pusat budaya modern Jepang dengan teknologi canggih, kuil tradisional, dan perpaduan sempurna antara tradisi dan modernitas.',
            'itinerary' => 'Hari 1: Tiba di Tokyo, Senso-ji Temple
Hari 2: Shibuya Crossing, Meiji Shrine
Hari 3: Tsukiji Fish Market, teamLab Digital Art Museum
Hari 4: Disneyland Tokyo
Hari 5: Shopping di Shinjuku, kepulangan',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price' => 12000000,
            'max_participants' => 45,
            'available_slots' => 45,
            'status' => 'active',
        ]);

        Package::create([
            'destination' => 'Paris',
            'country' => 'Prancis',
            'description' => 'Kota cahaya yang penuh dengan seni, budaya, dan sejarah. Dari Menara Eiffel hingga Louvre Museum, Paris adalah destinasi impian para pencinta seni dan romantika.',
            'itinerary' => 'Hari 1: Tiba di Paris, Eiffel Tower
Hari 2: Louvre Museum, Arc de Triomphe
Hari 3: Notre-Dame, Sainte-Chapelle
Hari 4: Champs-Elysees, Palace of Versailles
Hari 5: Musee d\'Orsay, waktu bebas belanja, kepulangan',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price' => 20000000,
            'max_participants' => 35,
            'available_slots' => 35,
            'status' => 'active',
        ]);

        Package::create([
            'destination' => 'London',
            'country' => 'Inggris',
            'description' => 'Jelajahi ibukota Inggris yang kaya akan sejarah, arsitektur ikonik, dan budaya yang dinamis. Big Ben, Tower Bridge, dan Royal Palace menanti Anda.',
            'itinerary' => 'Hari 1: Tiba di London, Westminster Abbey
Hari 2: Tower of London, Tower Bridge
Hari 3: Buckingham Palace, British Museum
Hari 4: Sherlock Holmes Museum, Piccadilly Circus
Hari 5: Shopping di Oxford Street, kepulangan',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price' => 18000000,
            'max_participants' => 40,
            'available_slots' => 40,
            'status' => 'active',
        ]);
    }
}
