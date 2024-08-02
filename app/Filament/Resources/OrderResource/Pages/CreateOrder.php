<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\FlowerArrangement;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\CreateRecord;
use App\Http\Controllers\OrderController;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;


class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function handleRecordCreation(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // Panggil metode penyimpanan di OrderController
            $orderController = new OrderController();
            $response = $orderController->store(new \Illuminate\Http\Request($data));

            // Mengonversi respons JSON menjadi instance Order
            $order = Order::findOrFail($response->getData()->data->order_id);

            return $order;
        });
        // return DB::transaction(function () use ($data) {
        //     $orderDetails = $data['orderDetails'] ?? [];
        //     $payments = $data['payments'] ?? [];

        //     $order = Order::create([
        //         'order_number' => $data['order_number'],
        //         'customer_id' => $data['customer_id'],
        //         'order_date' => $data['order_date'],
        //         'total_price' => 0,
        //         'discount' => 0,
        //     ]);

        //     $totalPrice = 0;
        //     foreach ($orderDetails as $detail) {
        //         $arrangement = FlowerArrangement::find($detail['arrangement_id']);
        //         if ($arrangement) {
        //             $unitPrice = $arrangement->price;
        //             $subTotal = $detail['quantity'] * $unitPrice;
        //             $totalPrice += $subTotal;

        //             OrderDetail::create([
        //                 'order_id' => $order->order_id,
        //                 'arrangement_id' => $detail['arrangement_id'],
        //                 'quantity' => $detail['quantity'],
        //                 'unit_price' => $unitPrice,
        //                 'sub_total' => $subTotal,
        //             ]);
        //         }
        //     }

        //     $discount = 0;
        //     $customer = Customer::find($data['customer_id']);
        //     if ($customer) {
        //         if ($customer->status === 'regular') {
        //             $discount = round($totalPrice * 0.1, 2);
        //         } elseif ($customer->status === 'non-regular' && $totalPrice >= 1000000) {
        //             $discount = round($totalPrice * 0.05, 2);
        //         }
        //     }

        //     $finalTotalPrice = $totalPrice - $discount;

        //     $order->total_price = $finalTotalPrice;
        //     $order->discount = $discount;
        //     $order->save();

        //     foreach ($payments as $payment) {
        //         Payment::create([
        //             'order_id' => $order->order_id,
        //             'payment_date' => $payment['payment_date'],
        //             'total_payment' => $payment['total_payment'],
        //             'payment_method' => $payment['payment_method'],
        //             'payment_status' => $payment['payment_status'],
        //         ]);
        //     }

        //     // Refresh and reload the order to make sure all relations are up-to-date
        //     $order->refresh();

        //     // Debugging output
        //     info("Order Creation - Total Price: {$order->total_price}, Discount: {$order->discount}");

        //     return $order;
        // });
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Order Created')
            ->body('Order has been successfully created.');
    }
}
