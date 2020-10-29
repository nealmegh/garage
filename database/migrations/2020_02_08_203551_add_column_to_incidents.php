<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToIncidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->bigInteger('case_id')->nullable();
            $table->decimal('penalty')->nullable();
            $table->string('law')->nullable();
            $table->string('doc_type')->nullable();
            $table->date('last_date')->nullable();
            $table->string('paid_by')->nullable();
            $table->bigInteger('rent_id')->nullable();
            $table->integer('doc_status')->nullable();
            $table->integer('payment_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn([
                'case_id',
                'penalty',
                'law',
                'doc_type',
                'last_date',
                'paid_by',
                'rent_id',
                'doc_status',
                'payment_status'
            ]);
        });
    }
}
