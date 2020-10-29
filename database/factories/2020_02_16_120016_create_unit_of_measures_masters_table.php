<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitOfMeasuresMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_measures_masters', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->integer('uom_id', true);
            $table->string('name', 16)->nullable();
            $table->string('symbol', 8)->nullable();
            $table->string('measure_id', 16)->nullable();
            $table->timestamps();
            $table->boolean('status')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_of_measures_masters');
    }
}
