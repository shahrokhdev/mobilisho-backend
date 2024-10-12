<?php

namespace App\Filament\Resources\CopenResource\Pages;

use App\Filament\Resources\CopenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCopen extends EditRecord
{
    protected static string $resource = CopenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
