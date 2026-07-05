<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advo_faq', function(Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->text('pertanyaan');
            $table->text('jawaban');
            
            //Ambil kolom id_kategori dari advo_kategori sebagai foreign key
            $table->foreign('kategori')->references('id_kategori')->on('advo_kategori')->onUpdate('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('advo_faq');
    }
};
