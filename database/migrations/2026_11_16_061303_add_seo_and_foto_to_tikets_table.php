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
        Schema::table('tikets', function (Blueprint $table) {
            $table->string('tiket_seo')->nullable()->after('nama');
            $table->string('foto')->nullable()->after('tiket_seo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {
            //
        });
    }
};
