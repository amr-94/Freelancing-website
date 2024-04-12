@extends('layout')
@section('content')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @foreach ($listings as $listing)
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <img class="hidden w-48 mr-6 md:block" src="{{ asset("images/listings/$listing->logo") }}"
                        alt="" />
                    <div>
                        <h3 class="text-2xl">
                            <a href="{{ route('listings.show', $listing->id) }}">{{ $listing->title }}</a>
                        </h3>
                        <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                        @if ($listing->user)
                            <div class="text-xl font-bold mb-4"><a
                                    href="{{ route('user_profile.index', $listing->user->id) }}"> jop user /
                                    {{ $listing->user->name }}</a></div>
                        @endif

                        @php
                            $tags = explode(',', $listing->tags);
                        @endphp
                        <ul class="flex">
                            @foreach ($tags as $tag)
                                <li
                                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                    <a href="#">{{ $tag }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="text-lg mt-4">
                            <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $listings->links() }}
@endsection
