<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;



class SocialLoginController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider): RedirectResponse
    {
        $user = Socialite::driver($provider)->user();

        // dd($user);
        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            // Log in the existing user.
            auth()->login($existingUser, true);
        } else {
            // Create a new user.
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->user_image = $user->avatar;
            $newUser->password = bcrypt(request(Str::random())); // Set some random password
            $newUser->save();

            // Log in the new user.
            auth()->login($newUser, true);
        }

        return redirect()->intended('/');
    }
}