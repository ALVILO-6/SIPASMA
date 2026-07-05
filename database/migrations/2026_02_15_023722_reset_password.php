<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reset_password', function(Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            //Ambil kolom nim di advo_struktur sebagai foreign key kolom nim reset_password
            $table->foreign('nim')->references('nim')->on('advo_struktur');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reset_password');
    }
};
