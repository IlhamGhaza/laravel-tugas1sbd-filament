<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowerArrangement extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'arrangement_id';
    protected $fillable = ['name', 'type', 'description','image', 'size', 'price'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'arrangement_id', 'arrangement_id');
    }
}
