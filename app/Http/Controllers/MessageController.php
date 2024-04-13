<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();


        $messages = Message::where('to_user_id', Auth::user()->id)->latest()->get();
        $tomessages = Message::where('from_user_id', Auth::user()->id)->latest()->get();

        return view("message", [
            'messages' => $messages,
            'tomessages' => $tomessages,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());
        $sendto = user::find($request->to_user_id);
        $sendto->notify(new MessageNotification($message));

        return redirect(route('message.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = message::find($id);
        $message->delete();
        return redirect(route('message.index'));
    }


    public function notify($id)
    {
        $user = Auth::user();
        $user->notifications->where('id', $id)->first()->markAsread();
        return redirect(route('message.index'));
    }
}
