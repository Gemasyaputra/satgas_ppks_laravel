<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportMessage extends Model
{   
    use HasFactory;
    
   protected $fillable = [
        'report_id',
        'user_id', // Pengirim
        'message',
        'sender_role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendapatkan laporan dari pesan ini.
     */
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
