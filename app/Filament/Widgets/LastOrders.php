<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastOrders extends BaseWidget
{
    public function getTableHeading(): ?string
    {
        return __('general.last-order');
    }
    protected static ?int $sort = 4;
    protected  int | string | array  $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResource::getEloquentQuery()
            )->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('order_date')
                    ->searchable(isIndividual: true)
                    ->jalaliDate()
                    ->label(__("general.order_date")),

                TextColumn::make('total_amount')
                    ->searchable(isIndividual: true)
                    ->label(__("general.total_amount")),


                TextColumn::make('final_price')
                    ->searchable(isIndividual: true)
                    ->label(__("general.final_price")),


                TextColumn::make('star')
                    ->searchable(isIndividual: true)
                    ->label(__("general.star")),

                TextColumn::make('status')
                    ->searchable(isIndividual: true)
                    ->label(__("general.status")),

                BadgeColumn::make('status')
                    ->getStateUsing(function (Order $record) {
                        return $record->isState($record->status);
                    })->colors([
                        'success' => "paid",
                        'warning' => "pending",
                        'info' => "shipped",
                        'primary' => "delivered",
                        'danger' => 'cancelled',
                    ])->searchable(isIndividual: true)
                    ->label(__('general.status')),
            ]);
    }
}
