<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurchaseBells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_bells', function (Blueprint $table) {
            $table->string('number')->primary();
            $table->date('purchase_date');
            $table->float('bell_total_price')->default(0.0);
            $table->integer('supplier_number')->unsigned()->index();
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
        Schema::dropIfExists('purchase_bells');
    }
}
