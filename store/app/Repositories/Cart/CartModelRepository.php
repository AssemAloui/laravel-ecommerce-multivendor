<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartModelRepository implements CartRepository
{
    protected $item;

    public function __construct()
    {
        $this->item = collect([]);
    }
    public function get(): Collection
    {
        if(!$this->item->count()) {
            $this->item = Cart::with('product')->get();
        }
        
        return $this->item;
    }

    public function add(Product $product, $quantity = 1): Cart
    {
        $item = Cart::where('product_id', '=', $product->id)
            ->first();

        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $this->get()->push($cart);
            return $cart;
        }

        $item->increment('quantity', $quantity);
        return $item->refresh();
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total(): float
    {
        // return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total');;

        return $this->get()->sum(function($item){
            return $item->product->price * $item->quantity;
        });
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }

}
