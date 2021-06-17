<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Get all product
     */

    public function allProducts()
    {

        $all_products = Product::latest()->get();

        $api_data = [
            'status' => true,
            'message' => 'Get all Products',
            'Products' => $all_products

        ];

        return response()->json($api_data);
    }




    /**
     * Single Product View
     */

    public function singleProduct($id)
    {
        $single_product = Product::find($id);

        if ($single_product == null) {
            $status = false;
            $message = 'Product Not found';
        } else {
            $status = false;
            $message = 'Product is OK';
        }


        $api_data = [
            'status' => $status,
            'message' => $message,
            'Product' => $single_product

        ];



        return response()->json($api_data);
    }

    /**
     * Single Product Route Messsage
     */

    public function singleProductMsg()
    {

        $api_data = [
            'status' => false,
            'message' => 'Please add product Id, Example: http://localhost:8000/api/product/1',


        ];

        return response()->json($api_data);
    }



    /**
     * Delete Product
     */

    public function deleteProduct($id)
    {
        $single_product = Product::find($id);

        if ($single_product == null) {
            $status = false;
            $message = 'Product Not found';
        } else {
            $single_product->delete();
            $status = false;
            $message = 'Product Deleted Successfully';
        }


        $api_data = [
            'status' => $status,
            'message' => $message,


        ];



        return response()->json($api_data);
    }



    /**
     * Create Product
     */

    public function createProduct(Request $request)
    {



        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $file_name = md5(time() . rand()) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('media/products/'), $file_name);
        } else {
            $file_name = null;
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'model' => $request->model,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'file' => $file_name,


        ]);


        $api_data = [
            'status' => true,
            'Message' => 'Product added Successfully',
        ];
        return response()->json($api_data, 200);
    }


    /**
     * Update Product
     */

    public function updateProduct(Request $request)
    {

        $update_product = Product::find($request->id);


        $update_product->name = $request->name;
        $update_product->model = $request->model;
        $update_product->description = $request->description;
        $update_product->price = $request->price;
        $update_product->color = $request->color;
        $update_product->size = $request->size;
        $update_product->status = $request->status;


        $update = $update_product->update();


        if ($update) {
            $status = true;
            $message = 'Product Update Successfully';
        } else {
            $status = false;
            $message = 'Product Update Failed';
        }


        $api_data = [
            'status' => $status,
            'Message' => $message,
        ];

        return response()->json($api_data, 200);
    }


    /**
     * Search Product
     */

    public function searchProduct($name)
    {

        $search_product = Product::where("name", "like", "%" . $name . "%")->get();



        $api_data = [
            'status' => true,
            'Message' => 'Search Product',
            'Search Product' =>  $search_product
        ];


        return response()->json($api_data);
    }
}