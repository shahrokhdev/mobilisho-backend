<?php

namespace App\Filament\Resources\CopenResource\Pages;

use App\Filament\Resources\CopenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCopen extends CreateRecord
{
    protected static string $resource = CopenResource::class;

    public function afterCreate()
    {
        /*         $storedDataId = $this->record->getKey(); */

        $copen = static::getModel()::query()
            ->where('end_date', '<', now())
            ->get();

        foreach ($copen as $item) {
            $item->update([
                "state" => 'expired'
            ]);
            $item->save();
        }
    }
    public function isExpired()
    {
        return $this->end_date < now();
    }
}
