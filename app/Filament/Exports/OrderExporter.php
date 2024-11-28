<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('customer_id')->label(__('general.customer_id')),
            ExportColumn::make('discount_id')->label(__('general.discount_id')),
            ExportColumn::make('order_date')->label(__('general.order_date')),
            ExportColumn::make('status')->label(__('general.status')),
            ExportColumn::make('total_amount')->label(__('general.total_amount')),
            ExportColumn::make('payment_method')->label(__('general.payment_method')),
            ExportColumn::make('delivery_address')->label(__('general.delivery_address')),
            ExportColumn::make('final_price')->label(__('general.final_price')),
            ExportColumn::make('copen_code')->label(__('general.copen_code')),
            ExportColumn::make('copen_reason')->label(__('general.copen_reason')),
            ExportColumn::make('copen_status')->label(__('general.copen_status')),
            ExportColumn::make('star')->label(__('general.star')),
            ExportColumn::make('tracking_serial')->label(__('general.tracking_serial')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {

        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFormats(): array
{
    return [
        ExportFormat::Csv,
    ];
}
}
