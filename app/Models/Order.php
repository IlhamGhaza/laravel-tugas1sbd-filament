<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';

    protected $fillable = ['order_number', 'customer_id', 'order_date', 'total_price', 'discount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
     public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'order_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
    }

       public function calculateTotalPrice()
    {
        $totalPrice = $this->orderDetails->sum('sub_total');

        if ($this->customer) {
            if ($this->customer->status === 'regular') {
                $this->discount = round($totalPrice * 0.1, 2);
            } elseif ($this->customer->status === 'non-regular' && $totalPrice >= 1000000) {
                $this->discount = round($totalPrice * 0.05, 2);
            } else {
                $this->discount = 0;
            }
        } else {
            $this->discount = 0;
        }

        $this->total_price = max(0, $totalPrice - $this->discount);
        $this->save();
    }
    // protected static function booted()
    // {
    //     static::saving(function ($order) {
    //         $order->load('orderDetails', 'customer'); // Ensure order details and customer are loaded

    //         $totalPrice = $order->orderDetails->sum('sub_total');

    //         info('Total Price Before Discount: ' . $totalPrice);

    //         if ($order->customer) {
    //             if ($order->customer->status === 'regular') {
    //                 $order->discount = round($totalPrice * 0.1, 2);
    //             } elseif ($order->customer->status === 'non-regular' && $totalPrice >= 1000000) {
    //                 $order->discount = round($totalPrice * 0.05, 2);
    //             } else {
    //                 $order->discount = 0;
    //             }
    //         } else {
    //             $order->discount = 0;
    //         }

    //         $order->total_price = max(0, $totalPrice - $order->discount);

    //         info("Order Calculation - Total Price: {$totalPrice}, Discount: {$order->discount}, Final Total Price: {$order->total_price}");
    //     });
    // }

}
