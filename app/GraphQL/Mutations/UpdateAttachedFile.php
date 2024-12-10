<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\SupportTicket;

final  class UpdateAttachedFile
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $file = $args['attached_file'];
        $path = $file->storePublicly('public/uploads');
        $ticket = SupportTicket::find($args['id']);
        $ticket->update([
            'attached_file' => $path
        ]);

        return  $ticket;
    }
}
