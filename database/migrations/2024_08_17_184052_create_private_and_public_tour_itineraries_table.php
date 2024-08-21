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
        Schema::create('group_tour_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('group_tours')->cascadeOnDelete();

            $table->integer('day_number');

            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });

        Schema::create('private_tour_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('private_tours')->cascadeOnDelete();

            $table->integer('day_number');

            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_tour_itineraries');

        Schema::dropIfExists('private_tour_itineraries');
    }
};
