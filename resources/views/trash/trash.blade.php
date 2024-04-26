@extends('layout')
@section('content')
    @if ($listings)
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                <header>
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                        listings Trash
                    </h1>
                </header>

                <table class="w-full  table-auto rounded-sm">
                    <thead>
                        <tr>
                            <td>title</td>
                            <td>user</td>
                            <td>created at</td>
                            <td>deleted at</td>
                            <td>opretions</td>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $user = Auth::user();
                        @endphp
                        @foreach ($listings as $listing)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="{{ route('listings.show', $listing->id) }}">
                                        {{ $listing->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="">
                                        {{ $listing->user->name }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="">
                                        {{ $listing->created_at->diffForHumans() }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="">
                                        {{ $listing->updated_at->diffForHumans() }}
                                    </a>
                                </td>
                                @auth
                                    <form action="{{ route('listing.restore', $listing->title) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                            <button type="submit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                restore</button>
                                        </td>
                                    </form>
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <form action="{{ route('listing.force_delete', $listing->title) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Force Delete
                                            </button>
                                        </form>
                                    </td>
                                @endauth

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
