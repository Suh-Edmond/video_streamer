<?php

namespace App\Http\Controllers;

use App\Constant\UserStatus;
use App\Models\User;

class UsersController extends Controller
{
    public function manageUsers()
    {

        $users = User::paginate(10);

        $data = [
            'items' => $users,
            'filter' => false,
            'gridView'=> false
        ];

        return view('dashboard.users')->with('data',$data);
    }

    public function blockUser($id)
    {
        User::findOrFail($id)->update([
            'status' => UserStatus::IN_ACTIVE
        ]);
        return redirect()->back();
    }

    public function unBlockUser($id)
    {
        User::findOrFail($id)->update([
            'status' => UserStatus::ACTIVE
        ]);
        return redirect()->route('users');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users');
    }

    private function getUser() {
        if(auth()->check()) {
            return auth()->user();
        }
    }
}
