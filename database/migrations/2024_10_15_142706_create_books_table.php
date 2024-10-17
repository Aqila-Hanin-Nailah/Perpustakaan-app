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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            // menambahkan column 
            $table->integer('no_buku');
            $table->string('name');
            $table->integer('stock');
            $table->enum('type', ['Novel', 'Komik', 'Ensiklopedia', 'Biografi']);
            $table->enum('genre', ['Romantis', 'Sci-fi', 'Puisi', 'Fiksi', 'Non-fiksi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
