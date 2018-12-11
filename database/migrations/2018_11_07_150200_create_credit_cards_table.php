<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number');
            $table->integer('expiration_month');
            $table->integer('expiration_year');
            $table->integer('cvv');
            $table->string('billing_address')->nullable();
            $table->string('billint_zip_code')->nullable();
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')->on('users');
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
        Schema::dropIfExists('credit_card_info');
    }
}
