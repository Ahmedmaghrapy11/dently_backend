<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Clinic::all();
    }

    public function userCLinics($id)
    {
        return Clinic::where('user_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'longitude' =>'required|between:0,999.99',
            'latitude' =>'required|between:0,999.99',
            'phone' => 'required',
            'times' => 'required',
            'user_id' => 'required'
        ]);
        $created =  Clinic::create($request->all());
        return [
            'message' => 'clinic is created successfully!',
            'created clinic' => $created
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Clinic::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clinic = Clinic::find($id);
        $clinic->update($request->all());
        return [
            'message' => 'clinic is updated successfully!',
            'updated' => $clinic
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Clinic::destroy($id)) {
            return [
                'message' => 'clinic is deleted successfully!'
            ];
        }
        else {
            return [
                'message' => 'something went wrong!'
            ];
        }
    }
}
