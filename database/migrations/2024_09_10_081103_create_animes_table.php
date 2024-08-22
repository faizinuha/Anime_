<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->date('release_date');
            $table->text('description')->nullable();  // Deskripsi anime
            $table->enum('status', ['Ongoing', 'Completed', 'Upcoming'])->default('Upcoming');  // Status rilis
            $table->string('studio')->nullable();  // Studio produksi
            $table->integer('episodes')->nullable();  // Jumlah episode
            $table->string('trailer')->nullable();  // URL trailer
            $table->enum('type', ['TV', 'Movie', 'OVA', 'ONA', 'Special'])->default('TV');  // Tipe anime
            $table->integer('duration')->nullable();  // Durasi tiap episode
            $table->string('synonyms')->nullable();  // Nama sinonim
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
