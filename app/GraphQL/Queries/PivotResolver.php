<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\AttributeValue;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final  class PivotResolver
{
   public function resolveValueName($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
   {
      return AttributeValue::find($root->value_id)->value;
   }
}
