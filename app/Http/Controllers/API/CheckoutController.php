<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function placeorder(Request $request)
    {
        if (auth('sanctum')->check()) 
        {
            $validator = Validator::make($request->all(),[
                'firstname'=>'required|max:191',
                'lastname'=>'required|max:191',
                'phone'=>'required|max:191',
                'email'=>'required|max:191',
                'address'=>'required|max:191',
            ]);
            
            if($validator->fails())
            {
                return response()->json([
                    'status'=>422,
                    'errors'=>$validator->messages(),
                ]);
            }
            else
            {
                $user_id = auth('sanctum')->user()->id;
                $order = new Order; 
                $order->user_id = $user_id;
                $order->firstname = $request->firstname;
                $order->lastname = $request->lastname;
                $order->phone = $request->phone;
                $order->email = $request->email;
                $order->address = $request->address;
 
                $order->payment_mode = "COD";
                $order->tracking_no = 'RONIN'.rand(1111,9999);
                $order->save();

                $cart = Cart::where('user_id',$user_id)->get();
                
                $orderitems = [];
                foreach ($cart as $item) {
                    $orderitems[] = [
                        'product_id'=>$item->product_id,
                        'qty'=>$item->product_qty,
                        'price'=>$item->product->selling,
                        
                    ];

                    $item->product->update([ 
                        'stock'=>$item->product->stock - $item->product_qty,
                    ]);

                    $order->orderitems()->createMany($orderitems);
                    Cart::destroy($cart);
                }
                return response()->json([
                    'status'=>200,
                    'message'=> 'Order Placed Successfully',
                ]);
            }
           
             
        } else {
            return response()->json([
                'status'=> 401,
                'message'=> 'Login to Continue',
            ]);
        }
        
    }
}
