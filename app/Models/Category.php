<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'parent_id',
        'status'
    ];

    public static function rules($category = 0)
    {
        return [
            'name' => "required|string|max:255|unique:categories,name,$category",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|int|exists:categories,id',
            'description' => 'required|string|max:2000',
            'status' => 'in:active,archived',
            new Filter()
        ];
    }


    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? false) $builder->where('name', 'LIKE', "%{$filter['name']}%");
        if ($filter['status'] ?? false) $builder->where('status', $filter['status']);
    }

    public function getSequentialIdAttribute()
    {
        return static::where('id', '<=', $this->id)->count();
    }
}