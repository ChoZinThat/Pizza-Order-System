<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
//user site----------------------------------------------------------------------------------------
    //direct order history page
    public function orderList(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.orderList',compact('order'));
    }


//admin site----------------------------------------------------------------------------------------
    //admin order list
    public function adminOrderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->get();

        return view('admin.order.orderList',compact('order'));
    }

    //sortStatus
    public function sortStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id');

        if($request->status == null){
            $order = $order->get();
        }
        else{
            $order = $order->where('status',$request->status)->get();
        }

        return view('admin.order.orderList',compact('order'));
    }

    //changeStatus with ajax
    public function changeStatus(Request $request){
        Order::where('id',$request->order_id)->update(['status' => $request->status]);
    }

    //order info
    public function orderInfo($order_code){
        $total = Order::where('order_code',$order_code)->first();

        $orderInfo = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','users.name as user_name')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('users','order_lists.user_id','users.id')
                    ->where('order_code',$order_code)
                    ->get();



        return view('admin.order.orderInfo',compact('orderInfo','total'));
    }
}
