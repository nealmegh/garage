<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('damages', function (Blueprint $table) {
            $table->boolean('partial_payment')->default(0)->nullable();
            $table->decimal('partial_payment_amount')->default(0)->nullable();
            $table->string('details')->nullable();
            $table->decimal('owner_amount')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('damages', function (Blueprint $table) {
            $table->dropColumn('partial_payment');
            $table->dropColumn('partial_payment_amount');
            $table->dropColumn('details');
            $table->dropColumn('owner_amount');
        });
    }
}
