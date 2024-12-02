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

    public function isAnswered() {
        return $this->state == 'answered';
     }

    public function isComplete() {
        return $this->completed_at == now();
     }

     public function isState($state) {
          switch($state)
          {
              case 'rejected' : 
             return $state = 'rejected';

              case 'pending' : 
                 return $state = 'pending';             
 
                 case 'in_progress' : 
                     return $state = 'in_progress';
     
                     case 'answered' : 
                         return $state = 'answered';
         
                     case 'closed' : 
                         return $state = 'closed';

                     case 'reopened' : 
                         return $state = 'reopened';
         
                         default : 
                         return "not found" ;
                          
 
          }
     }
}
