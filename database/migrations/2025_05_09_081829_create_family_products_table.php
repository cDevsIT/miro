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
        Schema::create('family_products', function (Blueprint $table) {
            $table->id();
            $table->string('model_no');
            $table->string('power');
            $table->string('dimensions');
            $table->string('cut_hole_diameter');
            $table->string('voltage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_products');
    }
};
