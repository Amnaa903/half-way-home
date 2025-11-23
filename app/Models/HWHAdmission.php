<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HWHAdmission extends Model
{
    use HasFactory;

    protected $table = 'hwh_admissions';

    protected $fillable = [
        // Personal Information
        'patient_name',
        'father_name', 
        'age',
        'gender',
        'cnic',
        'phone',
        'education',
        'address',
        
        // Family Information
        'marital_status',
        'spouse_name',
        'children_count',
        'boys_count',
        'girls_count',
        'religion',
        
        // Guardian Information
        'guardian_name',
        'guardian_contact',
        'relationship',
        'guardian_address',
        
        // Medical History
        'admission_date',
        'reason',
        'disease_name',
        'treatment_details',
        'case_history',
        'other_diseases',
        
        // File Attachments
        'id_card_front',
        'id_card_back',
        'passport_photos',
        'medical_reports',
        'referral_form',
        'affidavit',
        'additional_documents',
        
        // Additional Fields
        'incharge_id',
        'reference_id',
        
        // Discharge Fields
        'status',
        'discharge_date',
        'discharge_reason',
        'discharge_notes'
    ];

    protected $casts = [
        'passport_photos' => 'array',
        'medical_reports' => 'array',
        'additional_documents' => 'array',
        'admission_date' => 'date',
        'discharge_date' => 'date',
    ];

    // Children relationship
    public function children()
    {
        return $this->hasMany(Child::class, 'hwh_admission_id');
    }

    // Incharge relationship
    public function incharge()
    {
        return $this->belongsTo(Incharge::class, 'incharge_id');
    }

    // Format CNIC for display
    public function getFormattedCnicAttribute()
    {
        if (!$this->cnic || strlen($this->cnic) !== 13) {
            return $this->cnic;
        }
        return substr($this->cnic, 0, 5) . '-' . substr($this->cnic, 5, 7) . '-' . substr($this->cnic, 12, 1);
    }

    // Scope for active admissions
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for discharged admissions
    public function scopeDischarged($query)
    {
        return $query->where('status', 'discharged');
    }

    // Generate reference ID
    public static function generateReferenceId()
    {
        return 'HWH-' . date('Ymd') . '-' . strtoupper(Str::random(6));
    }
}