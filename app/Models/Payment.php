<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'payment_id';
    protected $fillable = ['order_id', 'payment_date', 'total_payment', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
