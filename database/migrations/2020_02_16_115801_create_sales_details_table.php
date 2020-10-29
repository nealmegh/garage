<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->string('customer_name',64);
            $table->string('customer_address', 260);
            $table->biginteger('customer_contact1');
            $table->float('opening_balance',10,2)->unsigned();
            $table->float('opening_due',10,2)->unsigned();

            $table->float('sales_total',10,2)->unsigned();
            $table->float('discount_percent',10,2)->unsigned();
            $table->float('discount_amount',10,2)->unsigned();
            $table->string('tax_description',255)->nullable();
            $table->float('tax_percent',10,2)->unsigned();
            $table->float('tax_amount',10,2)->unsigned();

            $table->string('sales_description',255)->nullable();
            $table->float('grand_total',10,2)->unsigned();
            $table->float('payment',10,2)->unsigned();
            $table->float('closing_balance',10,2)->unsigned();
            $table->float('closing_due',10,2)->unsigned();
            $table->boolean('mode');
            $table->string('billnumber', 120)->nullable();
            $table->date('billdate')->nullable();
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
        Schema::dropIfExists('sales_details');
    }
}
