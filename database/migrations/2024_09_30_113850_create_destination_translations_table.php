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
        Schema::create('destination_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');

            $table->string('translate_name');
            $table->text('translate_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_translations');
    }
};
