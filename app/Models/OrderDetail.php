<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'detail_id';

    protected $fillable = ['order_id', 'arrangement_id', 'quantity', 'unit_price', 'sub_total'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function arrangement()
    {
        return $this->belongsTo(FlowerArrangement::class, 'arrangement_id');
    }

    protected static function booted()
    {
        static::creating(function ($orderDetail) {
            $arrangement = $orderDetail->arrangement;
            $orderDetail->unit_price = $arrangement->price;
            $orderDetail->sub_total = $orderDetail->quantity * $orderDetail->unit_price;
        });

        static::created(function ($orderDetail) {
            $orderDetail->order->calculateTotalPrice();
        });

        static::updating(function ($orderDetail) {
            $arrangement = $orderDetail->arrangement;
            $orderDetail->unit_price = $arrangement->price;
            $orderDetail->sub_total = $orderDetail->quantity * $orderDetail->unit_price;
        });

        static::updated(function ($orderDetail) {
            $orderDetail->order->calculateTotalPrice();
        });

        static::deleted(function ($orderDetail) {
            $orderDetail->order->calculateTotalPrice();
        });
    }
}

