<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;

    protected $table = 'order_items'; //I named it manually becuase laravel needs to know

    public $incrementing = true; //Pivot models are non-incrementing by default

    public $timestamps = false;

    protected $fillable = [ // It can be not used , pivot has in defualt proteced $guarded = [];
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'options',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => $this->product_name //if product_name is null in order_items table , fill it from products table using this relation
        ]);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
