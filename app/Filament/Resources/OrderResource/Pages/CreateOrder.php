<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Copen;
use App\Models\Customer;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public $formData;
    public $code;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->code = Copen::query()->where('code', $data['copen_code'])
            ->where('state', 'unexpire')
            ->where('end_date', '>', now())
            ->first() ??  null;

        $this->formData = $data;
        return $data;
    }

    public function afterCreate()
    {
        $storedDataId = $this->record->getKey();
        $order = static::getModel()::find($storedDataId);
        $order->products()->sync($this->formData['OrderData'], [
            'price' => $order->final_price
        ]);

        $customer_id = $this->formData['customer_id'];
        $customerInfo = Customer::find($customer_id);

        if ($customerInfo->orders->count() != 0) {
            foreach ($customerInfo->orders as $item) {
                $copenCode = $item->copen_code;
                if ($item->where('copen_code', $this->code->code ?? null)->count() > 1) {
                    // copen code is already used
                    $order->update([
                        "copen_code" => null,
                        "copen_reason" =>  null,
                        "copen_status" =>  0
                    ]);
                } else {
                    $order->update([
                        "copen_code" => $this->formData['copen_code'],
                        "copen_reason" => $this->formData['copen_reason'],
                        "copen_status" =>  1
                    ]);
                }
            }
        }
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getURl('index');
    }
}
