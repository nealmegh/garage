<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id');
            $table->string('supplier_name', 260);
            $table->string('supplier_address', 260);
            $table->biginteger('supplier_contact1');
            $table->decimal('opening_due',10,2)->unsigned();
            $table->decimal('opening_balance',10,2)->unsigned();

            $table->decimal('purchase_total',10,2)->unsigned();

            $table->decimal('discount_percent',10,2)->unsigned();
            $table->decimal('discount_amount',10,2)->unsigned();

            $table->string('tax_description',255)->nullable();
            $table->decimal('tax_percent',10,2)->unsigned();
            $table->decimal('tax_amount',10,2)->unsigned();

            $table->string('description',255)->nullable();
            $table->decimal('grand_total',10,2)->unsigned();
            $table->decimal('payment',10,2)->unsigned();
            $table->decimal('closing_due',10,2)->unsigned();
            $table->decimal('closing_balance',10,2)->unsigned();
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
        Schema::dropIfExists('purchase_details');
    }
}
