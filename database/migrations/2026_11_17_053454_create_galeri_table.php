<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->string('nama_galeri');
            $table->string('path')->nullable();
            $table->string('galeri_seo')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();

            $table->foreignId('buku_id')
            ->constrained('books')
            ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
