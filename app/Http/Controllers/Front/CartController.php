<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartModelRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $items = $this->cart->get(); // returns a collection of cart items
        $total = $this->cart->total();
        return view('front.cart', compact('items' , 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1',
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity')); // to add with ordinary way

        if($request->expectsJson()) // to add with ajax
        {
            return response()->json([
                'message' => 'Item added to cart !'
            ], 201);
        }

        return redirect()->route('cart.index')->with('success', 'products added to cart');
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $this->cart->update($id, $request->post('quantity'));
    }

    public function destroy(string $id) // rule: argument from service container must be before the one from route !
    {
        $this->cart->delete($id); //delete with product id beacuse it is unique for every product
    }
}
