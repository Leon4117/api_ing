<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $data = Orders::with(['order_products'])->get();
        return response()->json($data);
    }

    public function store(Request $request){
        $order = new Orders($request->all());
        $order->createdBy()->associate(User::get()->first());
        $products = $request->products;
        $order->save();

        foreach($products as $product){
            $aux = [$product['id'] => ["qty" => $product['quantity']]];
            $order->products()->attach($aux);
        }

        Mail::send('mails.order', compact('order'), function ($message) use ($order) {
            $message->to("leonardo.aguilar@benthocode.com")
            ->subject('Bentho Automation - Orden creada - Folio: '.$order->folio);
        });

        return response()->json($request);
    }

    public function show($id){
        $data = Orders::where('id','=',$id)->with(['order_products'])->get()[0];
        return response()->json($data);
    }

    public function destroy($id){
        $order = Orders::findOrFail($id);
        $order->delete();

        return response()->json(true);
    }

    public function marca($id){
        $order = Orders::findOrFail($id);
        $order->delete();
        return response()->json($order);
    }
}
