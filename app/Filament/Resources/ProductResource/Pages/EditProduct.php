<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;


    public $formData;

    public function mutateFormDataBeforeSave($data): array
    {



        $this->formData = $data;

        return $data;

    }


    public function afterSave()
    {

        $storedDataId = $this->record->getKey();

        $product = static::getModel()::find($storedDataId);


        $product->attributes()->sync($this->formData['properties']);


    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
