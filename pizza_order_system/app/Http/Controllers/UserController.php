<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user list
    public function userListPage(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    //user role Change
    public function userRoleChange(Request $request){
        $updateRole = [
            'role' => $request->role
        ];
        User::where('id',$request->user_id)->update($updateRole);
    }

    //user account delete
    public function userAccountDelete($id){

        User::where('id',$id)->delete();

        return back()->with(['delete'=> 'User Account deleted successfully.']);
    }
}
