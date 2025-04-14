<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function index()
    {
        
        $products = Product::all(); // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        return view('admin.products.index', compact('products')); // Trả về view admin.products.index
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'image' => $request->input('image')
        ]);

        return response()->json([
            'message' => 'Thêm sản phẩm thành công!',
            'data' => $product
        ]);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm từ cơ sở dữ liệu
        $categories = Category::all(); // Lấy danh sách danh mục
        return view('admin.products.edit', compact('product', 'categories')); // Trả về view chỉnh sửa
    }
    
}
