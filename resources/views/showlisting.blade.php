@extends('layout')
@section('content')
    <a href="{{ url()->previous() }}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>
        Back
    </a>

    @component('components.flash')
    @endcomponent
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            {{-- <p> weather : {{ $weather }}</p>
            <p> temp : {{ $temp }}</p>
            <p>wind : {{ $wind }}</p> --}}

            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{ asset("images/listings/$listing->logo") }}" alt="" />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                @if ($listing->user)
                    <a href="{{ route('user_profile.index', $listing->user->id) }}" class="text-2xl mb-2"> user :
                        {{ $listing->user->name }}</a>
                @endif
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                <ul class="flex">
                    @foreach ($tagsArray as $tags)
                        <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
                            <a href="#">{{ $tags }}</a>

                        </li>
                    @endforeach


                </ul>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $listing->des }}
                        </p>


                        <a href="mailto:{{ $listing->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $listing->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                        @auth
                            @if ($listing->user == Auth::user())
                                <a href="{{ route('listings.edit', $listing->id) }}"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                        class="fa-solid fa-globe"></i> Edit this jop</a>

                                <form action="{{ route('listings.destroy', $listing->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="block bg-black text-white mt-6 py-2 rounded-xl hover:opacity-80">
                                        Delete this</button>
                                </form>
                            @endif

                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  message to listing user --}}
    @auth

        @if ($listing->user->id !== Auth::user()->id)
        @endauth

        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            send message
                        </h2>
                        <p class="mb-4">send message</p>
                    </header>
                    <form action="{{ route('message.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="to_user_id" value="{{ $listing->user->id }}">
                        <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                                placeholder="Example: Senior Laravel Developer" />
                            @error('title')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="description" class="inline-block text-lg mb-2">
                                message Description
                            </label>
                            <textarea class="border border-gray-200 rounded p-2 w-full" name="body" rows="10"
                                placeholder="Include tasks, requirements, salary, etc"></textarea>
                        </div>

                        <div class="mb-6">
                            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                                Send message
                            </button>
                            <a href="" class="text-black ml-4"> Back </a>
                        </div>
                    </form>
                @else
                    @guest

                        <div style="text-align: center ; color:black">
                            <a href="{{ route('login') }}" style=" color:red"> login </a>to send message Or<a
                                href="{{ route('register') }}" style=" color:red">
                                Register</a>
                        </div>
                    @endguest
    @endif
@endsection
