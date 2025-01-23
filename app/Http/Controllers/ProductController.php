<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10)->appends($request->only('search'));

        return Inertia::render('Admin/Product/index', [
            'products' => $products,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Product/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads/Product-Image', 'public');

        Product::create([
            'category' => $data['category'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'qty' => $data['qty'],
            'image' => $imagePath,
        ]);


        return redirect()->route('product');
    }

    public function update(Request $request, Product $product)
    {
        if ($request->isMethod('get')) {
            return Inertia::render('Admin/Product/update', ['product' => $product]);
        }

        $data = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/Product-Image', 'public');
            $data['image'] = $imagePath;
        } else {
            unset($data['image']);
        }

        $product->update(array_filter($data));

        return redirect()->route('product');
    }

    public function destroy(Product $product)
    {
        $product->delete();
       
        return redirect()->route('product');

    }
}
