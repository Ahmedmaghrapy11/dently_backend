<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Lab;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
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
            'user_id' => 'required',
            'lab_id' => 'required',
            'clinic_id' => 'required',
            'case_number' => 'required|numeric|between:0,9999999999.99',
            'patient_name' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'product_type' => 'required|string',
            'payment_type' => 'required|string',
            'expected_receive_date' => 'date_format:d/m/Y|after:6/6/2023',
            'shade' => 'required|string',
            'stain' => 'required|string',
            'description' => 'required|string',
            'is_fixed' => 'required|boolean',
            'restoration_type' => 'required|numeric|min:0|max:3',
            'all_ceramics' => 'string',
            'post_and_core' => 'string',
            'on_implant' => 'string',
            'pfm' => 'string',
            'full_cast' => 'string',
            'acrylic_full_denture' => 'string',
            'acrylic_partial_denture' => 'string',
            'flexible' => 'string',
            'cast_partial_denture' => 'string',
            'immediates' => 'string',
            'teeth' => 'string',
            'miscellanceous' => 'string'
        ]);
        $order = Order::create($request->all());
        $response = [
            'message' => 'order is created successfully!',
            'order' => $order
        ];
        return response($response, 201);
    }

    // get orders of specific lab
    public function getLabOrders(Lab $lab) {
        return Order::where('lab_id', $lab->id)->get();
    }

    // get orders on specific clinic
    public function getClinicOrders(Clinic $clinic) {
        $order = Order::where('clinic_id', $clinic->id)->get();
        return $order;
    }

    // get all orders of specific user
    public function getUserOrders() {
        $user = auth()->user();
        return Order::where('user_id', $user->id)->get();
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
        $order = Order::find($id);
        $order->update($request->all());
        return [
            'message' => 'order is updated successfully!',
            'updated order' => $order
        ];
    }

    // update status of order
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update(['status' => $request->status]);
        return [
            'message' => 'order status is updated successfully!',
            'new status' => $order->status
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Order::destroy($id)) {
            return [
                'message' => 'order is deleted successfully!'
            ];
        }
        else {
            return [
                'message' => 'something went wrong!'
            ];
        }
    }
}
