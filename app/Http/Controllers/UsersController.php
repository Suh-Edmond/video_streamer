<?php

namespace App\Http\Controllers;

use App\Constant\UserStatus;
use App\Models\User;
use Illuminate\Support\Facades\Session;

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
        Session::put('success', 'User account has been blocked successfully');
        return redirect()->back();
    }

    public function unBlockUser($id)
    {
        User::findOrFail($id)->update([
            'status' => UserStatus::ACTIVE
        ]);
        Session::put('success', 'User account has been blocked successfully');
        return redirect()->route('users');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        Session::put('success', 'User account has been deleted successfully');
        return redirect()->route('users');
    }
}
