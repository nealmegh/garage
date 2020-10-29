<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->string('registration_number');
            $table->date('registration_validity');
            $table->string('route_permit_number');
            $table->date('route_permit_validity');
            $table->string('fitness_number');
            $table->date('fitness_validity');
            $table->string('insurance_number');
            $table->date('insurance_validity');
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
        Schema::dropIfExists('vehicles');
    }
}
