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
        Schema::create('group_tours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('travel_destination_id')->constrained('travel_destinations')->onDelete('cascade');

            $table->string('title');
            $table->string('image');

            $table->text('description');
            $table->text('inclusions');
            $table->text('exclusions');

            $table->decimal('price');
            $table->integer('how_many_peoples');
            $table->Integer('hits')->default(0);

            $table->enum('status', ['available', 'unavailable', 'pending'])->default('available');

            $table->date('departing');
            $table->date('finishing');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_tours');
    }
};
