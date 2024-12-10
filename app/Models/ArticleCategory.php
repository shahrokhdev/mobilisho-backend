<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleCategory extends Model
{
    use HasFactory;
    use HasPersianSlug;
    protected $fillable = ['parent', 'name', 'image'];



    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
