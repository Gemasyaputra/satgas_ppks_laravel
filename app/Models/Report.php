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
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke mahasiswa
    }

    public function messages()
    {
        return $this->hasMany(ReportMessage::class);
    }
}
