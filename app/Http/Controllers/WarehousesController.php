<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    // Display Warehouses.
    public function show()
    {
        return Warehouse::all();
    } 
    // Display Mediciens by Warehouse id and Category.
    public function category(Request $request)
    {
        $fields=$request->validate([
        'id'=>'integer',
        'category'=>'string',
        ]);

        $products_by_warehouse_id_and_category=[];

        $warehouse=Warehouse::find($fields['id']);

        $productsWarehouse=ProductWarehouse::where('warehouse_id',$warehouse->id)->get();

       foreach($productsWarehouse as $productWarehouse)
        {
            if($productWarehouse->product->category == $fields['category'])
            array_push($products_by_warehouse_id_and_category,$productWarehouse);
        }
        //similar_text('sjfffbk','skkuhf',90);
        return $products_by_warehouse_id_and_category;   
    }
    // Display product details
    public function details(Request $request)
    {
         $fields=$request->validate([
            'id'=>'integer'
         ]);
         $details=ProductWarehouse::find($fields['id']);
         $product_details=$details->product;
         $product_details=$details;
         return $product_details;
    }
    // Search in warehouse's products by commercial name and category
    public function search(Request $request)
    {
        $fields=$request->validate([
            'id'=>'integer',
            'name'=>'required|string'
        ]);

        $products=[];

        $warehouse=Warehouse::find($fields['id']);

        $productsWarehouse=ProductWarehouse::where('warehouse_id',$warehouse->id)->get();

        foreach($productsWarehouse as $productWarehouse)
        {
            $productsBySearch=Product::where('commercial_name','like','%'.$fields['name'].'%')->
            orwhere('category', 'like' , '%'.$fields['name'].'%')->get();
            foreach($productsBySearch as $productBySearch)
            if($productBySearch->id == $productWarehouse->product->id)
            {
                array_push($products,$productBySearch);
            }
        }
        return $products;
    }
    public function storephoto(Request $request)
    {
        $fields=$request->validate(); 
    }
}