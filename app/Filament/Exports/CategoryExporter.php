<?php

namespace App\Filament\Exports;

use App\Models\Category;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CategoryExporter extends Exporter
{
    protected static ?string $model = Category::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('parent.name')->label(__('general.parent')),
            ExportColumn::make('name')->label(__('general.name')),
            ExportColumn::make('slug')->label(__('general.slug')),
            ExportColumn::make('image')->label(__('general.image')),
            ExportColumn::make('most_searched')->label(__('general.most_searched')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your category export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
