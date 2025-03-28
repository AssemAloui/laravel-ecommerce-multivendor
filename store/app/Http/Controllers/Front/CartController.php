<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CartRepository $cart)
    {
        $items = $cart->get();
        return view("front.cart", [
            "cart" => $items,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            "product_id" => "required|int|exists:products,id",
            "quantity" => "nullable|int|min:1",
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $cart->add($product, $request->post('quantity'));
    }


    public function update(Request $request, CartRepository $cart)
    {
        $request->validate([
            "product_id" => "required|int|exists:products,id",
            "quantity" => "nullable|int|min:1",
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $cart->update($product, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartRepository $cart,$id)
    {
        $product = Product::findOrFail($id);
        $cart->delete($product);
    }
}
