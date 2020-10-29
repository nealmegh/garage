<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name', 200);
            $table->string('customer_email', 200);
            $table->string('customer_address', 500);
            $table->bigInteger('customer_contact1')->nullable();
            $table->bigInteger('customer_contact2')->nullable();
            $table->float('balance', 10, 0)->default(0)->unsigned();
            $table->float('due', 10, 0)->default(0)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_details');
    }
}
