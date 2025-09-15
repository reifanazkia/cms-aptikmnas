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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();

            // Step 1
            $table->string('title');
            $table->string('descroption');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('image')->nullable();

            // Step 2
            $table->string('title2')->nullable();
            $table->text('description2')->nullable();
            $table->string('title3')->nullable();
            $table->text('description3')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();

            // Step 3
            $table->string('title4')->nullable();
            $table->text('description4')->nullable();
            $table->string('image4')->nullable();

            // Social media
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('yt')->nullable();

            // Relations
            $table->foreignId('category_daftar_id')->nullable()->constrained('daftar_dpd_categories')->onDelete('cascade');

            $table->foreignId('category_pengurus_id')->nullable()->constrained('pengurus_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
