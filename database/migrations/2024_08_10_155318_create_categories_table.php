<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Menambahkan relasi category_id ke dalam tabel animes
        Schema::table('animes', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    public function down() {
        Schema::table('animes', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('categories');
    }
};
