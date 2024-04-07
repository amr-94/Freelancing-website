<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Alluser()
    {
        $users = User::all();
        return view('profile.Allusers', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.allusers');
    }

    public function makeadmin(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'type' => $request->type,
        ]);


        return redirect()->route('admin.allusers');
    }
}