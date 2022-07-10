<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalesBells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_bells', function (Blueprint $table) {
            $table->string('number')->primary();
            $table->date('sell_date');
            $table->float('bell_total_price')->default(0.0);
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_bells');
    }
}
