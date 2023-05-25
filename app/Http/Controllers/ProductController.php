<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required',
            'name' => 'required|string',
            'material' => 'required|string',
            'price' => 'required|numeric|between:0,9999999999.99'
        ]);
        $product =  Product::create($request->all());
        $response = [
            'message' => 'product is created successfully!',
            'product' => $product
        ];
        return response($response, 201);
    }

    public function getLabProducts($lab_id) {
        return Product::where('lab_id', $lab_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return [
            'message' => 'product updated successfully',
            'product' => $product
        ];
    }

    public function search($name) {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::destroy($id)) {
            return [
                'message' => 'offer is deleted successfully!'
            ];
        }
        else {
            return [
                'message' => 'something went wrong!'
            ];
        }
    }
}
