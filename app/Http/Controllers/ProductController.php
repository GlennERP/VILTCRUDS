<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::latest()
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'category' => $product->category,
                        'description' => $product->description,
                        'price' => number_format($product->price, 2),
                        'qty' => $product->qty,
                        'image_url' => $product->image ? asset('storage/' . $product->image) : null,
                    ];
                });

            return Inertia::render('Admin/Product/index', [
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching products.');
        }
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


        return redirect()->route('product.store');
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

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
            ->with('message', 'Product deleted successfully.')
            ->with('type', 'success');
    }
}
