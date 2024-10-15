<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use Throwable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;
use Symfony\Component\Intl\Countries;

class CheckOutController extends Controller
{
    protected $cart;
    public function __construct(CartModelRepository $cart)
    {
        $this->cart = $cart;
    }

    public function create()
    {
        if ($this->cart->get()->count() == 0) {
            return redirect()->route('home')->with('failure', 'cart is empty');
        }

        $total = $this->cart->total();
        return view('front.checkout', [
            'cart' => $this->cart,
            'countries' => Countries::getNames(),
            'total' =>$total
        ]);
    }

    public function store(Request $request, CartModelRepository $cart)
    {
        $request->validate([]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create([
                    'store_id' => $store_id,
                    //'user_id' => Auth::id(),
                    'user_id' => 4,
                    'payment_method' => 'just a string now',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }

            DB::commit();
            //event('order.created' , $order , Auth::user()); //call enent with its name
            //event(new OrderCreated($order , Auth::user())); //  call event as object
            event(new OrderCreated($order));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('front.index');
    }
}
