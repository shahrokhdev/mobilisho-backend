<?php

namespace App\Console\Commands;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DiscountExpire extends Command
{
    protected $signature = 'discount:expire';

    protected $description = 'Check for expired discount and update their state';

    public function handle()
    {
        Discount::where('end_date', '<', now())->update(['state' => 'expired']);
        
         Product::whereHas('discount', function ($query) {
            $query->where('end_date', '<', now());
        })->update(['dis_price' => null]);

    }
}
