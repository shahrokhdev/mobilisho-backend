<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['value'];
    use HasFactory;

    public function attributes() {
        return $this->belongsTo(Attribute::class);
    }
}
