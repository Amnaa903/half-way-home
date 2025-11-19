<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'hwh_admission_id',
        'name',
        'gender', 
        'age',
        'education'
    ];

    public function admission()
    {
        return $this->belongsTo(HWHAdmission::class, 'hwh_admission_id');
    }
}