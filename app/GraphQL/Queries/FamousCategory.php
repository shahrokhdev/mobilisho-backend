<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Category;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class FamousCategory
{
    /** @param  array{}  $args */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $limit = $args['first'] ?? 3;
        return Category::orderBy('most_searched', 'desc')->take($limit)->get();
    }
}
