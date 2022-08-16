<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //
    public function getScooter (){
        $type = Product::where( 'type','scooter')->get();
        return response()->json([
            'status'=>200,
            'type'=>$type
        ]);
    }
    public function getHelmet (){
        $type = Product::where( 'type', 'helmet')->get();
        return response()->json([
            'status'=>200,
            'type'=>$type
        ]);
    }
    public function getAccessory (){
        $type = Product::where( 'type', 'accessory')->get();
        return response()->json([
            'status'=>200,
            'type'=>$type
        ]);
    }


    public function viewProduct($id)
    {
        $product =Product::find($id);
        if($product)
        {
            return response()->json([
                'status'=>200,
                'product'=>$product,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',
            ]);
        }
    }

     
}
