<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get overall statistics
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalShopkeepers = User::where('role', 'shopkeeper')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');
        
        // Recent orders
        $recentOrders = Order::with(['customer', 'shopkeeper', 'product'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Monthly revenue data for chart
        $monthlyRevenue = Order::where('status', 'delivered')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalCustomers', 'totalShopkeepers', 
            'totalProducts', 'totalOrders', 'totalRevenue',
            'recentOrders', 'monthlyRevenue'
        ));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::with('shopkeeper')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with(['customer', 'shopkeeper', 'product'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role !== 'admin') {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Cannot delete admin user']);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }
}
