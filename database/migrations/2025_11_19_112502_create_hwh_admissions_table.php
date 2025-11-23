<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // ✅ YEH CORRECT NAMESPACE HAI

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hwh_admissions', function (Blueprint $table) {
            $table->id();
            
            // Personal Information - EXISTING
            $table->string('patient_name');
            $table->string('father_name');
            $table->integer('age');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('cnic', 15)->unique();
            $table->string('phone', 15);
            $table->string('education')->nullable();
            $table->text('address');
            
            // Family Information - EXISTING
            $table->enum('marital_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('spouse_name')->nullable();
            $table->integer('children_count')->default(0);
            $table->integer('boys_count')->default(0);
            $table->integer('girls_count')->default(0);
            $table->string('religion')->nullable();
            
            // Guardian Information - EXISTING
            $table->string('guardian_name');
            $table->string('guardian_contact', 15);
            $table->string('relationship');
            $table->text('guardian_address');
            
            // Medical History - EXISTING
            $table->date('admission_date');
            $table->text('reason')->nullable();
            $table->string('disease_name');
            $table->text('treatment_details');
            $table->text('case_history');
            $table->text('other_diseases')->nullable();
            
            // File paths - EXISTING
            $table->string('id_card_front');
            $table->string('id_card_back');
            $table->json('passport_photos');
            $table->json('medical_reports');
            $table->string('referral_form');
            $table->string('affidavit')->nullable();
            $table->json('additional_documents')->nullable();
            
            // ✅ DISCHARGE FIELDS ADDED
            $table->enum('status', ['active', 'discharged'])->default('active');
            $table->date('discharge_date')->nullable();
            $table->text('discharge_reason')->nullable();
            $table->text('discharge_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hwh_admissions');
    }
};