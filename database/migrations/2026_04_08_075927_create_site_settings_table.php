<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->default('RS Medika Nusantara');
            $table->string('hospital_tagline')->nullable()->default('Kesehatan Anda Prioritas Kami');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('address')->nullable()->default('Jl. Kesehatan No. 1, Jakarta Selatan 12345');
            $table->string('phone')->nullable()->default('(021) 1234-5678');
            $table->string('email')->nullable()->default('info@rsmedika.com');
            $table->string('hours')->nullable()->default('IGD: 24 Jam / 7 Hari');
            $table->text('footer_description')->nullable();
            $table->string('copyright_text')->nullable()->default('© {year} RS Company. Hak cipta dilindungi undang-undang.');
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_whatsapp')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};