<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'payment_method',
        'status',
        'payment_status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer',
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
        ->using(OrderItem::class) //can be used only when the pivot table extends Pivot not Model , go OrderItem and see :)
            ->withPivot([
                'product_name',
                'price',
                'quantity',
                'options'
            ]);
    }

    public function addressess()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class , 'order_id' , 'id')
        ->where('type' , 'billing'); //returns one and first element and it what i need for now

       // return $this->addressess()->where('type' , 'billing'); //will return a collection and i can take first element and make oprations on it
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class , 'order_id' , 'id')
        ->where('type' , 'shipping');
    }

    //lets make the order number auto generated !
    protected static function booted()
    {
        //year,ordernum -- 2024,0001
        static::creating(function(Order $order){
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        //SELECT MAX(nubmer) FROM orders
        $year = Carbon::now()->year();
        $number = Order::whereYear('created_at', $year)->max('number');

        if ($number) {
            return $number + 1;
        }
        return $year . ",0001";
    }
}
