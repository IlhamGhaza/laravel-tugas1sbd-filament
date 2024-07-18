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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
    }
    protected static function booted()
    {
        static::saving(function ($order) {
            $customer = $order->customer;

            if ($customer->status === 'regular') {
                // Apply 10% discount for regular customers
                $order->discount = round($order->total_price * 0.10, 2);
            } elseif ($customer->status === 'non-regular' && $order->total_price >= 1000000) {
                // Apply 5% discount for non-regular customers with high order value
                $order->discount = round($order->total_price * 0.05, 2);
            } else {
                // No discount for non-regular customers below the threshold
                $order->discount = 0;
            }
        });
    }
}
