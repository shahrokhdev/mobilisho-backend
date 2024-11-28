<?php

namespace App\Filament\Resources\CopenResource\Pages;

use App\Filament\Resources\CopenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCopens extends ListRecords
{
    protected static string $resource = CopenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('general.create-copen')),
        ];
    }
}
