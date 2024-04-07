@extends('layout')
@section('content')
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Manage users
                </h1>
            </header>

            <table class="w-full  table-auto rounded-sm">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>email</td>
                        <td>type</td>
                        <td>created at</td>
                        <td>updated at</td>
                        <td>last activity</td>
                        <td>opretions</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">

                                {{ $user->id }}

                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('user_profile.index', $user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="">
                                    {{ $user->type }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="">
                                    {{ $user->created_at->diffForHumans() }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="">
                                    {{ $user->updated_at->diffForHumans() }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="">
                                    {{ $user->last_activity }}
                                </a>
                            </td>
                            @auth

                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="{{ route('delete.admin.allusers', $user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-600">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">

                                    <form action="{{ route('make.admin.allusers', $user->id) }}" method="post">
                                        @csrf
                                        <select name="type" id="">
                                            {{-- <option value="">select type</option> --}}
                                            <option value="admin" @if ($user->type == 'admin') selected @endif>make Admin
                                            </option>
                                            <option value="user" @if ($user->type == 'user') selected @endif>make just
                                                user</option>
                                        </select>
                                        <button class="text-red-600">
                                            <i class="text-blue-400 px-6 py-2 rounded-xl"></i>
                                            submet
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
