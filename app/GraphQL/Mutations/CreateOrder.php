<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Order;

final class CreateOrder
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $order = new Order;
        $order->order_date =  $args['order_date'];
        $order->total_amount = $args['total_amount'];
        $order->delivery_address = $args['delivery_address'];
        $order->copen_code = $args['copen_code'];
        $order->copen_reason = $args['copen_reason'];
        $order->final_price = $args['final_price'];
        $order->star = $args['star'];
        $order->save();
        return $order;
    }
}
