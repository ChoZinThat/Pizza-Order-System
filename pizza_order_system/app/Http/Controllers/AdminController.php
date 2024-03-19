<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
        //admin password changer page
        public function changePasswordPage(){
            return view('admin.account.changePassword');
        }

        //admin password change
        public function changePassword(Request $request){

            $this->passwordValidationCheck($request);

            // $user = User::select('password')->where('id',Auth::user()->id)->first();       //to get password
            // $dbHashValue = $user->password;                                                //to change array type into variable


            // if(Hash::check($request->oldPassword, $dbHashValue)){
            //     $data = ['password' => Hash::make($request->newPassowrd)];

            //     User::where('id',Auth::user()->id)->update($data);
            //     Auth::logout();
            //     return redirect()->route('auth#loginPage');
            // }
            // return back()->with(['notMatch' => 'Old Password is not match. Try Again!']);

            $user = User::find(Auth::user()->id);

            if (!Hash::check($request->oldPassword, $user->password)) {
                return redirect()->route('admin#changePasswordPage')
                ->with(['notMatch' => 'Old Password is not match. Try Again!']);
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();

            return redirect()->route('admin#changePasswordPage')
                ->with(['success'=> 'Your password has been changed successfully.']);

        }

        //admin direct details page
        public function detail_account(){
            return view('admin.account.detail');
        }

        //admin direct edit page
        public function edit(){
            return view('admin.account.edit');
        }

        //admin update
        public function update($id, Request $request){
             $this->accountValidationCheck($request);
           $data = $this->getUserData($request);

           //for image
           if($request->hasFile('image')){
                $dbImage = User::where('id',$id)->first();
                $dbImage = $dbImage->image;

                if($dbImage != null){
                    Storage::delete('public/'.$dbImage);
                }

                $fileName = uniqid(). $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);      //store file in public
                $data['image'] = $fileName;                                //store file in data base
           }

           User::where('id',$id)->update($data);

           return redirect()->route('admin#details')->with(['success' => "Admin's data updated successfully!"]);
        }

        //admin list
        public function list(){
            $admin = User::when(request('key'),function($query){
                        $query->orWhere('name','like','%'.request('key').'%')
                              ->orWhere('email','like','%'.request('key').'%')
                              ->orWhere('gender','like','%'.request('key').'%')
                              ->orWhere('address','like','%'.request('key').'%')
                              ->orWhere('phone','like','%'.request('key').'%');
                    })
                    ->where('role','admin')
                    ->paginate(3);

            $admin->appends(request()->all);
            return view('admin.account.adminList',compact('admin'));
        }

        //delete
        public function delete($id){
            User::where('id',$id)->delete();
            return back()->with(['delete'=> 'Admin deleted successfully.']);
        }

        //direct change role page
        // public function changeRolePage($id){
        //     $account = User::where('id',$id)->first();
        //     return view('admin.account.changeRole',compact('account'));
        // }

        //change admin role
        public function changeRole($id){
            $data = ['role' => 'user'];
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list')->with(['changeRole' => 'Admin-role changed successfully']);
        }

        //account validation
        private function accountValidationCheck($request){
            Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'image' => 'mimes:png,jpg,jpeg,jfif,webp|file',
                'address' => 'required',
            ])->validate();
        }

        //get user Data
        private function getUserData($request){
            return [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'updated_at' => Carbon::now(),
            ];
        }


        //password validation
        private function passwordValidationCheck($request){
            Validator::make($request->all(),[
                'oldPassword' => 'required|min:6|max:10',
                'newPassword' => 'required|min:6|max:10',
                'confirmPassword' => 'required|min:6|max:10|same:newPassword'
            ])->validate();
        }

}
