<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_regions', function (Blueprint $table) {
            $table->string('region_cd', 20)->primary('com_region_pkey');
			$table->string('region_nm', 100)->nullable();
			$table->string('region_root', 20)->nullable();
			$table->integer('region_level')->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('com_regions');
    }
};
