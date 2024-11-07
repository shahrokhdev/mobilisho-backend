<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment' , 'parent' , 'approved' , 'commentable_id' , 'commentable_type' , "user_id","status"];



    public function user(){
         return $this->belongsTo(User::class);
    }
    

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commentator(): BelongsTo
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


public function isApproved() {
     return $this->status == 'approved';
}

}
