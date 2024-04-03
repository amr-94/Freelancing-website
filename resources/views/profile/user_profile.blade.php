@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card h-50">

                @if ($user->user_image)
                    <img src="{{ asset("images/users/$user->user_image") }}" class="img-fluid" width="10%" hight= "30%">
                @else
                    <img src="{{ asset('profile_photo/') }}" width="100%" />
                @endif
                <div class="d-flex justify-content-between">

                    <p><b> User Name :</b>{{ $user->name }}</p>
                    <p><b>Email :</b>{{ $user->email }}</p>
                    <p><b>type:</b>{{ $user->type }}</p>
                    @if (count($attachments) > 0)
                        @foreach ($attachments as $attachment)
                            <li>Attachment : <a href="{{ asset("images/users/attach/$attachment") }}">{{ $attachment }}
                                </a></li>
                        @endforeach
                    @else
                        <p>No attachments uploaded.</p>
                    @endif
                </div>

                @if ($user == Auth::user())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('user_profile.edit', $user->id) }}" class="btn btn-outline-dark">Edit
                                </a>
                            </div>
                            <form method="post" action="{{ route('logout') }}" class="delete-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"> logout </button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>

        </div>


        @foreach ($user->listings as $post)
            <div class="col-12 col-sm-4 mb-3 mt-3">
                <div class="card h-100">
                    <img src="{{ asset("images/listings/$post->logo") }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="{{ route('listings.show', $post->id) }}" class="card-text">{{ $post->title }}</a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted">Created at : {{ $post->created_at->diffforhumans() }}</small>
                        <small class="text-muted">Last updated : {{ $post->updated_at->diffforhumans() }}</small>
                    </div>
                    @if ($post->user == Auth::user())
                        <div class="d-flex justify-content-between ">
                            <button type="submit" class="btn btn-success">
                                <a href="{{ route('listings.edit', $post->id) }}"
                                    style="color: white;text-decoration: none;">Edit
                                </a></button>
                            <form action="{{ route('listings.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">Delete </button>
                            </form>
                        </div>
                    @endif

                </div>

            </div>
        @endforeach
        @if ($user->id !== Auth::user()->id)
            <div class="card mb-4">
                <div class="card-body">
                    <p style="text-align: center">message to {{ $user->name }}</p>

                    <form action="{{ route('message.store') }}" method="post" class="form sendmessage">
                        @csrf
                        <input type="text" hidden class="form-control" id="exampleFormControlInput1" placeholder="title"
                            name="to_user_id" value="{{ $user->id }}">
                        <input type="text" hidden class="form-control" id="exampleFormControlInput1" placeholder="title"
                            name="from_user_id" value="{{ Auth::user()->id }}">

                        <div class="mb-3">
                            <label for="title" class="form-label"> Title of message</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="title"
                                name="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label"> Content of message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
                            @error('body')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">send</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
