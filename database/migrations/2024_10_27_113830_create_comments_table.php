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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي للجدول
            $table->text('content'); // محتوى التعليق
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // الربط بجدول users
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // الربط بجدول posts
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
