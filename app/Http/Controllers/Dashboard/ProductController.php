<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category', 'store'])->filter($request->query())->paginate(5); //Eager Loading
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // $validatedData = $request->validate(Product::rules());
        // $product->update($validatedData);
        $product->update($request->except('tags'));
        $tags = explode(',', $request->post('tags')); //string to array , implode : array to string
        $tag_ids= [];
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag =  Tag::firstOrCreate(['slug' => $slug], ['name' => $t_name]);
            $tag_ids[] = $tag->id; //get ids of tags inserted
        }

        $product->tags()->sync($tag_ids);

        return redirect()->back()->with('success', 'Prodcut updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
