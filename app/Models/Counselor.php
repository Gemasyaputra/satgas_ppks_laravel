<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        // 'specialization',
        // 'description',
        'experience',
        'photo_url',
        'is_active'
    ];
    public function counselingSchedules()
    {
        return $this->hasMany(CounselingSchedule::class);
    }   
}
