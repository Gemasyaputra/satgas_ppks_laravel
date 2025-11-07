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
}
