<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('discount_id')->label(__('general.discount_id')),
            ExportColumn::make('title')->label(__('general.title')),
            ExportColumn::make('slug')->label(__('general.slug')),
            ExportColumn::make('description')->label(__('general.description')),
            ExportColumn::make('image')->label(__('general.image')),
            ExportColumn::make('price')->label(__('general.price')),
            ExportColumn::make('dis_price')->label(__('general.dis_price')),
            ExportColumn::make('inventory')->label(__('general.inventory')),
            ExportColumn::make('best_selling')->label(__('general.best_selling')),
            ExportColumn::make('view_count')->label(__('general.view_count')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
