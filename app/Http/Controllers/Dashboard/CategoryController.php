<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])
        ->filter($request->query())
        ->paginate(4);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate(Category::rules());

        $request->merge([
            'slug' => Str::slug($request->post("name"))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $storeCategory = Category::create($data);
        if ($storeCategory) return redirect()->route('dashboard.categories.index')->with('success', 'category created!');
    }

    public function edit($id)
    {

        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route("dashboard.categories.index")->with(['info' => "The category doesn't exist"]);
        }
        $parents = Category::where('id', '<>', $id)
            ->where(
                function ($query) use ($id) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', '<>', $id);
                }
            )->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, $category)
    {
        $request->validate(Category::rules($category));

        $category = Category::findOrFail($category);
        $old_image = $category->image;
        $data = $request->except('image');
        $newImage = $this->uploadImage($request);
        if($newImage) $data['image'] = $newImage; // to prevent image to rutruned as null if user didnot  upload new one
        $category->update($data);

        if ($old_image && $newImage) Storage::disk('public')->delete($old_image); //to delete old image if user uploded new one !
        if ($category) return redirect()->route('dashboard.categories.index', ['category' => $category->id])->with('success', 'Category updated!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category) return redirect()->route('dashboard.categories.index')->with(['success' => "Category deleted!"]);
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(4);
        return view('dashboard.categories.trash' , compact('categories'));
    }

    public function restore($id)
    {
        $restoredCategory = Category::onlyTrashed()->findOrFail($id);
        $restoredCategory->restore();

        if ($restoredCategory) return redirect()->route('dashboard.categories.trash')->with(['success' => "Category restored!"]);
    }

    public function forceDelete($id)
    {
        $forceDeletedCategory = Category::onlyTrashed()->findOrFail($id);
        $forceDeletedCategory->forceDelete();

        if ($forceDeletedCategory->image) Storage::disk('public')->delete($forceDeletedCategory->image);
        if ($forceDeletedCategory) return redirect()->route('dashboard.categories.trash')->with(['success' => "Category deleted for ever!"]);
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) return;

        $file = $request->file('image');
        $path = $file->store('uplodedPhotes', 'public');
        return  $path;
    }
}