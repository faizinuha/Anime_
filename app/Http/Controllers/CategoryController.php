<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // storage
    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return view('categories.index')->with('succes', 'Category created successfully');
    }
    public function edit(Category $category) {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return view('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category) {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function showCategories() {
        $categories = Category::all();
        return view('layouts.master', compact('categories'));
    }
    
}
