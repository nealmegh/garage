<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('driver_id')->references('id')->on('drivers');
            $table->string('license_photo')->nullable();
            $table->string('nid')->nullable();
            $table->string('nid_photo')->nullable();
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
        Schema::dropIfExists('driver_photos');
    }
}
