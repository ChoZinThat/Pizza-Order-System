<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get data with api
    public function getData(){
        $categories = Category::get();
        $users = User::get();
        $products = Product::get();
        $orders = Order::get();

        $data = [
            'categories' => $categories,
            'users' => $users,
            'products' => $products,
            'orders' => $orders
        ];

        return response()->json($data, 200);
    }

    //create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Category::create($data);

        return response()->json($data, 200);
    }

    //create contact
    public function createContact(Request $request){
        $data = $this->prepareContactData($request);

        Contact::create($data);
        $contactData = Contact::orderBy('created_at','desc')->get();

        return response()->json($contactData, 200);
    }

    //delete category with post method
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=> 'success', 'message'=>'Category Deleted Successfully...'], 200);
        }

        return response()->json(['status'=>'fail','message'=>'There is no category for that id...'], 200);
    }



    //delete category with get method
    public function delete_Category($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=> 'success', 'message'=>'Category Deleted Successfully...'], 200);
        }

        return response()->json(['status'=>'fail','message'=>'There is no category for that id...'], 200);
    }


    //get category details
    public function details_category($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json($data, 200);
        }
        return response()->json(['message'=>'There is no category for that id...'], 500);
    }


    //update category
    public function updateCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            $updateData = $this->getUpdateData($request);
            Category::where('id',$request->category_id)->update($updateData);
            $categoryData = Category::where('id',$request->category_id)->first();
            return response()->json(['message'=>'update success...',$categoryData], 200);
        }

        return response()->json(['message'=>'There is no category for your id'], 200);
    }


    //for category create
    private function prepareContactData($request){
        return [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' =>Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //for category update
    private function getUpdateData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
