<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable =
    [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compart_price',
        'options',
        'rating',
        'featured',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            if (auth('admin')->check()) {
                $user = auth('admin')->user();
                if ($user->store_id) {
                    $builder->where('store_id', '=', $user->store_id);
                }
            } else {
                redirect()->route('loginPage')->send();
            }
        });
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? false) $builder->where('name', 'LIKE', "%{$filter['name']}%");
        if ($filter['status'] ?? false) $builder->where('status', $filter['status']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // Related Model
            'product_tage',  // Pivot table name
            'product_id',   // FK in pivot table for the current model
            'tag_id',       // FK in pivot table for the related model
            'id',           // PK current model
            'id'            // PK related model
        );
    }

    public static function rules()
    {
        return
            [
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'store_id' => 'required|exists:stores,id',
                'status' => 'required|in:active,draft,archived',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
    }
}