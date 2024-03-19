<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //direct user page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();

        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','order'));
    }

    //user's category select
    public function categorySelect($id){
        $pizzas = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','order'));
    }

    //product detail direct page
    public function details($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //change password
    public function changePasswordPage(){
        return view('user.password.change');
    }

     //user password change
    public function changePassword(Request $request){

        $this->passwordValidationCheck($request);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->oldPassword, $user->password)) {
            return redirect()->route('user#passwordChangePage')
            ->with(['notMatch' => 'Old Password is not match. Try Again!']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->route('user#passwordChangePage')
            ->with(['success'=> 'Your password has been changed successfully.']);

    }

    //update profile page
    public function updateProfile(){
        return view('user.profile.update');
    }

    //update profile
    public function update($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->iamge;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
             $fileName = uniqid().$request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);

        return back()->with(['success' => 'User Data updated successfully...']);
    }


    //get user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    //account validation check
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

     //password validation
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
