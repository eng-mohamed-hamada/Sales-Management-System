<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('national_number')->primary();
            $table->string('phone');
            $table->string('name');
            $table->string('address');
            $table->integer('age');
            $table->string('photo');
            $table->date('hiring_date');
            $table->float('salary');
            $table->string('gender');
            $table->integer('depart_number')->unsigned()->index();
            $table->integer('degree_number')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
