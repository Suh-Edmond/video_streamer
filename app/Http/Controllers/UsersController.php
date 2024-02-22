<?php

namespace App\Http\Controllers;

use App\Constant\UserStatus;
use App\Models\User;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function manageUsers()
    {

        $users = User::paginate(10);

        $data = [
            'items' => $users,
            'filter' => false,
            'gridView'=> false,
            'admin'   => HelperTrait::getAdminInfo()
        ];
        return view('dashboard.users')->with('data',$data);
    }

    public function blockUser(User $user)
    {
        try {
            $user->status = UserStatus::IN_ACTIVE;
            $user->save();

            $notification = array(
                'message' => 'Account blocked successfully',
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => 'An error occurred! Could not block user account',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function unBlockUser(User $user)
    {
        try {
            $user->status = UserStatus::ACTIVE;
            $user->save();
            $notification = array(
                'message' => 'Account unblocked successfully',
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => 'An error occurred! Could not unblock user account',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            $notification = array(
                'message' => 'Account deleted successfully',
                'alert-type' => 'success'
            );
        }catch (\Exception $e){
            if($e->getCode() == 23000){
                $notification = array(
                    'message' => 'Cannot delete user account. This account has files',
                    'alert-type' => 'error'
                );
            }else{
                $notification = array(
                    'message' => 'An error occurred! Could not delete user account',
                    'alert-type' => 'error'
                );
            }
        }

        return redirect()->back()->with($notification);
    }
}
