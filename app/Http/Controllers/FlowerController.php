<?php

namespace App\Http\Controllers;

use App\Models\FlowerArrangement;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index api
        // return FlowerArrangement::all();

        return response()->json([
            'status' => 'success',
            'data' => FlowerArrangement::all(),
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate 'name','image', 'type', 'description', 'size', 'price

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'type' => 'required',
            'description' => 'required',
            'size' => 'required',
            'price' => 'required',
        ]);

        $flowerArrangement = FlowerArrangement::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $flowerArrangement,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(FlowerArrangement $flowerArrangement)
    {
        //
        return response()->json([
            'status' => 'success',
            'data' => $flowerArrangement,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlowerArrangement $flowerArrangement)
    {
        //

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'type' => 'required',
            'description' => 'required',
            'size' => 'required',
            'price' => 'required',
        ]);
        $flowerArrangement->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $flowerArrangement,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlowerArrangement $flowerArrangement)
    {
        //
        $flowerArrangement->delete();
        return response()->json([
            'status' => 'success',
            'data' => $flowerArrangement,
        ], 200);

    }
}
