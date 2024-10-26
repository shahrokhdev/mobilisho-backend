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
    protected $fillable = ['title','description','image','price','inventory'];

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
         return $this->belongsToMany(Attribute::class, 'attribute_product')->withPivot(['value_id']);
    }

    public function discounts() {
        return $this->belongsTo(Product::all());
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


}
