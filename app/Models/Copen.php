<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copen extends Model
{
    use HasFactory;

    protected $fillable = ["code","state","discount_type","discount_value","start_date","end_date","usage_limit"];


    public function customers() {
        return $this->belongsToMany(Customer::class);
     }


     public function isExpired() {
          return $this->state == 'unexpire';
     }
 


   
}
