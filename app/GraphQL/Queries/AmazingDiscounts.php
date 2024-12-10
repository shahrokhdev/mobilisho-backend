<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;

final  class AmazingDiscounts
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $activeProducts = Product::whereHas('discount', function ($query) {
            $query->where('end_date', '>=', now());
        })->take(5)->get();
        return $activeProducts;
    }

    public function AllAmazingDiscounts()
    {
        $activeProducts = Product::whereHas('discount', function ($query) {
            $query->where('end_date', '>=', now());
        })->get();
        return $activeProducts;
    }
}
