<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('btn1_label')->nullable()->default('Lihat Layanan');
            $table->string('btn1_url')->nullable()->default('/layanan');
            $table->string('btn1_icon')->nullable();
            $table->string('btn2_label')->nullable()->default('Hubungi Kami');
            $table->string('btn2_url')->nullable()->default('/kontak');
            $table->string('btn2_icon')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('overlay_from')->nullable()->default('15,23,42');
            $table->string('overlay_mid')->nullable()->default('30,58,95');
            $table->string('overlay_to')->nullable()->default('29,119,232');
            $table->boolean('show_stats')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};