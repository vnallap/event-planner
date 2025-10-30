<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::orderBy('name')->get());
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:categories,name'],
            'description' => ['nullable', 'string']
        ]);

        $category = Category::create($data);
        if ($request->wantsJson()) {
            return response()->json($category, 201);
        }
        return redirect()->route('admin.options');
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:120'],
            'description' => ['nullable', 'string']
        ]);

        $category->fill($data)->save();

        return response()->json($category);
    }

    public function destroy(Request $request, Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Deleted successfully']);
        }
        return redirect()->route('admin.options');
    }
}
