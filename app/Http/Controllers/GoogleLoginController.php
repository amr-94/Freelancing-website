<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();


        // Check if user already exists
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // If user doesn't exist, create a new one
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => 'amr123456',
                // Add any additional fields you want to save
            ]);
        }

        // Login the user
        Auth::login($user, true);

        // Redirect to home page or any other route after login
        return redirect()->route('/');
    }
}
