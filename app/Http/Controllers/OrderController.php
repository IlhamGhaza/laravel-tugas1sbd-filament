<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\FlowerArrangement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // Create the order
        $order = Order::create([
            'order_number' => $data['order_number'],
            'customer_id' => $data['customer_id'],
            'order_date' => $data['order_date'],
            'discount' => $data['discount'] ?? 0,
            'total_price' => 0,
        ]);

        // Create order details
        if (isset($data['orderDetails'])) {
            foreach ($data['orderDetails'] as $detail) {
                $arrangement = FlowerArrangement::find($detail['arrangement_id']);
                $unit_price = $arrangement->price;
                $sub_total = $unit_price * $detail['quantity'];

                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'arrangement_id' => $detail['arrangement_id'],
                    'quantity' => $detail['quantity'],
                    'unit_price' => $unit_price,
                    'sub_total' => $sub_total,
                ]);
            }
        }

        // Calculate total price
        $order->calculateTotalPrice();

        // Create payments and update total_payment
        if (isset($data['payments'])) {
            foreach ($data['payments'] as $payment) {
                $paymentRecord = $order->payments()->create($payment);
                $paymentRecord->total_payment = $order->total_price;
                $paymentRecord->save();
            }
        }

        // Create deliveries
        if (isset($data['deliveries'])) {
            foreach ($data['deliveries'] as $delivery) {
                $order->deliveries()->create($delivery);
            }
        }

        Log::info("Order created: ", $order->toArray());

        return response()->json(['data' => $order->toArray()]);
    }
}
