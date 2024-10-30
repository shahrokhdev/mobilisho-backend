<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final class UserMutation
{
    /** @param  array{}  $args */
   
    public function RegisterUser($root , array $args) {
        $user = new User();
        $user->name = $args['name'];
        $user->username = $args['username'];
        $user->email = $args['email'];
        $user->password = Hash::make($args['password']);
        $user->phone_number = $args['phone_number'];
        $user->state = $args['state'];
        $user->save();

        Auth::login($user);
        return $user;

    }
}
