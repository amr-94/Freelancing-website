@extends('layout')
@section('content')
    <main>
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Register
                    </h2>
                    <p class="mb-4">Create an account to post gigs</p>
                </header>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="inline-block text-lg mb-2">
                            Name
                        </label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" />
                    </div>

                    <div class="mb-6">
                        <label for="email" class="inline-block text-lg mb-2">Email</label>
                        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" />
                        <!-- Error Example -->

                    </div>

                    <div class="mb-6">
                        <label for="password" class="inline-block text-lg mb-2">
                            Password
                        </label>
                        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                    </div>

                    <div class="mb-6">
                        <label for="password2" class="inline-block text-lg mb-2">
                            Confirm Password
                        </label>
                        <input type="password" class="border border-gray-200 rounded p-2 w-full"
                            name="password_confirmation" />
                    </div>

                    <div class="mb-6">
                        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                            Sign Up
                        </button>
                    </div>

                    <div class="mt-8">
                        <p>
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-laravel">Login</a>
                        </p>
                    </div>
                    <div class="block mt-4">
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('auth.redirect', 'google') }}">
                                <img
                                    src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
