<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name' , 'family' , 'image', 'mobile' , 'birth_date' , 'gender'];

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }



    public function user() {
         return $this->belongsTo(User::class);
    }

    public function orders() {
         return $this->hasMany(Order::class);
    }

    public function copens() {
         return $this->belongsToMany(Copen::class);
    }

}
