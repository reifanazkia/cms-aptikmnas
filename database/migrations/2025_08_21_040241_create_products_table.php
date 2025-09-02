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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->string('price');
            $table->string('disusun');
            $table->integer('jumlah_modul')->nullable();
            $table->string('bahasa')->nullable();
            $table->integer('discount')->nullable();
            $table->string('notlp');
            $table->foreignId('category_store_id')->constrained('store_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
