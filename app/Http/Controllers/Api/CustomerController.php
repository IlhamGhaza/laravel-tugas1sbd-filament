<?php
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Orion\Http\Controllers\Controller;

class CustomerController extends Controller
{
    protected $model = Customer::class;
    // public function showWithOrderDetails($id)
    // {
    //     $flowerArrangement = FlowerArrangement::with('orderDetails')->findOrFail($id);

    //     return response()->json($flowerArrangement);
    // }
}
