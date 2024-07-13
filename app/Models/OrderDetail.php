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
        return $this->belongsTo(Order::class);
    }

    public function flowerArrangement()
    {
        return $this->belongsTo(FlowerArrangement::class);
    }
}
