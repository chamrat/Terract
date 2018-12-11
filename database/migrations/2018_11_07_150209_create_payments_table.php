<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->string('payment_method');
            $table->date('payment_date');
            $table->integer('payment_month');
            $table->string('status')->nullable();
            $table->double('amount_due')->nullable();
            $table->string('note')->nullable();
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')->on('users');
            $table->integer('property_unit_id')->unsigned();
            $table->foreign('property_unit_id')->references('id')->on('property_units');
            $table->integer('credit_card_id')->unsigned()->nullable();
            $table->foreign('credit_card_id')->references('id')->on('credit_cards');
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
        Schema::dropIfExists('payment');
    }
}
