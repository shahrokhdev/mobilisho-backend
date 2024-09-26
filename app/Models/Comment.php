<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment' , 'parent_id' , 'approved' , 'commentable_id' , 'commentable_type' , "user_id"];



    public function user(){
         return $this->belongsTo(User::class);
    }
    

    public function commentable()
    {
        return $this->morphTo();
    }

    public function child()
    {
        return $this->hasMany(Comment::class , 'parent' , 'id');
    }

    public static function boot()
{
    parent::boot();

    static::deleted(function ($comment) {
        $comment->child->each->delete();
    });
}

}
