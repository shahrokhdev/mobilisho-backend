<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
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

        // dd($storedDataId, $this->formData);



        $product = static::getModel()::find($storedDataId);



        // dd($product);

        $product->attributes()->sync($this->formData['properties']);
    }

//    protected function handleRecordCreation(array $data): Model
// {
//     $product = static::getModel()::create($data);

//     $product->attributes()->sync($data['attributes']);
    
//     return $product;

// }
}
