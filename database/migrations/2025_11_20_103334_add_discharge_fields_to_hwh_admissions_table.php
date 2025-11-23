<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hwh_admissions', function (Blueprint $table) {
            // Agar status column nahi hai to ye bhi add karen
            if (!Schema::hasColumn('hwh_admissions', 'status')) {
                $table->enum('status', ['active', 'discharged'])->default('active');
            }
            
            if (!Schema::hasColumn('hwh_admissions', 'discharge_date')) {
                $table->date('discharge_date')->nullable();
            }
            
            // Ye dono missing columns add karen
            $table->text('discharge_reason')->nullable();
            $table->text('discharge_notes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('hwh_admissions', function (Blueprint $table) {
            $table->dropColumn(['discharge_reason', 'discharge_notes']);
        });
    }
};