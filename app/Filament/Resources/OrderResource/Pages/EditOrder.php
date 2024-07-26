<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Http\Controllers\OrderController;
use App\Models\Customer;
use App\Models\FlowerArrangement;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Filament\Pages\Actions;


class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function save(bool $shouldRedirect = true): void
    {
        $data = $this->form->getState();

        $order = DB::transaction(function () use ($data) {
            $order = $this->getRecord();
            $order->update($data);
            $order->orderDetails();
            $order->payments();
            $order->deliveries();
            return $order;
            return $order->fresh();
        });
        $this->record = $order;
        if ($shouldRedirect) {
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }



    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
