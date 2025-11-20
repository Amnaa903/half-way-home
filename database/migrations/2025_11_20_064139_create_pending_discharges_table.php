<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_discharges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_district');
            $table->string('resident_name');
            $table->date('discharge_date');
            $table->string('cnic');
            $table->date('admission_date');
            $table->string('status')->default('pending');
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_district', 'status']);
            $table->index('cnic');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_discharges');
    }
}