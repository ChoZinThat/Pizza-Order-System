<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{

    //user side----------------------------------------------------
    //contact page
    public function contactPage(){
        return view('user.main.contact');
    }

    public function contactSent(Request $request){

        Validator::make($request->all(),[
            'subject' => 'required',
            'message' => 'required|min:3'
        ])->validate();

        $data = User::where('id',$request->id)->first();

        $input = [
            'user_id' => $request->id,
            'name' => $data->name,
            'email' => $data->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ];

        Contact::create($input);

        return redirect()->route('user#home');
    }



    //admin side-------------------------------------------------------------
    //contact List
    public function contactList(){

        $contact = Contact::when(request('key'),function($query){
                    $query->where('name','like','%'.request('key').'%');})
                    ->paginate(3);

        $contact->appends(request()->all());
        return view('admin.contact.list',compact('contact'));
    }

    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with(['messageDelete'=> 'User Message deleted successfully!']);
    }
}
