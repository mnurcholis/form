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
            $table->integer('dpt')->default(0);
            $table->integer('dptb')->default(0);
            $table->integer('g_1')->default(0);
            $table->integer('g_2')->default(0);
            $table->integer('g_ts')->default(0);
            $table->integer('b_1')->default(0);
            $table->integer('b_2')->default(0);
            $table->integer('b_ts')->default(0);
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
