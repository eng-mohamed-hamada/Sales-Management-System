<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Debtes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtes', function (Blueprint $table) {
            $table->increments("number");
            $table->date("debte_date");
            $table->float("amount");
            $table->date("payment_date");
            $table->string("description");
            $table->string("status");
            $table->integer("supplier_number")->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debtes');
    }
}
