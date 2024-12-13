<?php

namespace App\Filament\Resources\CopenResource\Pages;

use App\Filament\Resources\CopenResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCopen extends EditRecord
{
    protected static string $resource = CopenResource::class;

    public $formData;

    public function mutateFormDataBeforeSave($data): array
    {
        $this->formData = $data;
        return $data;
    }

    public function afterSave()
    {
        $storedDataId = $this->record->getKey();

        $formDataCollection = collect($this->formData['customer_id']);

        $formDataCollection->map(
            function ($item) use ($storedDataId) {
                /* check for selected options */
                if ($item == 'all') {
                    $customers = Customer::all();
                    foreach ($customers as $customer) {
                        $customer->copens()->detach(); // Attach new attributes
                        $customer->copens()->attach($storedDataId, ['customer_id' => $customer->id, 'copen_id' => $storedDataId]);
                    }
                } else {
                    $id = intval($item);
                    $customer = Customer::find($id);
                    $customer->copens()->detach(); // Attach new attributes
                    $customer->copens()->attach([$storedDataId => ['customer_id' => $item]]);
                }
            }
        )->all();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getURl('index');
    }
}
