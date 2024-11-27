<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Morilog\Jalali\Jalalian;

class ProductsChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('general.product-chart');
    }

    
    protected function getData(): array
    {
        $data = $this->getProductsPerMonth();

        return [
           'datasets' => [
            [
              'label' => __('general.product-chart') , 
              'data' =>  $data['productsPerMonth']
            ]
           ],
           'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getProductsPerMonth(): array 
    { 
        $now = Carbon::now(); 
        $persianMonths = [ 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند' ]; 
        $months = collect(range(1, 12))->map(function ($month) use ($now, &$productsPerMonth, $persianMonths) 
        { 
            $count = Product::whereMonth('created_at', $month) ->whereYear('created_at', $now->year) ->count(); 
            $productsPerMonth[] = $count; 
        $jalaliMonth = $persianMonths[$month - 1]; 
        return $jalaliMonth; 
    })->toArray();

         return [ 'productsPerMonth' => $productsPerMonth, 'months' => $months]; 
        }
}
