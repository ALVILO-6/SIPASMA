<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advo_struktur', function(Blueprint $table) {
            $table->string('nim',9)->primary();
            $table->string('foto');
            $table->string('nama');
            $table->string('panggilan');
            $table->string('jabatan');
            $table->boolean('status_lantik')->default(false);
            $table->string('password');
            $table->boolean('logged_in')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advo_struktur');
    }
};
