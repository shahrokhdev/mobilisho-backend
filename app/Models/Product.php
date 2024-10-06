<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;
class Product extends Model
{
    use HasFactory;
    use HasPersianSlug;
    protected $fillable = ['title','description','image','price','inventory','value_id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }


    public function attributes(){
         return $this->belongsToMany(Attribute::class)->withPivot(['value_id']);
    }



}
