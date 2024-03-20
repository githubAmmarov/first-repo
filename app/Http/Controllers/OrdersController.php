<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProductWarehouse;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function closecart(Request $request)
    {
        $user=$request->user();
        $closedorder=Order::where('user_id',$user->id)->where('order_status',0)->first();
        if($closedorder){
            $closedorder->update(['order_status'=>1]);
            OrderStatus::create([
                'warehouse_id'=>$closedorder->warehouse_id,
                'user_id'=>$user->id,
                'order_id'=>$closedorder->id,
                'payment_status'=>0,
            ]);
            return response()->json(['message'=>'the order is sent'],201); 
        }
        return response()->json(['message'=>'there is no order to send!']);
    }
    public function addtocart(Request $request)
    {
        
        $user=$request->user();

        $fields=$request->
        validate([
            'warehouse_id'=>'integer',
            'product_warehouse_id'=>'integer',
            'quantity'=>'integer|required',
        ]);

        $product=ProductWarehouse::find($fields['product_warehouse_id']);
        $price=$product->product->price;
        
        if(!Order::where('user_id',$user->id)->where('order_status',0)->first())
        {
            $order=Order::create([
                'warehouse_id'=>$fields['warehouse_id'],
                'order_status'=>0,
                'user_id'=>$user->id,
                'order_price'=> 0  
            ]);
        
            $OrderProductWarehouse=OrderProductWarehouse::create([
                'order_id'=>$order->id,
                'product_warehouse_id'=>$fields['product_warehouse_id'],
                'quantity'=>$fields['quantity'],
                'total_price'=>$price*$fields['quantity'],
            ]);
           $total=$OrderProductWarehouse->total_price;
           $order->update(['order_price'=> $total]);
        }
        
        else 
        { 
            $order=Order::where('user_id',$user->id)->
            where('order_status',0)->first();
            $order_price=$order->order_price;
            
            if(OrderProductWarehouse::where('order_id',$order->id)->where('product_warehouse_id',$fields['product_warehouse_id'])->first())
            { 
               
                $updatedProduct=OrderProductWarehouse::where('order_id',$order->id)
                ->where('product_warehouse_id',$fields['product_warehouse_id'])->first();
                $order_price-=$updatedProduct->total_price;

                OrderProductWarehouse::where('id',$updatedProduct->id)->update([
                    'quantity'=>$fields['quantity'],
                    'total_price'=>$fields['quantity']*$price,
                ]);
                $OrderProductWarehouse=OrderProductWarehouse::where('id',$updatedProduct->id)->first();

                   $order->update(['order_price'=> $order_price+$OrderProductWarehouse->total_price]);

            } 
            else
            {   
                $OrderProductWarehouse=OrderProductWarehouse::create([
                    'order_id'=>$order->id,
                    'product_warehouse_id'=>$fields['product_warehouse_id'],
                    'quantity'=>$fields['quantity'],
                    'total_price'=>$price*$fields['quantity'],
                ]);
                $order->update(['order_price'=> $order_price+$OrderProductWarehouse->total_price]);  
            }  
           
        }
        return response()->json(['message'=>'the item is ordered successfully!','Order'=>$order,'Order Item'=>$OrderProductWarehouse],201);        
    } 
    public function deleteorder(Request $request)
    {
        $user=$request->user();
       if(Order::where('user_id',$user->id)->where('order_status',0)->first()){
        Order::where('user_id',$user->id)->where('order_status',0)->delete();
        return response()->json(['massege'=>'the order is deleted'],200);
       }
       return response()->json(['massege'=>'there is no order to delete'],200);
    }
    public function getProductPrice(Request $request)
    {
        $fields=$request->validate([
            'product_warehouse_id'=>'integer',
        ]);
        $product=ProductWarehouse::find($fields['product_warehouse_id']);
        $price=$product->product->price;
        return response()->json(['product price:'=>$price]);
    }
    public function getProductTotalPrice(Request $request)
    {
        $fields=$request->validate([
            'product_warehouse_id'=>'integer',
            'quantity'=>'integer|required',
        ]);
        $product=ProductWarehouse::find($fields['product_warehouse_id']);
        $price=$product->product->price;
        return response()->json(['product total price :'=>$price*$fields['quantity']]);
    }
    public function orderPrice(Request $request)
    {
        $user=$request->user();
        $order=Order::where('user_id',$user->id)->
        where('order_status',0)->first();
        // not completed
    }
    public function getOrderProductWarehouse(Request $request)
    {
       $user=$request->user();
       $order_items=[];
       $order=Order::where('user_id',$user->id)->where('order_status',0)->first();
       $OrderProductsWarehouse=OrderProductWarehouse::where('order_id',$order->id)->get();
    //    foreach($OrderProductsWarehouse as $OrderProductWarehouse)
    //    {
    //     array_push($order_items,$OrderProductWarehouse);
    //    }
    //    return response()->json(['order items'=>$order_items]);
       return response()->json(['order items'=>$OrderProductsWarehouse]);
    }
    public function getOrders(Request $request)
    {
       $user=$request->user();
       $orders=[];
       $Orders=Order::where('user_id',$user->id)->where('order_status',1)->with('orderStatus')->get();
    //    dd( Order::with('orderStatus')->get());
    
    //     foreach($Orders as $order)
    //     {
    //         array_push($orders,$order);
    //     }
    //    return response()->json(['delivered orders'=>$orders]);

       return response()->json(['delivered orders'=>$Orders]);
    }

}
