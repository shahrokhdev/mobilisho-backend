<?php

namespace App\Filament\Exports;

use App\Models\Discount;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DiscountExporter extends Exporter
{
    protected static ?string $model = Discount::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('discount_type')->label(__("general.discount_type")),
            ExportColumn::make('state')->label(__("general.state")),
            ExportColumn::make('discount_value')->label(__("general.discount_value")),
            ExportColumn::make('start_date')->label(__("general.start_date")),
            ExportColumn::make('end_date')->label(__("general.end_date")),
            ExportColumn::make('created_at')->label(__("general.created_at")),
            ExportColumn::make('updated_at')->label(__("general.updated_at")),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your discount export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
