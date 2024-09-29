<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $product = static::getModel()::create($data);
        foreach($data['attribute'] as $attr) {
            $product->attributes()->attach($attr['attribute_id'] , ['value_id' => $attr['value_id']]);
        }
        // $product->attributes()->cetr($data['attribute']);
        return $product;
        // dd($data);
    }
}
