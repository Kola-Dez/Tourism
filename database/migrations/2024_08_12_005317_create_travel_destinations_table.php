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
        Schema::create('travel_destinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->string('image')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_destinations');
    }
};
