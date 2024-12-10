<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\SupportTicket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget

{
    protected static ?string $pollingInterval = '30s';
    protected static bool $isLazy = true;
    protected static ?int $sort = 5;
    protected function getStats(): array
    {
        return [

            Stat::make('total-articles', Article::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.articles')),
            Stat::make('total-categories', Category::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.categories')),
            Stat::make('total-products', Product::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.products')),
            Stat::make('total-orders', Order::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.orders')),
            Stat::make('total-tickets', SupportTicket::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.tickets')),
            Stat::make('total-customers', Customer::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.customers')),
            Stat::make('total-users', User::count())->description(__("general.is-exist"))->descriptionIcon('heroicon-m-arrow-trending-up')->color('success')->chart([7, 3, 4, 5, 6, 3, 5])->label(__('general.users'))
        ];
    }
}
