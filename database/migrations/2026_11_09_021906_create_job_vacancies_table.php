<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->default('Galaxy Waterpark Jogja');
            $table->string('location')->default('Bantul, Yogyakarta');
            $table->integer('salary')->nullable();
            $table->string('jenis_pekerjaan')->default('Full-time'); // Latihan 1: Kolom Jenis Pekerjaan
            $table->text('description');
            $table->string('logo')->nullable(); // Kolom path berkas gambar logo/banner
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};