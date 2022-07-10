<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('depart_number')->references('number')->on('departments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('degree_number')->references('number')->on('degrees')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('attendees', function (Blueprint $table) {
            $table->foreign('emp_national_number')->references('national_number')->on('employees')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('borrows', function (Blueprint $table) {
            $table->foreign('emp_national_number')->references('national_number')->on('employees')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('installments', function (Blueprint $table) {
            $table->foreign('borrow_number')->references('number')->on('borrows')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('depart_number')->references('number')->on('departments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_number')->references('number')->on('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('debtes', function (Blueprint $table) {
            $table->foreign('supplier_number')->references('number')->on('suppliers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('product_number')->references('number')->on('products')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('purchase_bell_number')->references('number')->on('purchase_bells')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('purchase_bells', function (Blueprint $table) {
            $table->foreign('supplier_number')->references('number')->on('suppliers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('product_number')->references('number')->on('products')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('sales_bell_number')->references('number')->on('sales_bells')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
