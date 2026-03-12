<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:food,grocery,fashion,electronics,pharmacy,gifts,taxi,beauty,home,sports,books,pets,automotive,services,education,travel,entertainment',
            'image_url' => 'nullable|url',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $imageUrl = $request->image_url;
        
        // Handle file upload if provided
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/products');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move uploaded file
            $image->move($uploadPath, $imageName);
            $imageUrl = '/uploads/products/' . $imageName;
        }

        Product::create([
            'shopkeeper_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image_url' => $imageUrl,
            'stock_quantity' => $request->stock_quantity,
            'is_active' => true,
        ]);

        return back()->with('success', 'Product added successfully!');
    }

    public function getShopkeeperProducts()
    {
        return Product::where('shopkeeper_id', Auth::id())->get();
    }

    public function getAllActiveProducts()
    {
        return Product::where('is_active', true)
                     ->where('stock_quantity', '>', 0)
                     ->with('shopkeeper')
                     ->get();
    }

    public function update(Request $request, Product $product)
    {
        if ($product->shopkeeper_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:food,grocery,fashion,electronics,pharmacy,gifts,taxi,beauty,home,sports,books,pets,automotive,services,education,travel,entertainment',
            'image_url' => 'nullable|url',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $updateData = $request->only(['name', 'description', 'price', 'category', 'stock_quantity']);
        
        // Handle image update
        if ($request->hasFile('product_image')) {
            // Delete old image if it exists and is a local file
            if ($product->image_url && strpos($product->image_url, '/uploads/products/') === 0) {
                $oldImagePath = public_path($product->image_url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('product_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/products');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move uploaded file
            $image->move($uploadPath, $imageName);
            $updateData['image_url'] = '/uploads/products/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $updateData['image_url'] = $request->image_url;
        }

        $product->update($updateData);

        return back()->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->shopkeeper_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete associated image file if it exists and is a local file
        if ($product->image_url && strpos($product->image_url, '/uploads/products/') === 0) {
            $imagePath = public_path($product->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
