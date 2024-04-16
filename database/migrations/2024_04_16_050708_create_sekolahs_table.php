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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nsm')->nullable();
            $table->string('npsm')->nullable();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->timestamps();
        });

        Schema::table('lilas', function (Blueprint $table) {
            $table->unsignedBigInteger('sekolah_id')->nullable()->after('id');
            $table->string('nik')->nullable()->after('nama');

            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
