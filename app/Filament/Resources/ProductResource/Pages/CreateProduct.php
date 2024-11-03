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
        $product->attributes()->sync($this->formData['properties']);
    }

    public function getRedirectUrl(): string { 
        return $this->getResource()::getURl('index');
     }
}
