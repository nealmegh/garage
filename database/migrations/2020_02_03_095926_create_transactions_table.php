<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('method')->nullable();
            $table->string('payment_for')->nullable();
            $table->bigInteger('driver_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('notes')->nullable();
            $table->bigInteger('case_id')->nullable();
            $table->bigInteger('loan_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
