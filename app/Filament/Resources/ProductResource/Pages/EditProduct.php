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

        $attachData = []; 
        foreach ($this->formData['properties'] as $attribute) 
        {
             $attachData[] = [ 'product_id' => $storedDataId, 'attribute_id' => $attribute['attribute_id'], 'value_id' => $attribute['value_id'], 'quantity' => $attribute['quantity'] ?? null,'price' => $attribute['price'] ?? null, ]; 
        } 
            $product->attributes()->detach(); // Attach new attributes
             foreach ($attachData as $data)
              { 
                $product->attributes()->attach([$data['attribute_id'] => [ 'value_id' => $data['value_id'], 'quantity' => $data['quantity'] , 'price' => $data['price'] ]]); 
              }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): string { 
        return $this->getResource()::getURl('index');
     }
}
