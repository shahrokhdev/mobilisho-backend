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
    protected $fillable = ['discount_id','title','description','image','price','dis_price','inventory'];

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
         return $this->belongsToMany(Attribute::class, 'attribute_product')->withPivot(['value_id','quantity','price']);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
