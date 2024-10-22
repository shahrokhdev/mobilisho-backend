<?php

namespace App\Filament\Resources\SupportMessageResource\Pages;

use App\Filament\Resources\SupportMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportMessages extends ListRecords
{
    protected static string $resource = SupportMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
