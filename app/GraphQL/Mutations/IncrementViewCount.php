<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Product;

final  class IncrementViewCount
{
    public function incrementView($root, array $args)
    {
        $product = Product::findOrFail($args['id']);
        $this->incrementValue( $product);
        return $product;
    }

    private function incrementValue(Product $product): void
    {
        $product->view_count++;
        $product->save();
    }
}
