<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\LabFavourites;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lab::withAvg('ratings', 'rate')->orderByRaw('ratings_avg_rate desc')->get();
    }

    public function userLabs($id)
    {
        return Lab::where('user_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'longitude' =>'required|between:0,999.99',
            'latitude' =>'required|between:0,999.99',
            'city' => 'required|string',
            'image' => 'required',
            'phone' => 'required|string',
            'delivary_times' => 'required|string',
            'maxillofacial' => 'required',
            'digital' => 'required',
            'pay_per_month' => 'required',
            'user_id' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(32).".".$image->getClientOriginalExtension();
        }
        $created =  Lab::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'city' => $request->city,
            'image' => $imageName,
            'phone' => $request->phone,
            'delivary_times' => $request->delivary_times,
            'maxillofacial' => $request->maxillofacial,
            'digital' => $request->digital,
            'pay_per_month' => $request->pay_per_month
        ]);
        Storage::disk('public')->put($imageName, file_get_contents($request->image));
        return [
            'message' => 'A new lab is created successfully!',
            'created lab' => $created
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Lab::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lab = Lab::find($id);
        $lab->update($request->all());
        return [
            'message' => 'lab is updated successfully!',
            'updated' => $lab
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Lab::destroy($id)) {
            return [
                'message' => 'lab is deleted successfully!'
            ];
        }
        else {
            return [
                'message' => 'something went wrong!'
            ];
        }
    }

    public function search($name)
    {
        return Lab::where('name', 'like', '%'.$name.'%')->get();
    }

    public function favourite(Lab $lab) {
        $user = auth()->user();
        if($user->favourites->where('id','=', $lab->id)->count() == 0) {
            LabFavourites::create(['user_id' => $user->id, 'lab_id' => $lab->id])->save();
        }
        return [
            'user favourites' => $user->favourites,
            'message' => 'lab is added to favourites successfully!'
        ];
    }

    public function unFavourite(Lab $lab) {
        $user = auth()->user();
        LabFavourites::where('user_id', $user->id)->where('lab_id', $lab->id)->delete();
        return [
            'user favourites' => $user->favourites,
            'message' => 'lab is removed from favourites successfully!'
        ];
    }

    public function getUserFavourites() {
        $user = auth()->user();
        $userfavourites = $user->favourites;
        return [
            'user favourites' => $userfavourites
        ];
    }

    public function rateLab(Request $request, Lab $lab) {
        $user = auth()->user();
        $request->validate([
            'rate' => 'required | numeric | min:0 | max:5'
        ]);
        $old = $lab->ratings->where('user_id',$user->id);
        if ($old->count() == 0) {
            Ratings::create(['user_id' => $user->id, 'lab_id' => $lab->id, 'rate' => $request->rate])->save();
            return response()->json(['message' => 'lab is rated successfully', 'rating' => $request->rate]);
        }
        else {
            $old = $old->first();
            $old->rate = $request->rate;
            $old->save();
            return response()->json(['message' => 'lab rating is updated successfully']);
        }
    }

    public function filterByCity($city) {
        return Lab::where('city', 'like', '%'.$city.'%')->get();
    }

}
