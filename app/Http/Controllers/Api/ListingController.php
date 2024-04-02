<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $listings = Listing::all();
        return response()->json($listings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $listings = Listing::create($request->all());
        return  $listings;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $listing = Listing::findOrFail($id);
        return response()->json($listing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $listing = Listing::find($id);
        if ($listing == null) {
            return response()->json(['message' => 'Listing not found']);
        }
        $listing->update($request->all());

        return $listing;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $listing = Listing::findOrFail($id);
        if ($listing == null) {
            return response()->json(['message' => 'Listing not found']);
        }
        $listing->delete();
        return $listing;
    }
}
