<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Copen;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;


    public $formData;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->formData = $data;
        return $data;
    }



    public function afterCreate()
    {
        $storedDataId = $this->record->getKey();
        $product = static::getModel()::find($storedDataId);
        $attachData = [];
        foreach ($this->formData['properties'] as $attribute) {
            $attachData[] = ['product_id' => $storedDataId, 'attribute_id' => $attribute['attribute_id'], 'value_id' => $attribute['value_id'], 'quantity' => $attribute['quantity'] ?? null, 'unit_price' => $attribute['unit_price'] ?? null];
        }
        $product->attributes()->detach(); // Attach new attributes
        foreach ($attachData as $data) {
            $product->attributes()->attach([$data['attribute_id'] => ['value_id' => $data['value_id'], 'quantity' => $data['quantity'], 'unit_price' => $data['unit_price']]]);
        }
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getURl('index');
    }
}
