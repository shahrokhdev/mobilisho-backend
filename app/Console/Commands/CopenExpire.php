<?php

namespace App\Console\Commands;

use App\Models\Copen;
use Illuminate\Console\Command;

class CopenExpire extends Command
{
    protected $signature = 'copen:expire';

    protected $description = 'Check for expired Copens and update their state';

    public function handle()
    {
        Copen::where('end_date', '<', now())->update(['state' => 'expired']);
    }
}
