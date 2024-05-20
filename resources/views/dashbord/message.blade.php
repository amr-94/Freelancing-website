@extends('dashbord.layout')
@section('content')
    {{-- message to you --}}
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Manage messages RECEIVED to you
                </h1>
            </header>

            <table class="w-full  table-auto rounded-sm">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>title</td>
                        <td>body</td>
                        <td>From</td>
                        <td>to</td>
                        <td>created at </td>
                        <td>options</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a>
                                    {{ $message->id }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('message.show', $message->id) }}">
                                    {{ $message->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->body }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->from_user->name }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->to_user->name }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->created_at }}
                                </p>
                            </td>
                            @auth
                                @if ($message->to_user->id == Auth::user()->id)
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <form action="{{ route('message.destroy', $message->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endif

                            @endauth

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    {{-- {{ $messages->links() }} --}}


    {{-- message from you --}}
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Manage messages send from you
                </h1>
            </header>

            <table class="w-full  table-auto rounded-sm">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>title</td>
                        <td>body</td>
                        <td>From</td>
                        <td>to</td>
                        <td>created at </td>
                        <td>options</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tomessages as $message)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->id }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('message.show', $message->id) }}">
                                    {{ $message->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->body }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->from_user->name }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->to_user->name }}
                                </p>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p>
                                    {{ $message->created_at }}
                                </p>
                            </td>
                            @auth
                                @if ($message->from_user_id == Auth::user()->id)
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <form action="{{ route('message.destroy', $message->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endif

                            @endauth

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $tomessages->links() }} --}}

    {{-- notifications --}}
    <div class="row mb-3">
        <h1 style="text-align: center;color: red"> Unread Notifications </h1>
        <div>
            @foreach (Auth::user()->unreadnotifications as $notification)
                <div class="card my-2">
                    <div class="card-body">
                        @if ($notification->unread())
                            <a href="{{ route('notify.read', $notification->id) }}"
                                style="text-decoration: none;color: red">
                        @endif
                        <h4>{{ $notification->data['message']['title'] }}</h4> </a>
                        <p> {{ $notification->data['message']['body'] }}</p>
                        <p> from user: {{ $notification->data['sender'] }}</p>
                        <p class="text-muted">{{ $notification->created_at->diffForhumans() }}</p>

                    </div>
                    {{-- <form action="{{ route('notification.destroy', $notifications->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete Notification</button>
                    </form> --}}
                </div>
            @endforeach
        </div>

        {{-- @if ($notifications->count() !== 0)
            <form action="{{ route('notification.destroyall') }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-outline-primary" type="submit">Clear all Notifications</button>
            </form>
        @endif --}}
    </div>
@endsection
