<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stock_name', 120);
            $table->integer('category_id');
            $table->string('category_name',120)->nullable();
            $table->decimal('purchase_cost', 10,0)->unsigned()->nullable()->default(0);
            $table->decimal('selling_cost', 10,0)->unsigned()->nullable()->default(0);
            $table->integer('supplier_id')->unsigned();
            $table->string('supplier_name',120)->nullable();
            $table->integer('stock_quantity')->default(0)->unsigned();
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
        Schema::dropIfExists('stock_details');
    }
}
