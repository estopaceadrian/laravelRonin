<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //

    public function orders()
    {
        $orders = Order::all();
        return response()->json([
            'status'=>200,
            'orders'=>$orders,
        ]);
    }

    public function vieworder($order_id)
    {
        if(Order::where('id',$order_id)->exists())
        {
            $orders =Order::find($order_id);
            return response()->json([
                'status'=>200,
                'orders'=>$orders,
            ]);
        }
        else
        {
            return redirect()->back()->with('status','no order found');
        }
    }
}
