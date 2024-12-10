<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable= ['name'];

    use HasFactory;


    public function products() 
    { 
        return $this->belongsToMany(Product::class, 'attribute_product')->withPivot('value_id', 'quantity', 'price');
    }

    public function values() {
        return $this->hasMany(AttributeValue::class);
    }
}
