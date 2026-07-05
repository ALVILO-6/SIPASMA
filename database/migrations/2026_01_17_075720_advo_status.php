<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advo_status', function(Blueprint $table) {
            $table->string('id_status')->primary();
            $table->string('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advo_status');
    }
};
