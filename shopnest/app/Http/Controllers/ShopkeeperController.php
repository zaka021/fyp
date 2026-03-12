<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class ShopkeeperController extends Controller
{
    /**
     * Show the shopkeeper dashboard (default view)
     */
    public function dashboard()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.dashboard', $data);
    }

    /**
     * Show the products section
     */
    public function products()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.products', $data);
    }

    /**
     * Show the orders section
     */
    public function orders()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.orders', $data);
    }

    /**
     * Show the analytics section
     */
    public function analytics()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.analytics', $data);
    }

    /**
     * Show the customers section
     */
    public function customers()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.customers', $data);
    }

    /**
     * Show the settings section
     */
    public function settings()
    {
        $data = $this->getSharedData();
        return view('shopkeeper.settings', $data);
    }

    /**
     * Get shared data for all shopkeeper views
     */
    private function getSharedData()
    {
        $products = collect();
        $orders = collect();
        $totalRevenue = 0;
        $completedOrders = 0;
        
        try {
            $products = Product::where('shopkeeper_id', Auth::id())->get();
            $orders = Order::where('shopkeeper_id', Auth::id())
                          ->with(['product', 'customer'])
                          ->orderBy('created_at', 'desc')
                          ->get();
            $totalRevenue = Order::where('shopkeeper_id', Auth::id())
                                ->where('status', 'completed')
                                ->sum('total_amount');
            $completedOrders = Order::where('shopkeeper_id', Auth::id())
                                   ->where('status', 'completed')
                                   ->count();
        } catch (\Exception $e) {
            // Tables might not exist yet, use empty collections
        }
        
        return compact('products', 'orders', 'totalRevenue', 'completedOrders');
    }
}
