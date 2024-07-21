<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'phone', 'status'];
     public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'customer_id');
    }
}
