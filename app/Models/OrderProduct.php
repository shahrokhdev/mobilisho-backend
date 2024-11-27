<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','attribute_id','value_id','price','quantity'];

    
    public function order() {
        return $this->belongsTo(Order::class);
    }
    public function products() {
        return $this->belongsToMany(Product::class);
    }



}
