@extends('shopkeeper.layout')

@section('title', 'Customer Management')
@section('page-title', 'Customer Management')
@section('page-subtitle', 'Manage and track your customer relationships')

@section('content')
<!-- Customer Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 font-medium mb-2">Total Customers</p>
                <p class="text-white text-3xl font-bold">{{ $orders->pluck('customer_id')->unique()->count() }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-xl">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 font-medium mb-2">Active This Month</p>
                <p class="text-white text-3xl font-bold">{{ $orders->filter(function($order) { return $order->created_at->month == now()->month; })->pluck('customer_id')->unique()->count() }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-xl">
                <i class="fas fa-user-check text-white text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 font-medium mb-2">Repeat Customers</p>
                <p class="text-white text-3xl font-bold">{{ $orders->groupBy('customer_id')->filter(function($customerOrders) { return $customerOrders->count() > 1; })->count() }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-xl">
                <i class="fas fa-heart text-white text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 font-medium mb-2">Avg Lifetime Value</p>
                <p class="text-white text-3xl font-bold">Rs {{ $orders->count() > 0 ? number_format($orders->groupBy('customer_id')->map(function($customerOrders) { return $customerOrders->sum('total_amount'); })->avg(), 0) : '0' }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-xl">
                <i class="fas fa-coins text-white text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Customer List -->
<div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 shadow-lg">
    <div class="p-6 border-b border-white/20">
        <div class="flex items-center justify-between">
            <h3 class="text-white text-lg font-bold">All Customers</h3>
            <div class="flex space-x-2">
                <button class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-2 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                    <i class="fas fa-download mr-1"></i>Export
                </button>
                <button class="bg-gradient-to-r from-green-500 to-green-600 px-4 py-2 rounded-lg text-white font-medium hover:from-green-600 hover:to-green-700 transition-all duration-300 text-sm">
                    <i class="fas fa-filter mr-1"></i>Filter
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-5">
        <div class="grid grid-cols-1 gap-4">
            @php
                $customerData = $orders->groupBy('customer_id')->map(function($customerOrders) {
                    $customer = $customerOrders->first()->customer;
                    return [
                        'customer' => $customer,
                        'orders_count' => $customerOrders->count(),
                        'total_spent' => $customerOrders->sum('total_amount'),
                        'last_order' => $customerOrders->sortByDesc('created_at')->first()->created_at,
                        'status' => $customerOrders->filter(function($order) { return $order->created_at >= now()->subDays(30); })->count() > 0 ? 'active' : 'inactive'
                    ];
                })->sortByDesc('total_spent');
            @endphp
            
            @forelse($customerData as $data)
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg hover-lift transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="bg-gradient-to-br from-{{ $data['status'] === 'active' ? 'green' : 'gray' }}-500 to-{{ $data['status'] === 'active' ? 'emerald' : 'slate' }}-600 p-3 rounded-xl shadow-lg">
                            <i class="fas fa-user text-white text-lg"></i>
                        </div>
                        <div class="space-y-1">
                            <p class="text-white font-bold text-base">{{ $data['customer']->name }}</p>
                            <p class="text-gray-300 font-medium text-sm">{{ $data['customer']->email }} • {{ $data['orders_count'] }} {{ Str::plural('order', $data['orders_count']) }}</p>
                            <p class="text-gray-400 text-xs">Last order: {{ $data['last_order']->format('M d, Y') }}</p>
                            <div class="flex items-center space-x-3 mt-3">
                                <span class="px-3 py-1 rounded-xl text-sm font-semibold
                                    @if($data['status'] === 'active') bg-green-500/20 text-green-400
                                    @else bg-gray-500/20 text-gray-400
                                    @endif">
                                    {{ ucfirst($data['status']) }}
                                </span>
                                @if($data['orders_count'] > 5)
                                    <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-purple-500/20 text-purple-400">
                                        VIP Customer
                                    </span>
                                @endif
                                @if($data['orders_count'] > 1)
                                    <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-blue-500/20 text-blue-400">
                                        Repeat Customer
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right space-y-2">
                        <div>
                            <p class="text-green-400 font-bold text-lg">Rs {{ number_format($data['total_spent'], 0) }}</p>
                            <p class="text-gray-300 font-medium text-sm">Total spent</p>
                        </div>
                        <div>
                            <p class="text-blue-400 font-bold text-base">Rs {{ number_format($data['total_spent'] / $data['orders_count'], 0) }}</p>
                            <p class="text-gray-400 text-xs">Avg per order</p>
                        </div>
                        <div class="flex space-x-1 mt-3">
                            <button class="bg-gradient-to-r from-blue-500 to-blue-600 p-2 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm" title="View Details">
                                <i class="fas fa-eye text-white"></i>
                            </button>
                            <button class="bg-gradient-to-r from-purple-500 to-purple-600 p-2 rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 text-sm" title="Order History">
                                <i class="fas fa-history text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-users text-gray-500 text-6xl mb-4"></i>
                <h3 class="text-white text-xl font-bold mb-3">No Customers Yet</h3>
                <p class="text-gray-400 text-base">Customers will appear here when they place orders.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Customer Insights -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
        <h3 class="text-white text-lg font-bold mb-4 flex items-center">
            <i class="fas fa-chart-bar mr-3 text-blue-400"></i>Customer Spending Distribution
        </h3>
        <div class="h-64">
            <canvas id="customerSpendingChart" class="w-full h-full"></canvas>
        </div>
    </div>
    
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
        <h3 class="text-white text-lg font-bold mb-4 flex items-center">
            <i class="fas fa-user-friends mr-2 text-green-400"></i>Customer Acquisition
        </h3>
        <div class="h-64">
            <canvas id="customerAcquisitionChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart.js default configuration
    Chart.defaults.color = '#ffffff';
    Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';
    Chart.defaults.backgroundColor = 'rgba(255, 255, 255, 0.05)';

    // Get real data from backend
    const orders = @json($orders);
    
    // Process customer spending data
    const processCustomerSpending = () => {
        const customerSpending = {};
        orders.forEach(order => {
            const customerId = order.customer_id;
            customerSpending[customerId] = (customerSpending[customerId] || 0) + parseFloat(order.total_amount);
        });
        
        const spendingRanges = {
            '0-1000': 0,
            '1000-5000': 0,
            '5000-10000': 0,
            '10000+': 0
        };
        
        Object.values(customerSpending).forEach(amount => {
            if (amount < 1000) spendingRanges['0-1000']++;
            else if (amount < 5000) spendingRanges['1000-5000']++;
            else if (amount < 10000) spendingRanges['5000-10000']++;
            else spendingRanges['10000+']++;
        });
        
        return {
            labels: Object.keys(spendingRanges),
            data: Object.values(spendingRanges)
        };
    };

    // Process customer acquisition data
    const processCustomerAcquisition = () => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const currentYear = new Date().getFullYear();
        const monthlyCustomers = new Array(12).fill(0);
        const seenCustomers = new Set();
        
        orders.forEach(order => {
            const orderDate = new Date(order.created_at);
            if (orderDate.getFullYear() === currentYear && !seenCustomers.has(order.customer_id)) {
                monthlyCustomers[orderDate.getMonth()]++;
                seenCustomers.add(order.customer_id);
            }
        });
        
        return { labels: months, data: monthlyCustomers };
    };

    // Chart 1: Customer Spending Distribution
    const spendingData = processCustomerSpending();
    new Chart(document.getElementById('customerSpendingChart'), {
        type: 'bar',
        data: {
            labels: spendingData.labels,
            datasets: [{
                label: 'Customers',
                data: spendingData.data,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    '#3B82F6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Customer Spending Ranges (Rs)',
                    color: '#ffffff'
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(255,255,255,0.1)' },
                    ticks: { color: '#ffffff' }
                },
                x: { 
                    grid: { color: 'rgba(255,255,255,0.1)' },
                    ticks: { color: '#ffffff' }
                }
            }
        }
    });

    // Chart 2: Customer Acquisition
    const acquisitionData = processCustomerAcquisition();
    new Chart(document.getElementById('customerAcquisitionChart'), {
        type: 'line',
        data: {
            labels: acquisitionData.labels,
            datasets: [{
                label: 'New Customers',
                data: acquisitionData.data,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10B981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Monthly Customer Acquisition',
                    color: '#ffffff'
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(255,255,255,0.1)' },
                    ticks: { color: '#ffffff' }
                },
                x: { 
                    grid: { color: 'rgba(255,255,255,0.1)' },
                    ticks: { color: '#ffffff' }
                }
            }
        }
    });
});
</script>
@endsection
