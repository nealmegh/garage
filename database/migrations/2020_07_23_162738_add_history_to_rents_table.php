<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHistoryToRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->decimal('amount_collected')->default(0);
            $table->decimal('amount_remained')->default(0);
            $table->bigInteger('damage_id')->nullable();
            $table->bigInteger('incident_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('amount_collected');
            $table->dropColumn('amount_remained');
            $table->dropColumn('damage_id');
            $table->dropColumn('incident_id');
        });
    }
}
