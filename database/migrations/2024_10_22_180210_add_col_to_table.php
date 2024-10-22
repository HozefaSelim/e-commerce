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
        Schema::table('cart_product', function (Blueprint $table) {
            $table->foreignId('product_variation_id')->constrained('product_variations')->onDelete('cascade')->nullable();
            $table->json('options_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_product', function (Blueprint $table) {
            $table->dropColumn('product_variation_id');
            $table->dropColumn('options_ids');
        });
    }
};
