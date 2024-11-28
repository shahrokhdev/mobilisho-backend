<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name')->label(__('general.name')),
            ExportColumn::make('username')->label(__('general.username')),
            ExportColumn::make('email')->label(__('general.email')),
            ExportColumn::make('phone_number')->label(__('general.phone_number')),
            ExportColumn::make('state')->label(__('general.state')),
            ExportColumn::make('email_verified_at')->label(__('general.email_verified_at')),
            ExportColumn::make('is_verified')->label(__('general.is_verified')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
