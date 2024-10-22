<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","subject" , "priority",'attached_file','state','completed_at'] ;



    public function user() {
         return $this->belongsTo(User::class,"user_id");
    }
    public function messages() {
         return $this->hasMany(SupportMessage::class,"ticket_id");
    }
}
