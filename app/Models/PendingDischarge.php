<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingDischarge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_district', 
        'resident_name',
        'discharge_date',
        'cnic',
        'admission_date',
        'status'
    ];

    protected $table = 'pending_discharges';

    /**
     * Get the user that created the pending discharge
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}