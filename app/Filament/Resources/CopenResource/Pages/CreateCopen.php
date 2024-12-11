<?php

namespace App\Filament\Resources\CopenResource\Pages;

use App\Filament\Resources\CopenResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCopen extends CreateRecord
{
    protected static string $resource = CopenResource::class;

    public $formData;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->formData = $data;
        return $data;
    }
    public function afterCreate()
    {
        $storedDataId = $this->record->getKey();

        $copen = static::getModel()::query()
            ->where('end_date', '<', now())
            ->get();

        foreach ($copen as $item) {
            $item->update([
                "state" => 'expired'
            ]);
            $item->save();
        }

        /* Add all ids to a collection */
        $formDataCollection = collect($this->formData['customer_id']);

        $formDataCollection->map(
            function ($item) use ($storedDataId) {
                /* check for selected options */
                if ($item == 'all') {
                    $customers = Customer::all();
                    foreach ($customers as $customer) {
                        $customer->copens()->attach($storedDataId, ['customer_id' => $customer->id, 'copen_id' => $storedDataId]);
                    }
                } else {
                    $id = intval($item);
                    $customer = Customer::find($id);
                    $customer->copens()->attach([$storedDataId => ['customer_id' => $item]]);
                }
            }
        )->all();
    }
    public function isExpired()
    {
        return $this->end_date < now();
    }
}
