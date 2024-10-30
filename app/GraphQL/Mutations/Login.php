<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class Login
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $user = User::where('phone_number', $args['phone_number'])->first();
 
        if (! $user || ! Hash::check($args['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken($args['device'])->plainTextToken;
    }
}
