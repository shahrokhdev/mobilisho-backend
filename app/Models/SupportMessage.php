<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;
    protected $fillable = ["user_id" , 'ticket_id','content'] ;



    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function ticket() {
        return $this->belongsTo(SupportTicket::class);
    }
}