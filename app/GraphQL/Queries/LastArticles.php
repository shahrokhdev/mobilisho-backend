<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Article;

final  class LastArticles
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        return Article::query()->orderBy('created_at', "DESC")->take(5)->get();
    }
}
