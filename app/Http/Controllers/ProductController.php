<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Product::get();
        return response()->json($data);
    }

    public function create(){
        $quote = User::findOrFail(1);
        Mail::send('mails.oportunity', compact('quote'), function ($message) use ($quote) {
            $message->to(["leonardo.aguilar@benthocode.com"])
            ->subject('Bentho Automation - Cotización perdida - número: 3');
        });
        return response()->json("s");
    }

    public function store(Request $request){
        $product = new Product($request->all());
        $product->createdBy()->associate(User::get()->first());
        $product->save();
        return response()->json($request);
    }

    public function show($id){
        $data = Product::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        //return response()->json($product);
        //$product->updatedBy()->associate(User::get()->first());

        $product->save();

        return response()->json($request);
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(true);
    }
}
