<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('destination')->unique();
            $table->string('country');
            $table->text('description');
            $table->longText('itinerary')->nullable();
            $table->string('image')->nullable();
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->decimal('price', 15, 2);
            $table->integer('max_participants')->default(50);
            $table->integer('available_slots')->default(50);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
