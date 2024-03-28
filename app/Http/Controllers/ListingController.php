<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ListingController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = "%$request->search%";
        $listings = Listing::whereAny(['title', 'tags', 'company'], 'like', $search)->get();
        // $tagsString  = $listings->tags;
        // dd($tagsString);

        // $tagsArray = explode(",", $tagsString);

        if (Auth::user() == null) {


            return view('listing', compact('listings'));
        } else {
            return view('index', compact('listings'));
        }
    }

    public function create()
    {
        return view('createliting');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);
        if ($request->has('image')) {
            $filename = time() . "." . $request->image->extension();
            $request->logo->move(public_path("images"), $filename);
            $request->merge([
                'logo' => $filename
            ]);
        }
        Listing::create($request->all());
        return redirect()->route('listings.index');
    }


    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        $tagsString  = $listing->tags;
        $tagsArray = explode(",", $tagsString);
        return view('showlisting', compact('listing', 'tagsArray'));
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
        return redirect(route('listings.show', $id));
    }

    public function destroy($id)
    {
        $listing = listing::findorfail($id);
        $listing->destroy($id);
        return redirect(route('listings.index'));
    }
}