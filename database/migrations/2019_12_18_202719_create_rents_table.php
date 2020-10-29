<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('driver_id');
            $table->bigInteger('vehicle_id');
            $table->integer('rent_type');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->date('rent_date');
            $table->float('rent')->nullable();
            $table->float('collection')->nullable();
            $table->float('due')->nullable();
            $table->string('remarks')->nullable();
            $table->string('damage_type')->nullable();
            $table->float('damage_amount')->nullable();
            $table->string('paid_by')->nullable();


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
        Schema::dropIfExists('rents');
    }
}
