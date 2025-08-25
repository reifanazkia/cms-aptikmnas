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
        Schema::create('testimonies', function (Blueprint $table) {
            $table->id();
            $table->boolean('display_homepage')->default(false);
            $table->foreignId('category_testimony_id')->nullable()->constrained('testimony_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('title')();
            $table->longText('description')();
            $table->string('image')(); // path gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonies');
    }
};
