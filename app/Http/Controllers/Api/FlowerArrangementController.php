<?php
namespace App\Http\Controllers\Api;

use App\Models\FlowerArrangement;
use Orion\Http\Controllers\Controller;

class FlowerArrangementController extends Controller
{
    protected $model = FlowerArrangement::class;
    public function showWithOrderDetails($id)
    {
        $flowerArrangement = FlowerArrangement::with('orderDetails')->findOrFail($id);

        return response()->json($flowerArrangement);
    }
}
