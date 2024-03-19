<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //ajax pizza list
    public function pizzaList(Request $request){

        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }

        logger($data->all());

       return $data;
    }

    //ajax pizza order store in cart
    public function pizzaOrder(Request $request){
        $orderData = $this->getOrderData($request);

        Cart::create($orderData);

        $response = [
            'status' => 'success',
            'message' => 'Add to Cart Complete'
        ];

        return response()->json($response, 200);
    }

    //ajax order store in order list
    public function order(Request $request){
        //create data in order_list
        $total = 0;
        foreach($request->all() as $item){
           $data = OrderList::create($item);
           $total += $data->total;
        }

        //delete data from cart
        Cart::where('user_id',Auth::user()->id)->delete();

        //create data in order
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000,
        ]);

        return response()->json(['status' => 'true', 'message'=>'order complete'],200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear cart item
    public function clearCartItem(Request $request){
        Cart::where('id',$request->orderId)
              ->where('product_id',$request->productId)
              ->where('user_id',Auth::user()->id)
              ->delete();
    }

    //increase view count
    public function viewCount(Request $request){
        $pizza = Product::where('id',$request->product_id)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id',$request->product_id)->update($viewCount);
    }

    //get user Data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

}
