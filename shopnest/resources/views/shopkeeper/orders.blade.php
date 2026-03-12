@extends('shopkeeper.layout')

@section('title', 'Order Management')
@section('page-title', 'Order Management')
@section('page-subtitle', 'Manage and track your customer orders')

@section('content')
<div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 shadow-lg overflow-hidden">
    <div class="p-6 border-b border-white/20">
        <div class="flex items-center justify-between">
            <h3 class="text-white text-lg font-bold">Recent Orders</h3>
            <div class="flex space-x-2">
                <button class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-2 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm" onclick="filterOrders('all')">
                    <i class="fas fa-list mr-1"></i>All
                </button>
                <button class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-4 py-2 rounded-lg text-white font-medium hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 text-sm" onclick="filterOrders('pending')">
                    <i class="fas fa-clock mr-1"></i>Pending
                </button>
                <button class="bg-gradient-to-r from-green-500 to-green-600 px-4 py-2 rounded-lg text-white font-medium hover:from-green-600 hover:to-green-700 transition-all duration-300 text-sm" onclick="filterOrders('accepted')">
                    <i class="fas fa-check mr-1"></i>Accepted
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-5">
        <div class="grid grid-cols-1 gap-4" id="orders-container">
            @forelse($orders as $order)
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 order-item" data-status="{{ $order->status }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="p-3 rounded-xl
                            @if($order->status === 'pending') bg-yellow-500
                            @elseif($order->status === 'accepted') bg-blue-500
                            @elseif($order->status === 'confirmed') bg-green-500
                            @elseif($order->status === 'delivered') bg-green-600
                            @elseif($order->status === 'cancelled') bg-red-500
                            @elseif($order->status === 'flagged') bg-orange-500
                            @else bg-gray-500
                            @endif shadow-lg">
                            <i class="fas 
                                @if($order->status === 'pending') fa-clock
                                @elseif($order->status === 'accepted') fa-thumbs-up
                                @elseif($order->status === 'confirmed') fa-check
                                @elseif($order->status === 'delivered') fa-check-double
                                @elseif($order->status === 'cancelled') fa-times
                                @elseif($order->status === 'flagged') fa-flag
                                @else fa-question
                                @endif text-white text-xl"></i>
                        </div>
                        <div class="space-y-2">
                            <p class="text-white font-bold text-base">{{ $order->order_number }}</p>
                            <p class="text-gray-300 font-medium text-sm">{{ $order->customer->name }} • {{ $order->product->name }} ({{ $order->quantity }}x)</p>
                            <p class="text-gray-400 text-xs">{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-right space-y-3">
                        <p class="text-green-400 font-bold text-xl">Rs {{ number_format($order->total_amount, 0) }}</p>
                        <span class="px-4 py-2 rounded-xl text-sm font-semibold
                            @if($order->status === 'pending') bg-yellow-500/20 text-yellow-400
                            @elseif($order->status === 'accepted') bg-blue-500/20 text-blue-400
                            @elseif($order->status === 'confirmed') bg-green-500/20 text-green-400
                            @elseif($order->status === 'delivered') bg-green-600/20 text-green-300
                            @elseif($order->status === 'cancelled') bg-red-500/20 text-red-400
                            @elseif($order->status === 'flagged') bg-orange-500/20 text-orange-400
                            @else bg-gray-500/20 text-gray-400
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                        @if($order->status === 'accepted')
                        <div class="mt-3">
                            <select onchange="updateOrderStatus({{ $order->id }}, this.value)" class="bg-gray-700 text-white px-4 py-2 rounded-xl font-medium border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="accepted" selected>Accepted</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="preparing">Preparing</option>
                                <option value="out_for_delivery">Out for Delivery</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Customer Feedback Display -->
                @if($order->rating && $order->feedback && $order->status === 'completed')
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="bg-white/5 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h6 class="text-white font-semibold flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>Customer Feedback
                            </h6>
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $order->rating ? 'text-yellow-400' : 'text-gray-600' }} text-sm"></i>
                                @endfor
                                <span class="text-yellow-400 ml-2 font-semibold text-sm">{{ $order->rating }}/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm mb-2">{{ $order->feedback }}</p>
                        <p class="text-gray-500 text-xs">Submitted {{ $order->feedback_at->diffForHumans() }}</p>
                    </div>
                </div>
                @elseif($order->status === 'delivered')
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="bg-yellow-500/10 rounded-xl p-3 border border-yellow-500/20">
                        <p class="text-yellow-400 text-sm flex items-center">
                            <i class="fas fa-clock mr-2"></i>Waiting for customer feedback
                        </p>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-16">
                <i class="fas fa-shopping-cart text-gray-500 text-8xl mb-6"></i>
                <h3 class="text-white text-2xl font-bold mb-4">No Orders Yet</h3>
                <p class="text-gray-400 text-lg">Orders will appear here when customers place them.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function filterOrders(status) {
    const orders = document.querySelectorAll('.order-item');
    orders.forEach(order => {
        if (status === 'all' || order.dataset.status === status) {
            order.style.display = 'block';
        } else {
            order.style.display = 'none';
        }
    });
}

function updateOrderStatus(orderId, newStatus) {
    fetch(`/orders/${orderId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success !== false) {
            // Show success message
            showToast('Order status updated successfully!', 'success');
            // Reload page after short delay
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showToast(data.message || 'Failed to update order status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error updating order status: ' + error.message, 'error');
    });
}

function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 translate-x-full`;
    
    if (type === 'success') {
        toast.classList.add('bg-green-500');
    } else if (type === 'error') {
        toast.classList.add('bg-red-500');
    } else {
        toast.classList.add('bg-blue-500');
    }
    
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation-triangle' : 'info'} mr-2"></i>
            ${message}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
</script>
@endsection
