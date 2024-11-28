<?php

namespace App\Filament\Exports;

use App\Models\Comment;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CommentExporter extends Exporter
{
    protected static ?string $model = Comment::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user_id')->label(__('general.user_id')),
            ExportColumn::make('commentable_id')->label(__('general.commentable_id')),
            ExportColumn::make('commentable_type')->label(__('general.commentable_type')),
            ExportColumn::make('parent')->label(__('general.parent')),
            ExportColumn::make('comment')->label(__('general.comment')),
            ExportColumn::make('status')->label(__('general.status')),
            ExportColumn::make('created_at')->label(__('general.created_at')),
            ExportColumn::make('updated_at')->label(__('general.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your comment export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
