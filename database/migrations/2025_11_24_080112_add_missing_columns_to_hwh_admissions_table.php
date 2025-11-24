<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hwh_admissions', function (Blueprint $table) {
            // Add missing columns
            $table->string('reference_id')->unique()->after('id');
            $table->unsignedBigInteger('incharge_id')->nullable()->after('other_diseases');

            // Fix column types for JSON fields (currently longtext with utf8mb4_bin)
            $table->json('passport_photos')->nullable()->change();
            $table->json('medical_reports')->nullable()->change();
            $table->json('additional_documents')->nullable()->change();

            // Optional: Add foreign key if you have incharges table
            // $table->foreign('incharge_id')->references('id')->on('incharges')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('hwh_admissions', function (Blueprint $table) {
            $table->dropColumn('reference_id');
            $table->dropColumn('incharge_id');
            
            // Revert JSON columns back if needed
            $table->longText('passport_photos')->nullable()->change();
            $table->longText('medical_reports')->nullable()->change();
            $table->longText('additional_documents')->nullable()->change();
        });
    }
};