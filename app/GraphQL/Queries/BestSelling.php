<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;

final class BestSelling
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        return  Product::query()->whereNot('best_selling', 0)->orderBy("best_selling", "DESC")->take(5)->get();
    }

    public function AllBestSelling()
    {
        return  Product::query()->orderBy("best_selling", "DESC")->get();
    }
}
