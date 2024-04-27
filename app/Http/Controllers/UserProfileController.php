<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Services\MarvelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class UserProfileController extends Controller
{


    /**
     * Display a listing of the resource.
     */

    public function index($id)
    {
        $dataQuran = Http::get("https://www.mp3quran.net/api/v3/radios?language=ar");
        // dd($dataQuran['radios']);


        $user = User::where('id', $id)->first();
        $attachments = json_decode($user->attachment);
        return view('profile.user_profile', [
            'user' => $user,
            'attachments' => $attachments,
            'collection' => $dataQuran["radios"]
        ]);
    }


    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return view('profile.user_profile_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();


        if ($request->hasfile('user_img')) {
            $filename = time() . '.' . $request->user_img->extension();
            $request->user_img->move(public_path("images/users"), $filename);
            $request->merge([
                'user_image' => $filename
            ]);
        }
        $attachment = [];
        if ($request->hasfile('attach')) {
            foreach ($request->attach as $attach) {
                $attachname = time() . rand(1, 100) . '.' . $attach->extension();
                $attach->move(public_path("images/users/attach"), $attachname);
                $attachment[] = $attachname;
                $request->merge([
                    'attachment' => $attachment
                ]);
            }
        }
        $fileattach = json_decode($user->attachment);
        if ($request->attach) {
            foreach ($fileattach as $attach) {
                File::delete(public_path("images/users/attach/") . $attach);
            }
        }
        if ($request->user_img) {
            File::delete(public_path("images/users/") . $user->user_image);
        }
        $user->update($request->all());
        return redirect(route('user_profile.index', $id))->with('success', 'user has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mange(Request $request)
    {
        $search = "%$request->search%";
        $listings = Listing::whereAny(['title', 'tags', 'company'], 'like', $search)->latest()->paginate(4);
        return view('index', compact('listings'));
    }
}