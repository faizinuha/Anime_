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
        Schema::create('nobar_animes', function (Blueprint $table) {
            $table->id();
            $table->integer('Key_rom')->default(0);
            $table->dateTime('tanggal_waktu');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_peserta')->default(0);
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            
            $table->foreignId('anime_id')->constrained('animes'); // Foreign key untuk anime
            $table->foreignId('user_id')->constrained('users'); // Pastikan mengacu pada tabel 'users'
            $table->foreignId('comment_id')->contrained('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nobar_animes');
    }
};
