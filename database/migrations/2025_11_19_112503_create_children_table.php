<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hwh_admission_id')->constrained('hwh_admissions')->onDelete('cascade');
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('children');
    }
};