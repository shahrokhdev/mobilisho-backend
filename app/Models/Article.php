<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     use HasFactory;

     protected $fillable = ['category_id', 'title', 'description', 'image'];




     public function category()
     {
          return $this->belongsTo(ArticleCategory::class);
     }

     public function comments()
     {
          return $this->morphMany(Comment::class, 'commentable');
     }
}
