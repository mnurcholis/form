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
        Schema::create('form_garage_shows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolahorg_id')->nullable();
            $table->string('type')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_garage_shows');
    }
};
