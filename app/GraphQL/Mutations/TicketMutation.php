<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\SupportTicket;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class TicketMutation
{
    /** @param  array{}  $args */
   
    public function createTicket($root, array $args, GraphQLContext $context)
    {
        $user = auth()->loginUsingId(1);   
        $file = $args['attached_file'];
        $path = $file->storePublicly('public/uploads');

        $ticket = SupportTicket::create([
            'user_id' => $user->id, 
            'subject' => $args['subject'],
            'priority' => $args['priority'],
            'attached_file' => $path,
        ]);

        $ticket->messages()->create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id, 
            'content' => $args['messages']  
        ]);

        return $ticket;
    }
}
