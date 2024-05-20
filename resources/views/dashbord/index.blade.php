@extends('dashbord.layout')
@section('content')
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Manage Gigs
                </h1>
            </header>

            <table class="w-full  table-auto rounded-sm">
                <thead>
                    <tr>
                        <td>title</td>
                        <td>user</td>
                        <td>created at</td>
                        <td>updated at</td>
                        <td>opretions</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $user = Auth::user();
                    @endphp
                    @foreach ($user->listings as $listing)
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
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="{{ route('listings.edit', $listing->id) }}"
                                        class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                                        Edit</a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="{{ route('listings.destroy', $listing->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-600">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Delete
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
@endsection
