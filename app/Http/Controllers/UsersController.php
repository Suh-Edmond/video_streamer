<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function manageUsers()
    {

        $users = User::all();

        $data = [
            'items' => $users,
            'filter' => false,
            'gridView'=> false
        ];

        return view('dashboard.users')->with('data',$data);
    }

    public function blockUser($id)
    {
        return redirect()->route('users');
    }

    public function deleteUser($id)
    {
        $current_user = $this->getUser();

        if($current_user->id != $id)
            User::destroy($id);
        return redirect()->route('users');
    }

    private function getUser() {
        if(auth()->check()) {
            return auth()->user();
        }
    }
}
