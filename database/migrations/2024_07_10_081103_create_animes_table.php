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
            $table->string('trailer')->nullable();  // URL trailer
            $table->foreignId('category_id')->nullable()->default(1)->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->text('description')->nullable();  // Deskripsi anime
            $table->string('status');
            $table->string('type');
            $table->string('studio')->nullable();  // Studio produksi
            $table->integer('episodes')->nullable();  // Jumlah episodeb
            $table->integer('TotalEps')->nullable();  // total episodeb
            $table->integer('duration')->nullable();  // Durasi tiap episode
            $table->string('synonyms')->nullable();  // Nama sinonim
            $table->date('release_date');
            $table->timestamps();
        });
        // $table->foreignId('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
        // $table->enum('status', ['Ongoing', 'Completed', 'Upcoming','FINISHED'])->default('Upcoming');  // Status rilis
        // $table->enum('type', ['TV', 'Movie', 'OVA', 'ONA', 'Special'])->default('TV');  // Tipe anime
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
