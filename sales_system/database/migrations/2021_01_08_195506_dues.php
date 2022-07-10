<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->increments("number");
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("national_number")->nullable();
            $table->date("debte_date");
            $table->float("amount");
            $table->date("payment_date");
            $table->string("description");
            $table->string("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dues');
    }
}
