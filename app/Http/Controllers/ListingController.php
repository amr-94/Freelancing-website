<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RakibDevs\Weather\Weather;

class ListingController extends Controller
{




    public function index(Request $request)
    {
        $search = "%$request->search%";
        $listings = Listing::whereAny(['title', 'tags', 'company'], 'like', $search)->latest()->paginate(4);
        // $tagsString  = $listings->tags;
        // dd($tagsString);

        // $tagsArray = explode(",", $tagsString);

        // if (Auth::user() == null) {


        return view('listing', compact('listings'));
        // } else {
        // return view('index', compact('listings'));
        // }
    }

    public function create()
    {
        return view('createliting');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'company' => ['required', 'string', 'unique:listings,company'],
            'email' => ['required', 'email'],
            'website' => ['required']

        ]);
        if ($request->has('image')) {
            $filename = time() . "." . $request->image->extension();
            $request->logo->move(public_path("images"), $filename);
            $request->merge([
                'user_id' => Auth::user()->id,
                'logo' => $filename
            ]);
        }
        Listing::create($request->all());
        return redirect()->route('listings.index');
    }


    public function show($id)
    {
        $wt = new Weather();

        $info = $wt->getCurrentByCity('cairo');
        $weather = $info->weather;



        $listing = Listing::findOrFail($id);
        $tagsString  = $listing->tags;
        $tagsArray = explode(",", $tagsString);
        return view('showlisting', [
            'listing' => $listing,
            'tagsArray' => $tagsArray,
            'weather' => $weather[0]->description,
            'temp' => $info->main->temp,
            'wind' => $info->wind->speed,


        ]);
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view("editlisting", compact("listing"));
    }

    public function update(Request $request, $id)
    {

        $listing = Listing::findorfail($id);
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path("/images/listings"), $filename);
            $request->merge([
                'logo' => $filename
            ]);
        }
        if ($listing->logo !== null && $request->image !== null) {
            File::delete(public_path("/images/listings/") . $listing->logo);
        }
        $listing->update($request->all());
        return redirect(route('listings.show', $id))->with('success', 'jop has been updated');
    }

    public function destroy($id)
    {
        $listing = listing::findorfail($id);
        $listing->destroy($id);
        return redirect(route('listings.index'));
    }
}
