<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrderCharts extends ChartWidget
{

    public function getHeading(): ?string
     {
         return __('general.order-chart');
     }
    protected function getData(): array
    {
        $orderStatuses = ['pending' => __('general.pending'),
         'paid' => __('general.paid'), 
         'delivered' => __('general.delivered'), 
         'cancelled' => __('general.cancelled'),
          'shipped' => __('general.shipped') ]; 
          $data = [ 'pending' => Order::where('status', 'pending')->count(),
           'paid' => Order::where('status', 'paid')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
             'cancelled' => Order::where('status', 'cancelled')->count(), 
             'shipped' => Order::where('status', 'shipped')->count(), ]; 

             return [ 'datasets' => [
                 [ 
                'label' => __('general.order-chart'),
                'data' => array_values($data), ], ], 'labels' => array_values($orderStatuses), 
         ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
