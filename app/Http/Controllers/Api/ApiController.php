<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    //create api
    public function createProduct(Request $request)
    { 
        //validation
      $request->validate([
          "productname" => "required",
          "stock" => "required",
          "price" => "required"
      ]);


      //create data
      $product = new Product();
      $product->productname = $request->productname;
      $product->stock = $request->stock;
      $product->price = $request->price;
      $product->save();

      //send response
      return response()->json([
          "status" => 1,
          "message" => "Product created successfully"
      ]);
    }
    //list api
    public function listProducts()
    {
       $products = Product::get();
    //    print_r($products);
       return response()->json([
           "status" => 1,
           "message" => "Listing product",
           "data" => $products
       ], 200);
    }
    //single details api
    public function getSingleProduct($id)
    {
        if( Product::where("id", $id)->exists() ){
            $product_details = Product::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Product found",
                "data" => $product_details
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Product not found"
            ], 404);
        }

    }
    //update api
    public function updateProduct(Request $request, $id)
    {
        if( Product::where("id", $id)->exists() ){
            $product = Product::find($id);

            $product->productname = !empty($request->productname)? $request->productname : $product->productname;
            $product->stock = !empty($request->stock) ? $request->stock : $product->stock;
            $product->price = !empty($request->price)? $request->price : $product->price; 
            $product->save();

            return response()->json([
                "status" => 1,
                "message" => "Product updated successfully",
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Product not found"
            ], 404);
        }
    }
    // delete api
    public function deleteProduct($id)
    {
      if(Product::where("id", $id)->exists()){
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            "status" => 1,
            "message" => "product deleted successfully"
        ]);

      }else{
          return response()->json([
              "status" => 0,
              "message" => "not found"
          ], 404);
      }
    }
}
