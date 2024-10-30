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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('tps');
            $table->integer('dpt')->nullable();
            $table->integer('dptb')->nullable();
            $table->integer('g_1')->nullable();
            $table->integer('g_2')->nullable();
            $table->integer('g_ts')->nullable();
            $table->integer('b_1')->nullable();
            $table->integer('b_2')->nullable();
            $table->integer('b_ts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
