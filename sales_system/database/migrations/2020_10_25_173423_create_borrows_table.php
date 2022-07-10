<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->string('number')->primary();
            $table->date('borrow_date');
            $table->float('amount');
            $table->float('paymented_amount')->default(0.0);
            $table->float('installment_amount')->default(0.0);
            $table->integer('installment_payment_day')->unsigned();
            $table->string('last_paymented_mounth');
            $table->float('remiander')->default(0.0);
            $table->text('description');
            $table->float('benefits');
            $table->float('total_amount');
            $table->string('emp_national_number')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
