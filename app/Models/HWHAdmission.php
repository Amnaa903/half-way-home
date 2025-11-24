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
        'patient_name', 'father_name', 'age', 'gender', 'cnic', 'phone',
        'education', 'address', 'marital_status', 'spouse_name',
        'children_count', 'boys_count', 'girls_count', 'religion',
        'guardian_name', 'guardian_contact', 'relationship', 'guardian_address',
        'admission_date', 'reason', 'disease_name', 'treatment_details',
        'case_history', 'other_diseases', 'id_card_front', 'id_card_back',
        'passport_photos', 'medical_reports', 'referral_form', 'affidavit',
        'additional_documents', 'incharge_id', 'reference_id', 'status',
        'discharge_date', 'discharge_reason', 'discharge_notes'
    ];

    protected $casts = [
        'passport_photos' => 'array',
        'medical_reports' => 'array',
        'additional_documents' => 'array',
        'admission_date' => 'date',
        'discharge_date' => 'date',
    ];

    public function children()
    {
        return $this->hasMany(Child::class, 'hwh_admission_id');
    }

    public function incharge()
    {
        return $this->belongsTo(Incharge::class);
    }

    public function getFormattedCnicAttribute()
    {
        if (!$this->cnic || strlen($this->cnic) !== 13) return $this->cnic;
        return substr($this->cnic, 0, 5) . '-' . substr($this->cnic, 5, 7) . '-' . substr($this->cnic, 12, 1);
    }
}