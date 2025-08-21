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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('email_dpp');
            $table->string('email_dpd');
            $table->text('alamat');
            $table->string('notlp');
            $table->string('url_ig')->nullable();
            $table->string('url_twit')->nullable();
            $table->string('url_yt')->nullable();
            $table->string('url_fb')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
