<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', // Mahasiswa yg lapor
        'category',
        'title',
        'description',
        'status',
        'admin_notes',
        'is_anonymous',
        'reporter_email',
        'reporter_name',
        'reporter_pob',
        'reporter_dob',
        'reporter_age',
        'reporter_occupation',
        'reporter_nim',
        'reporter_prodi',
        'reporter_gender',
        'reporter_phone',
        'reporter_address',
        'violence_type',
        'incident_location',
        'disability_status',
        'reported_party_name',
        'reported_party_occupation',
        'reported_party_age',
        'reason_for_reporting',
        'witness_contact',
        'victim_needs',
        'report_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->oldest(); // Relasi ke mahasiswa
    }

    public function messages()
    {
        return $this->hasMany(ReportMessage::class);
    }
}
