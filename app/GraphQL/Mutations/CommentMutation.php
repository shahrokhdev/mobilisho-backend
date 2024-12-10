<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CommentMutation
{
    /** @param  array{}  $args */

    public function createComment($root, array $args, GraphQLContext $context)
    {
        $comment = new Comment;
        $comment->user_id = 2;
        $comment->commentable_id = $args['commentable_id'];
        $comment->commentable_type = $args['commentable_type'];
        $comment->comment = $args['comment'];
        $comment->parent = $args['parent'] ?? 0;
        $comment->save();
        return $comment;
    }
}
