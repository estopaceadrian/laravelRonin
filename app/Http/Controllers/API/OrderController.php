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
}
