<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Customer;
use App\Models\FlowerArrangement;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Order
    {
        return DB::transaction(function () use ($record, $data) {
            $record->update([
                'order_number' => $data['order_number'],
                'customer_id' => $data['customer_id'],
                'order_date' => $data['order_date'],
                'total_price' => 0,
                'discount' => 0,
            ]);

            $totalPrice = 0;

            $record->orderDetails()->delete();
            if (isset($data['orderDetails']) && is_array($data['orderDetails'])) {
                foreach ($data['orderDetails'] as $detail) {
                    $arrangement = FlowerArrangement::find($detail['arrangement_id']);
                    $unitPrice = $arrangement->price;
                    $subTotal = $detail['quantity'] * $unitPrice;
                    $totalPrice += $subTotal;

                    OrderDetail::create([
                        'order_id' => $record->order_id,
                        'arrangement_id' => $detail['arrangement_id'],
                        'quantity' => $detail['quantity'],
                        'unit_price' => $unitPrice,
                        'sub_total' => $subTotal,
                    ]);
                }
            }

            $customer = Customer::find($data['customer_id']);
            if ($customer->status === 'regular') {
                $discount = round($totalPrice * 0.1, 2);
            } elseif ($customer->status === 'non-regular' && $totalPrice >= 1000000) {
                $discount = round($totalPrice * 0.05, 2);
            } else {
                $discount = 0;
            }

            $totalPrice -= $discount;

            $record->total_price = $totalPrice;
            $record->discount = $discount;
            $record->save();

            $record->payments()->delete();
            if (isset($data['payments']) && is_array($data['payments'])) {
                foreach ($data['payments'] as $payment) {
                    Payment::create([
                        'order_id' => $record->order_id,
                        'payment_date' => $payment['payment_date'],
                        'total_payment' => $payment['total_payment'],
                        'payment_method' => $payment['payment_method'],
                        'payment_status' => $payment['payment_status'],
                    ]);
                }
            }

            $record->refresh();

            // Debugging output
            info("Order Update - Total Price: {$record->total_price}, Discount: {$record->discount}");

            return $record;
        });
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
