<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advo_aspirasi', function(Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim',9)->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('kategori');
            $table->text('aspirasi');
            $table->string('tracking_code', 9)->nullable()->unique();
            $table->text('tanggapan')->nullable();
            $table->boolean('bersedia')->default(false)->nullable(false);
            $table->string('status')->default('STS1');
            $table->string('pj',9)->nullable();

            //Ambil kolom NIM dari advo_struktur sebagai foreign key kolom pj
            $table->foreign('pj')->references('nim')->on('advo_struktur')->onDelete('set null')->onUpdate('cascade');

            //Ambil kolom kategori dari advo_kategori sebagai foreign key kolom kategori
            $table->foreign('kategori')->references('id_kategori')->on('advo_kategori');
            $table->foreign('status')->references('id_status')->on('advo_status');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("advo_aspirasi");
    }
};
