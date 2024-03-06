<?php

namespace App\Http\Controllers;

use App\Constant\UserStatus;
use App\Models\User;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function manageUsers(Request $request)
    {
        $users = null;
        $sort = $request['sort'];
        $filter = $request['filter'];
        if(isset($sort)) {
            $users = match ($sort) {
                'DATE_ASC' => User::orderBy('created_at'),
                'NAME' => User::orderBy('name'),
                default => User::orderByDesc('created_at'),
            };

            $users = $users->paginate(10);
        }

        if (isset($filter)) {
            $users= User::where('status', $filter)->paginate(10);
        }
        if(!isset($sort) && !isset($filter)){
            $users = User::paginate(10);
        }
        $data = [
            'items' => $users,
            'filter' => true,
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
                'message' => __('messages.accountBlockSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => __('messages.accountBlockFailMsg'),
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
                'message' => __('messages.accountUnBlockSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => __('messages.accountUnBlockFailMsg'),
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
                'message' => __('messages.accountDeleteSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $e){
            if($e->getCode() == 23000){
                $notification = array(
                    'message' => __('messages.accountDeleteFailMsg'),
                    'alert-type' => 'error'
                );
            }else{
                $notification = array(
                    'message' => __('messages.accountDeleteErrorMsg'),
                    'alert-type' => 'error'
                );
            }
        }

        return redirect()->back()->with($notification);
    }
}
