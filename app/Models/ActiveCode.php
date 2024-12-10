<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', "expired_at", "user_id"];


    public function scopeVerifyCode($query, $code, $user)
    {
        return !! $user->whereCode($code)->where('expired_at', '>', now())->first();
    }

    public function scopeGenerateCode($query, $user)
    {
        $user->codes()->delete();
        do {
            $code = mt_rand(100000, 999999);
        } while ($this->checkCodeIsUnique($user, $code));

        // store the code
        $user->codes()->create([
            'code' => $code,
            'expired_at' => now()->addMinutes(10)
        ]);

        return $code;
    }

    public function checkCodeIsUnique($user, int $code)
    {
        return !! $user->codes()->whereCode($code)->first();
    }

    public function getAliveCodeForUser($user)
    {
        return $user->codes()->where('expired_at', '>', now())->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
