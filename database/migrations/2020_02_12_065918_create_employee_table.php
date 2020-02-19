<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->integer('eid')->primary();
            $table->string('lastname');
            $table->string('midname');
            $table->string('firstname');
            $table->string('paddress');
            $table->string('caddress');
            $table->bigInteger('phoneno');
            $table->bigInteger('altphoneno');
            $table->string('email');
            $table->date('dob');
            $table->string('maritalstatus');
            $table->string('fathername');
            $table->string('deptid');
            $table->date('startdate');
            $table->bigInteger('salary');
            $table->string('photo');
            $table->string('sign');
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
        Schema::dropIfExists('employee');
    }
}
