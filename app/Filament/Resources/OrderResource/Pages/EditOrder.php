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

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Order
    {
        //     return DB::transaction(function () use ($data) {
        //         // Periksa apakah $data memiliki kunci 'order_id'
        //         if (isset($data['order_id'])) {
        //             // Temukan order berdasarkan 'order_id'
        //             $order = Order::find($data['order_id']);

        //             if ($order) {
        //                 // Jika order ditemukan, perbarui data
        //                 $order->update([
        //                     'order_number' => $data['order_number'] ?? $order->order_number,
        //                     'customer_id' => $data['customer_id'] ?? $order->customer_id,
        //                     'order_date' => $data['order_date'] ?? $order->order_date,
        //                     'discount' => $data['discount'] ?? $order->discount,
        //                 ]);

        //                 // Hapus order details lama dan tambahkan yang baru
        //                 $order->orderDetails()->delete();
        //                 if (isset($data['order_details'])) {
        //                     foreach ($data['order_details'] as $detail) {
        //                         $arrangement = FlowerArrangement::find($detail['arrangement_id']);
        //                         $unit_price = $arrangement->price;
        //                         $sub_total = $unit_price * $detail['quantity'];

        //                         OrderDetail::create([
        //                             'order_id' => $order->order_id,
        //                             'arrangement_id' => $detail['arrangement_id'],
        //                             'quantity' => $detail['quantity'],
        //                             'unit_price' => $unit_price,
        //                             'sub_total' => $sub_total,
        //                         ]);
        //                     }
        //                 }

        //                 // Update total price
        //                 $order->calculateTotalPrice();

        //                 // Update payments
        //                 $order->payments()->delete();
        //                 if (isset($data['payments'])) {
        //                     foreach ($data['payments'] as $payment) {
        //                         $paymentRecord = $order->payments()->create($payment);
        //                         $paymentRecord->total_payment = $order->total_price;
        //                         $paymentRecord->save();
        //                     }
        //                 }

        //                 // Update deliveries
        //                 $order->deliveries()->delete();
        //                 if (isset($data['deliveries'])) {
        //                     foreach ($data['deliveries'] as $delivery) {
        //                         $order->deliveries()->create($delivery);
        //                     }
        //                 }
        //             } else {
        //                 throw new \Exception('Order tidak ditemukan.');
        //             }
        //         } else {
        //             // Jika 'order_id' tidak ada, buat order baru
        //             $order = Order::create([
        //                 'order_number' => $data['order_number'],
        //                 'customer_id' => $data['customer_id'],
        //                 'order_date' => $data['order_date'],
        //                 'discount' => $data['discount'] ?? 0,
        //                 'total_price' => 0,
        //             ]);

        //             // Create order details
        //             if (isset($data['order_details'])) {
        //                 foreach ($data['order_details'] as $detail) {
        //                     $arrangement = FlowerArrangement::find($detail['arrangement_id']);
        //                     $unit_price = $arrangement->price;
        //                     $sub_total = $unit_price * $detail['quantity'];

        //                     OrderDetail::create([
        //                         'order_id' => $order->order_id,
        //                         'arrangement_id' => $detail['arrangement_id'],
        //                         'quantity' => $detail['quantity'],
        //                         'unit_price' => $unit_price,
        //                         'sub_total' => $sub_total,
        //                     ]);
        //                 }
        //             }

        //             // Calculate total price
        //             $order->calculateTotalPrice();

        //             // Create payments
        //             if (isset($data['payments'])) {
        //                 foreach ($data['payments'] as $payment) {
        //                     $paymentRecord = $order->payments()->create($payment);
        //                     $paymentRecord->total_payment = $order->total_price;
        //                     $paymentRecord->save();
        //                 }
        //             }

        //             // Create deliveries
        //             if (isset($data['deliveries'])) {
        //                 foreach ($data['deliveries'] as $delivery) {
        //                     $order->deliveries()->create($delivery);
        //                 }
        //             }
        //         }

        //         return $order;
        //     });
        // }
        return DB::transaction(function () use ($data) {
            // Panggil metode penyimpanan di OrderController
            $orderController = new OrderController();
            $response = $orderController->store(new \Illuminate\Http\Request($data));

            // Mengonversi respons JSON menjadi instance Order
            $order = Order::findOrFail($response->getData()->data->order_id);

            return $order;
        });
    }

    // Ensure there's no code between the closing curly brace above and the next method

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
