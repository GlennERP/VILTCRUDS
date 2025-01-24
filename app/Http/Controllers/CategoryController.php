<?php  

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller 
{
    public function index()
    {
        try {
            $categories = Category::latest()
                ->get()
                ->map(function($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description
                    ];
                });

            return Inertia::render('Admin/Category/index', [
                'categories' => $categories
            ]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading categories');
        }
    }

    public function create() 
    {
        return Inertia::render('Admin/Category/create');
    }

    public function store(Request $request) 
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255'
            ]);

            Category::create($data);

            return redirect()->route('category.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating category')->withInput();
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255'
            ]);

            $category->update($data);

            return redirect()->route('category.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating category')->withInput();
        }
    }

    public function edit(Category $category) 
    {
        return Inertia::render('Admin/Category/update', [
            'category' => $category
        ]);
    }

    public function destroy(Category $category) 
    {
        try {
            $category->delete();

            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting category');
        }
    }
}
