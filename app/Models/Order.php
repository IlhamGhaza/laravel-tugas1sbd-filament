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

    protected $fillable = ['order_number', 'order_date', 'total_price', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(Order::class);
    }
    //payment

    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'order_id');
    }
        protected static function booted()
    {
        static::saving(function ($order) {
            $customer = $order->customer;

            if ($customer->status === 'regular') {
                // Apply 10% discount for regular customers
                $order->discount = $order->total_price * 0.10;
            } elseif ($customer->status === 'non-regular' && $order->total_price >= 1000000) {
                // Apply 5% discount for non-regular customers with high order value
                $order->discount = $order->total_price * 0.05;
            } else {
                // No discount for non-regular customers below the threshold
                $order->discount = 0;
            }
        });
    }

}
