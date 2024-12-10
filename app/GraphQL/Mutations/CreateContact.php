<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Contact;

final class CreateContact
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $contact = new Contact();
        $contact->first_name = $args['first_name'];
        $contact->last_name = $args['last_name'];
        $contact->email = $args['email'];
        $contact->phone_number = $args['phone_number'];
        $contact->message = $args['message'];
        $contact->save();
        return $contact;
    }
}
