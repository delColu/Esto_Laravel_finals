<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // SHOW FORM + LIST
    public function create()
    {
        $categories = Category::all();
        return view('components.category-add', compact('categories'));
    }

    // STORE NEW CATEGORY
    public function store(Request $request)
    {
        $validated = $request->validate([
            'catname' => 'required|string|max:255',
            'catdesc' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $validated['catname'],
            'description' => $validated['catdesc'],
        ]);

        return redirect()->route('AddCategory')->with('success', 'Category added successfully')->with('clear_form', true);;
    }

    // EDIT FORM
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('components.category-add', compact('categories', 'category'));
    }

    // UPDATE CATEGORY
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'catname' => 'required|string|max:255',
            'catdesc' => 'nullable|string|max:500',
        ]);

        $category->update([
            'name' => $validated['catname'],
            'description' => $validated['catdesc'],
        ]);

        return redirect()->route('AddCategory')->with('success', 'Category updated successfully')->with('clear_form', true);;
    }

    // DELETE CATEGORY
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('AddCategory')->with('success', 'Category deleted successfully');
    }
}
