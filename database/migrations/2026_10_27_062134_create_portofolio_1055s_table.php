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
        Schema::create('portofolio_1055s', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('tempat_tinggal');
        $table->string('kontak');
        $table->string('sosial_media');
        $table->text('tentang_saya')->nullable();
        $table->text('keahlian');
        $table->text('riwayat_pendidikan');
        $table->text('pengalaman_kerja')->nullable();
        $table->string('foto')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_1055s');
    }
};
