<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return response()->json([
            'status'=>200,
            'products'=>$products,

        ]);
    }






    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image'=>'required|image|mimes:jpeg,png,jpg|max:5000000',
            'productname'=>'required|max:191',
            'description'=>'required|max:191',
            'stock'=>'required|max:191',
            'selling'=>'required|max:191',
            'original'=>'required|max:191',
            'type'=>'required|max:191',
            'status'=>'required|max:191',
            'title'=>'required|max:191',
            'keyword'=>'required|max:191',
            'mdescription'=>'required|max:191',
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
            $product = new Product;
            $product->productname  = $request->input('productname');
            $product->description  = $request->input('description');
            $product->stock  = $request->input('stock');
            $product->selling  = $request->input('selling');
            $product->original  = $request->input('original');
            $product->type  = $request->input('type');
            $product->status  = $request->input('status');

            if($request->hasFile('image'))
            {
                $file=$request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/product/', $filename);
                $product->image ='uploads/product/'.$filename;
            }

            $product->title  = $request->input('title');
            $product->keyword  = $request->input('keyword');
            $product->mdescription  = $request->input('productname');
            $product->save();
            
            return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully',
            ]);
        }
    }


    public function edit($id)
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            
            'productname'=>'required|max:191',
            'description'=>'required|max:191',
            'stock'=>'required|max:191',
            'selling'=>'required|max:191',
            'original'=>'required|max:191',
            'type'=>'required|max:191',
            'status'=>'required|max:191',
            'title'=>'required|max:191',
            'mdescription'=>'required|max:191',
            'mdescription'=>'required|max:191',
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
            $product =  Product::find($id);
            if($product)
            {
                $product->productname  = $request->input('productname');
                $product->description  = $request->input('description');
                $product->stock  = $request->input('stock');
                $product->selling  = $request->input('selling');
                $product->original  = $request->input('original');
                $product->type  = $request->input('type');
                $product->status  = $request->input('status');
    
                if($request->hasFile('image'))
                {
                    $path =$product->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $file=$request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/product/', $filename);
                    $product->image ='uploads/product/'.$filename;
                }
    
                $product->title  = $request->input('title');
                $product->keyword  = $request->input('keyword');
                $product->mdescription  = $request->input('productname');
                $product->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Product Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Product Not Found',
                ]);
            }
           
        }
    }
}
