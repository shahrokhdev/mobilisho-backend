<?php

namespace App\Filament\Exports;

use App\Models\Customer;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CustomerExporter extends Exporter
{
    protected static ?string $model = Customer::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user_id')->label(__('general.user_id')),
            ExportColumn::make('province_id')->label(__('general.province_id')),
            ExportColumn::make('city_id')->label(__('general.city_id')),
            ExportColumn::make('town_id')->label(__('general.town_id')),
            ExportColumn::make('name')->label(__('general.name')),
            ExportColumn::make('family')->label(__('general.family')),
            ExportColumn::make('image')->label(__('general.image')),
            ExportColumn::make('mobile')->label(__('general.mobile')),
            ExportColumn::make('birth_date')->label(__('general.birth_date')),
            ExportColumn::make('gender')->label(__('general.gender')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your customer export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
