<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'delivery_id';
    protected $fillable = ['order_id', 'customer_id','delivery_name','delivery_address', 'delivery_date', 'courier_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id', 'courier_id');
    }
}
