<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Notifications\ActiveCode as ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Nette\Schema\Context;

final class UserMutation
{
    /** @param  array{}  $args */
   
    public function registerUser($root , array $args) {

        $user = new User();
        $user->name = $args['name'];
        $user->username = $args['username'];
        $user->email = $args['email'];
        $user->password = Hash::make($args['password']);
        $user->phone_number = $args['phone_number'];
        $user->save();

        $code = $user->codes()->generateCode($user);
        $user->notify(new ActiveCodeNotification($code , $args['phone_number']));
        return $user;

    }

    public function verifyUser($root , array $args) {
        $code = $args['code'];
        $phoneNumber = $args['phone_number'];

        $user = User::where('phone_number',$phoneNumber)->first();
 

        if(!$code || $code != $user->codes()->first()->code){
            throw new \Exception('Invalid code or user not found', 400);
        }

        $user->is_verified = true;
        $user->save();

       Auth::login($user);
        return $user ;
    }
}
