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
        // Only create tables if they don't exist
        if (!Schema::hasTable('color_product')) {
            Schema::create('color_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('color_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['color_id', 'product_id']);
            });
        }

        if (!Schema::hasTable('attribute_product')) {
            Schema::create('attribute_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->string('value')->nullable();
                $table->timestamps();
                $table->unique(['attribute_id', 'product_id']);
            });
        }

        if (!Schema::hasTable('dimension_option_product')) {
            Schema::create('dimension_option_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('dimension_option_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['dimension_option_id', 'product_id']);
            });
        }

        if (!Schema::hasTable('family_product_product')) {
            Schema::create('family_product_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('family_product_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['family_product_id', 'product_id']);
            });
        }

        if (!Schema::hasTable('accessory_product')) {
            Schema::create('accessory_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('accessory_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['accessory_id', 'product_id']);
            });
        }

        if (!Schema::hasTable('installation_method_product')) {
            Schema::create('installation_method_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('installation_method_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['installation_method_id', 'product_id'], 'inst_method_prod_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installation_method_product');
        Schema::dropIfExists('accessory_product');
        Schema::dropIfExists('family_product_product');
        Schema::dropIfExists('dimension_option_product');
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('color_product');
    }
};
