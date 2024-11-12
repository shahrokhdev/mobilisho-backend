<?php

namespace App\Console\Commands;

use App\Models\Discount;
use Illuminate\Console\Command;

class DiscountExpire extends Command
{
    protected $signature = 'discount:expire';

    protected $description = 'Check for expired discount and update their state';

    public function handle()
    {
        Discount::where('end_date', '<', now())->update(['state' => 'expired']);
    }
}
