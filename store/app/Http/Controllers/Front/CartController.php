<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->cart->get();
        $total = $this->cart->total();
        return view("front.cart", [
            "cart" => $items,
            "total" => $total,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required|int|exists:products,id",
            "quantity" => "nullable|int|min:1",
        ]);

        $product = Product::findOrFail($request->post('product_id'));

        $this->cart->add($product, $request->post('quantity'));

        if($request->expectsJson()) {
            return response()->json([
                    'message' => 'Product added to cart!',
                    ],201);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "quantity" => "required|int|min:1",
        ]);

        $this->cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cart->delete($id);

        return [
            "message" => "Product deleted from cart!",
        ];

        
    }
}
