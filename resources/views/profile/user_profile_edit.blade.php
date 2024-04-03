@extends('layout')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <p class="text-danger">{{ $error }}</p>

                </li>
            @endforeach
        </ul>
    @endif
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Edit user
                </h2>
                <p class="mb-4">Edit: {{ $user->name }}</p>
            </header>


            <form action="{{ route('user_profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="formGroupExampleInput"
                        value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="formGroupExampleInput"
                        value="{{ $user->email }}">
                </div>
                <div class="mb-3">
                    <label for="user_img" class="form-label">Image</label>
                    <input class="form-control" type="file" name="user_img" value="{{ $user->user_image }}">
                </div>
                <div class="mb-3">
                    <label for="user_image" class="form-label">attach</label>
                    <input class="form-control" type="file" id="attachment" name="attach[]" multiple>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit </button>
                </div>


            </form>
        @endsection
