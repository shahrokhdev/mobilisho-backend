<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Category;
use App\Models\Product;

final class Search
{
    /** @param  array{}  $args */

    public function __invoke($_, array $args)
    {
        $keyword = $args['keyword'];

        $productResults = Product::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->get();

        $categoryResults = Category::where('name', 'like', "%{$keyword}%")
            ->orWhere('slug', 'like', "%{$keyword}%")
            ->get();

        $results = $productResults->merge($categoryResults)->sortByDesc('name');;

        return $results->map(function ($result) {
            if ($result instanceof Product) {
                return [
                    'id' => $result->id,
                    'title' => $result->title,
                    'description' => $result->description,
                    'model_name' => "Product"
                ];
            } elseif ($result instanceof Category) {
                return [
                    'id' => $result->id,
                    'name' => $result->name,
                    'model_name' => "Category"
                ];
            }
        });
    }
}
