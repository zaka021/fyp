<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'delivery_address' => 'required|string',
            'customer_phone' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check stock availability
        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }

        $totalAmount = $product->price * $request->quantity;

        $order = Order::create([
            'customer_id' => Auth::id(),
            'shopkeeper_id' => $product->shopkeeper_id,
            'product_id' => $request->product_id,
            'order_number' => Order::generateOrderNumber(),
            'quantity' => $request->quantity,
            'unit_price' => $product->price,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'delivery_address' => $request->delivery_address,
            'customer_phone' => $request->customer_phone,
            'notes' => $request->notes,
        ]);

        // Update product stock
        $product->decrement('stock_quantity', $request->quantity);

        return back()->with('success', 'Order placed successfully! Order number: ' . $order->order_number);
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'cart_data' => 'required|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'delivery_address' => 'required|string',
            'customer_phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {
            $cartItems = json_decode($request->cart_data, true);
            
            if (!$cartItems || !is_array($cartItems)) {
                return back()->with('error', 'Invalid cart data.');
            }

            $orders = [];
            $totalOrderAmount = 0;

            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                
                if (!$product) {
                    return back()->with('error', 'Product not found: ' . $item['name']);
                }
                
                // Check stock availability
                if ($product->stock_quantity < $item['quantity']) {
                    return back()->with('error', 'Insufficient stock for: ' . $product->name . '. Available: ' . $product->stock_quantity);
                }

                $totalAmount = $product->price * $item['quantity'];
                $totalOrderAmount += $totalAmount;

                $order = Order::create([
                    'customer_id' => Auth::id(),
                    'shopkeeper_id' => $product->shopkeeper_id,
                    'product_id' => $product->id,
                    'order_number' => Order::generateOrderNumber(),
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'delivery_address' => $request->delivery_address,
                    'customer_phone' => $request->customer_phone,
                    'notes' => $request->notes,
                ]);

                // Update product stock
                $product->decrement('stock_quantity', $item['quantity']);
                
                $orders[] = $order;
            }

            return back()->with('success', 'Orders placed successfully! ' . count($orders) . ' orders created. Total amount: ₹' . number_format($totalOrderAmount));

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to place orders. Please try again.');
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        try {
            if ($order->shopkeeper_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
            }

            $request->validate([
                'status' => 'required|in:pending,accepted,confirmed,preparing,out_for_delivery,delivered,cancelled,flagged',
            ]);

            $order->update([
                'status' => $request->status,
                'delivered_at' => $request->status === 'delivered' ? now() : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!',
                'order' => $order->load(['customer', 'product'])
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid status provided.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function acceptOrder(Request $request, Order $order)
    {
        try {
            if ($order->shopkeeper_id !== Auth::id()) {
                return response()->json(['success' => false, 'error' => 'Unauthorized action.'], 403);
            }

            $order->update(['status' => 'accepted']);
            
            return response()->json([
                'success' => true,
                'message' => 'Order accepted successfully!',
                'order' => $order->load(['customer', 'product'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to accept order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cancelOrder(Request $request, Order $order)
    {
        try {
            if ($order->shopkeeper_id !== Auth::id()) {
                return response()->json(['success' => false, 'error' => 'Unauthorized action.'], 403);
            }

            $order->update(['status' => 'cancelled']);
            
            // Restore product stock
            if ($order->product) {
                $order->product->increment('stock_quantity', $order->quantity);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to cancel order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function flagOrder(Request $request, Order $order)
    {
        try {
            if ($order->shopkeeper_id !== Auth::id()) {
                return response()->json(['success' => false, 'error' => 'Unauthorized action.'], 403);
            }

            $order->update(['status' => 'flagged']);
            
            // Restore product stock
            if ($order->product) {
                $order->product->increment('stock_quantity', $order->quantity);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Order flagged due to circumstances (e.g., lockdown, unavailability)'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to flag order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPendingOrders()
    {
        return Order::where('shopkeeper_id', Auth::id())
                   ->where('status', 'pending')
                   ->with(['product', 'customer'])
                   ->orderBy('created_at', 'desc')
                   ->get();
    }

    public function getCustomerOrders()
    {
        return Order::where('customer_id', Auth::id())
                   ->with(['product', 'shopkeeper'])
                   ->orderBy('created_at', 'desc')
                   ->get();
    }

    public function getShopkeeperOrders()
    {
        return Order::where('shopkeeper_id', Auth::id())
                   ->with(['product', 'customer'])
                   ->orderBy('created_at', 'desc')
                   ->get();
    }

    public function notifications()
    {
        $orders = Order::where('shopkeeper_id', Auth::id())
                      ->with(['product', 'customer'])
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('notifications', compact('orders'));
    }

    public function customers()
    {
        $customers = Order::where('shopkeeper_id', Auth::id())
                         ->with('customer')
                         ->select('customer_id')
                         ->distinct()
                         ->get()
                         ->map(function($order) {
                             $customer = $order->customer;
                             $customerOrders = Order::where('shopkeeper_id', Auth::id())
                                                   ->where('customer_id', $customer->id)
                                                   ->get();
                             
                             return [
                                 'id' => $customer->id,
                                 'name' => $customer->name,
                                 'email' => $customer->email,
                                 'total_orders' => $customerOrders->count(),
                                 'total_spent' => $customerOrders->sum('total_amount'),
                                 'last_order' => $customerOrders->max('created_at'),
                                 'status_counts' => [
                                     'pending' => $customerOrders->where('status', 'pending')->count(),
                                     'accepted' => $customerOrders->where('status', 'accepted')->count(),
                                     'delivered' => $customerOrders->where('status', 'delivered')->count(),
                                     'cancelled' => $customerOrders->where('status', 'cancelled')->count(),
                                 ]
                             ];
                         });
        
        return view('customers', compact('customers'));
    }

    public function markOrderReceived(Request $request, Order $order)
    {
        // Verify that the customer owns this order
        if ($order->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        // Only allow marking as received if order is out for delivery
        if ($order->status !== 'out_for_delivery') {
            return response()->json([
                'success' => false,
                'message' => 'Order can only be marked as received when it is out for delivery.'
            ]);
        }

        $order->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Order marked as delivered! Revenue will be added to shopkeeper when order is completed.'
        ]);
    }

    public function submitFeedback(Request $request, Order $order)
    {
        // Verify that the customer owns this order
        if ($order->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        // Only allow feedback for delivered orders
        if ($order->status !== 'delivered') {
            return response()->json([
                'success' => false,
                'message' => 'Feedback can only be submitted for delivered orders.'
            ]);
        }

        // Check if feedback already exists
        if ($order->rating) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback has already been submitted for this order.'
            ]);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000'
        ]);

        $order->update([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
            'feedback_at' => now(),
            'status' => 'completed' // Mark as completed when feedback is submitted
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback! Order completed and revenue added to shopkeeper.'
        ]);
    }

    public function cancelCustomerOrder(Request $request, Order $order)
    {
        // Verify that the customer owns this order
        if ($order->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        // Only allow cancellation for pending orders
        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order can only be cancelled when it is pending.'
            ]);
        }

        $order->update(['status' => 'cancelled']);
        
        // Restore product stock
        if ($order->product) {
            $order->product->increment('stock_quantity', $order->quantity);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully!'
        ]);
    }

    public function analytics()
    {
        $shopkeeperId = Auth::id();
        
        // Basic stats
        $totalOrders = Order::where('shopkeeper_id', $shopkeeperId)->count();
        $totalRevenue = Order::where('shopkeeper_id', $shopkeeperId)->where('status', 'completed')->sum('total_amount');
        $pendingOrders = Order::where('shopkeeper_id', $shopkeeperId)->where('status', 'pending')->count();
        $completedOrders = Order::where('shopkeeper_id', $shopkeeperId)->where('status', 'completed')->count();
        
        // Orders by status
        $ordersByStatus = Order::where('shopkeeper_id', $shopkeeperId)
                              ->selectRaw('status, COUNT(*) as count')
                              ->groupBy('status')
                              ->get();
        
        // Daily sales for last 7 days (only completed orders)
        $dailySales = Order::where('shopkeeper_id', $shopkeeperId)
                          ->where('status', 'completed')
                          ->where('created_at', '>=', now()->subDays(7))
                          ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total, COUNT(*) as orders')
                          ->groupBy('date')
                          ->orderBy('date')
                          ->get();
        
        // Monthly revenue for last 6 months (only completed orders)
        $monthlyRevenue = Order::where('shopkeeper_id', $shopkeeperId)
                              ->where('status', 'completed')
                              ->where('created_at', '>=', now()->subMonths(6))
                              ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total')
                              ->groupBy('year', 'month')
                              ->orderBy('year')
                              ->orderBy('month')
                              ->get();
        
        // Top products (only completed orders)
        $topProducts = Order::where('shopkeeper_id', $shopkeeperId)
                           ->where('status', 'completed')
                           ->with('product')
                           ->selectRaw('product_id, SUM(quantity) as total_quantity, SUM(total_amount) as total_revenue, COUNT(*) as order_count')
                           ->groupBy('product_id')
                           ->orderBy('total_revenue', 'desc')
                           ->limit(10)
                           ->get();
        
        // Customer analytics (only completed orders)
        $topCustomers = Order::where('shopkeeper_id', $shopkeeperId)
                            ->where('status', 'completed')
                            ->with('customer')
                            ->selectRaw('customer_id, SUM(total_amount) as total_spent, COUNT(*) as order_count')
                            ->groupBy('customer_id')
                            ->orderBy('total_spent', 'desc')
                            ->limit(10)
                            ->get();
        
        // Hourly order distribution
        $hourlyOrders = Order::where('shopkeeper_id', $shopkeeperId)
                            ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                            ->groupBy('hour')
                            ->orderBy('hour')
                            ->get();
        
        // Order completion rate
        $completionRate = $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0;
        
        return view('analytics', compact(
            'totalOrders', 'totalRevenue', 'pendingOrders', 'completedOrders',
            'ordersByStatus', 'dailySales', 'monthlyRevenue', 'topProducts',
            'topCustomers', 'hourlyOrders', 'completionRate'
        ));
    }
}
