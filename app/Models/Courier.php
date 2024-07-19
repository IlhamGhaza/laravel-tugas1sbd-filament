<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'courier_id';
    protected $fillable = ['name', 'phone'];

    //delivery (invers one many)
    // public function delivery()
    // {
    //     return $this->hasMany(Delivery::class, 'courier_id', 'courier_id');
    // }
}

