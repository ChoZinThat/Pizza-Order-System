<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //direc product list page
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
                    ->when(request('key'),function($query){
                    $query->where('products.name','like','%'.request('key').'%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.id','desc')
                    ->paginate(3);

        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //product create
    public function create(Request $request){

        $this->productValidationCheck($request,"create");
        $data = $this->requestProductData($request);

        $filename = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$filename);
        $data['image'] = $filename;


        Product::create($data);

        return redirect()->route('products#list');
    }

    //delete pizza
    public function delete($id){
        $deletePizza = Product::where('id',$id)->first();
        $deletePizza = $deletePizza->name;

        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess'=> $deletePizza.' deleted successfully.']);
    }

    //edit pizza
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //direct update page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::all();
        return view('admin.product.update',compact('pizza','category'));
    }

    //update page
    public function update( Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductData($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            Storage::delete('public/'.$oldImageName);


            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();

            $request->file('pizzaImage')->storeAs('public/'.$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);

        return redirect()->route('products#list')->with(['updateSuccess' => 'Pizza Updated Successfully']);
    }

    //validate pizza data
    private function productValidationCheck($request, $stauts){
        $validationRule = [
            "pizzaName" => "required|min:5|unique:products,name,".$request->pizzaId,
            "pizzaCategory" => "required",
            "pizzaDescription" => "required|min:10",
            "pizzaWaitingTime" => "required",
            "pizzaPrice" => "required",
        ];

        $validationRule['pizzaImage'] = $stauts == "create" ? "required|mimes:jpg,jpeg,png,webp|file" : "mimes:jpg,jpeg,png,webp|file";

        Validator::make($request->all(),$validationRule)->validate();
    }

    //request product data
    private function requestProductData($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
            'price' => $request->pizzaPrice,
        ];

    }
}
