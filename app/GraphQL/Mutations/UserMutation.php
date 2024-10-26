<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

final class UserMutation
{
    /** @param  array{}  $args */
   
    public function RegisterUser($root , array $args) {
      /*   $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone_number' => ['required', 'string', 'max:11'],
            'state' => ['required'],
        ]);
 */
       /*  $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'state' => $request->state,
        ]); */

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
    public function LoginUser($root , array $args) {
        $phoneNumber = $args['phone_number'];
        // Check if the phone number exists in the database
        $user = User::where('phone_number', $phoneNumber)->first();

        Auth::login($user);

        return $user ;

    }
}
