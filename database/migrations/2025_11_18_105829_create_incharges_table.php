<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInchargesTable extends Migration
{
    public function up()
    {
        Schema::create('incharges', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_district');
            $table->string('rname');
            $table->date('reg_date');
            $table->string('rcnic');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incharges');
    }
}