<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advo_kategori',function(Blueprint $table) {
            $table->string('id_kategori')->primary();
            $table->string('kategori');
            $table->string('foto');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advo_kategori');
    }
};
