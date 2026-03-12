@extends('shopkeeper.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Complete overview of your shop performance and information')

@section('content')
<!-- Shop Information Overview -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    <!-- Shop Details Card -->
    <div class="xl:col-span-2 bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-white text-xl font-bold flex items-center">
                <i class="fas fa-store mr-3 text-blue-400"></i>Shop Information
            </h3>
            <a href="{{ route('shopkeeper.settings') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-2 rounded-lg text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                <i class="fas fa-edit mr-1"></i>Edit
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Shop Name</p>
                    <p class="text-white text-lg font-semibold">{{ Auth::user()->name }}'s Store</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Owner</p>
                    <p class="text-white text-base">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Email</p>
                    <p class="text-white text-base">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Phone</p>
                    <p class="text-white text-base">+91 9876543210</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Address</p>
                    <p class="text-white text-base">123 Main Street, City Center</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Business Hours</p>
                    <p class="text-white text-base">9:00 AM - 9:00 PM</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Delivery Radius</p>
                    <p class="text-white text-base">5 KM</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Status</p>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-500/20 text-green-400">
                        <i class="fas fa-circle text-xs mr-1"></i>Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="space-y-4">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 font-medium mb-1">Total Revenue</p>
                    <p class="text-white text-2xl font-bold">Rs {{ number_format($totalRevenue ?? 0, 0) }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-rupee-sign text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 font-medium mb-1">Total Orders</p>
                    <p class="text-white text-2xl font-bold">{{ $orders->count() ?? 0 }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-shopping-cart text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 font-medium mb-1">Total Products</p>
                    <p class="text-white text-2xl font-bold">{{ $products->count() ?? 0 }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-box text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-300 font-medium mb-2">Today's Sales</p>
                <p class="text-white text-2xl font-bold">Rs {{ number_format($orders->where('created_at', '>=', today())->sum('total_amount') ?? 0, 0) }}</p>
                <p class="text-green-400 text-sm font-medium mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>+12% from yesterday
                </p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 p-3 rounded-xl">
                <i class="fas fa-calendar-day text-white text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-300 font-medium mb-2">Pending Orders</p>
                <p class="text-white text-2xl font-bold">{{ $orders->where('status', 'pending')->count() ?? 0 }}</p>
                <p class="text-orange-400 text-sm font-medium mt-1">
                    <i class="fas fa-clock mr-1"></i>Needs attention
                </p>
            </div>
            <div class="bg-gradient-to-br from-orange-500 to-red-500 p-3 rounded-xl">
                <i class="fas fa-hourglass-half text-white text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-300 font-medium mb-2">Active Customers</p>
                <p class="text-white text-2xl font-bold">{{ $orders->pluck('customer_id')->unique()->count() ?? 0 }}</p>
                <p class="text-blue-400 text-sm font-medium mt-1">
                    <i class="fas fa-users mr-1"></i>Total customers
                </p>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-indigo-500 p-3 rounded-xl">
                <i class="fas fa-user-friends text-white text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-300 font-medium mb-2">Low Stock Items</p>
                <p class="text-white text-2xl font-bold">{{ $products->where('stock_quantity', '<', 10)->count() ?? 0 }}</p>
                <p class="text-red-400 text-sm font-medium mt-1">
                    <i class="fas fa-exclamation-triangle mr-1"></i>Restock needed
                </p>
            </div>
            <div class="bg-gradient-to-br from-red-500 to-pink-500 p-3 rounded-xl">
                <i class="fas fa-box-open text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Quick Actions -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
    <!-- Recent Orders -->
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-white text-lg font-bold flex items-center">
                <i class="fas fa-clock mr-3 text-green-400"></i>Recent Orders
            </h3>
            <a href="{{ route('shopkeeper.orders') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View All</a>
        </div>
        
        <div class="space-y-4">
            @forelse($orders->take(5) as $order)
            <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg border border-white/10">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-lg">
                        <i class="fas fa-shopping-bag text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-white font-medium">{{ $order->customer->name ?? 'Customer' }}</p>
                        <p class="text-gray-400 text-sm">{{ $order->product->name ?? 'Product' }} • Rs {{ number_format($order->total_amount, 0) }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-2 py-1 rounded-lg text-xs font-semibold
                        @if($order->status === 'pending') bg-yellow-500/20 text-yellow-400
                        @elseif($order->status === 'accepted') bg-blue-500/20 text-blue-400
                        @elseif($order->status === 'completed') bg-green-500/20 text-green-400
                        @else bg-gray-500/20 text-gray-400
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                    <p class="text-gray-400 text-xs mt-1">{{ $order->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-shopping-cart text-gray-500 text-4xl mb-3"></i>
                <p class="text-gray-400">No recent orders</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
        <h3 class="text-white text-lg font-bold mb-6 flex items-center">
            <i class="fas fa-bolt mr-3 text-yellow-400"></i>Quick Actions
        </h3>
        
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('shopkeeper.products') }}" class="bg-gradient-to-br from-green-500 to-emerald-600 p-4 rounded-xl text-center hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-plus text-white text-2xl mb-2"></i>
                <p class="text-white font-medium text-sm">Add Product</p>
            </a>
            
            <a href="{{ route('shopkeeper.orders') }}" class="bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-xl text-center hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-list text-white text-2xl mb-2"></i>
                <p class="text-white font-medium text-sm">View Orders</p>
            </a>
            
            <a href="{{ route('shopkeeper.customers') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 p-4 rounded-xl text-center hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-users text-white text-2xl mb-2"></i>
                <p class="text-white font-medium text-sm">Customers</p>
            </a>
            
            <a href="{{ route('shopkeeper.analytics') }}" class="bg-gradient-to-br from-orange-500 to-red-500 p-4 rounded-xl text-center hover:from-orange-600 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-chart-bar text-white text-2xl mb-2"></i>
                <p class="text-white font-medium text-sm">Analytics</p>
            </a>
        </div>
        
        <!-- Business Status Toggle -->
        <div class="mt-6 p-4 bg-white/5 rounded-lg border border-white/10">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white font-medium">Business Status</p>
                    <p class="text-gray-400 text-sm">Currently accepting orders</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                </label>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Analytics Charts -->
<div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg">
    <h3 class="text-white text-lg font-bold mb-6 flex items-center">
        <i class="fas fa-chart-area mr-3 text-blue-400"></i>Business Analytics Dashboard
    </h3>
    
    <!-- 6 Charts Grid (3 per row) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Chart 1: Sales Performance -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-line mr-2 text-green-400"></i>Sales Performance
            </h4>
            <div class="h-40">
                <canvas id="salesPerformanceChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 2: Order Status Distribution -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-pie mr-2 text-blue-400"></i>Order Status
            </h4>
            <div class="h-40">
                <canvas id="orderStatusChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 3: Monthly Revenue -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-bar mr-2 text-purple-400"></i>Monthly Revenue
            </h4>
            <div class="h-40">
                <canvas id="monthlyRevenueChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 4: Top Products -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-star mr-2 text-orange-400"></i>Top Products
            </h4>
            <div class="h-40">
                <canvas id="topProductsChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 5: Customer Growth -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-users mr-2 text-cyan-400"></i>Customer Growth
            </h4>
            <div class="h-40">
                <canvas id="customerGrowthChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 6: Hourly Orders -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-clock mr-2 text-yellow-400"></i>Hourly Orders
            </h4>
            <div class="h-40">
                <canvas id="hourlyOrdersChart" class="w-full h-full"></canvas>
            </div>
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
    const products = @json($products);
    
    // Process data functions
    const processWeeklySales = () => {
        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        const weeklyData = new Array(7).fill(0);
        const today = new Date();
        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
        
        orders.forEach(order => {
            const orderDate = new Date(order.created_at);
            const daysDiff = Math.floor((orderDate - startOfWeek) / (1000 * 60 * 60 * 24));
            if (daysDiff >= 0 && daysDiff < 7) {
                weeklyData[daysDiff] += parseFloat(order.total_amount);
            }
        });
        
        return { labels: days, data: weeklyData };
    };

    const processOrdersByStatus = () => {
        const statusCounts = {};
        orders.forEach(order => {
            statusCounts[order.status] = (statusCounts[order.status] || 0) + 1;
        });
        return {
            labels: Object.keys(statusCounts),
            data: Object.values(statusCounts)
        };
    };

    const processMonthlyRevenue = () => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const currentYear = new Date().getFullYear();
        const monthlyData = new Array(12).fill(0);
        
        orders.forEach(order => {
            const orderDate = new Date(order.created_at);
            if (orderDate.getFullYear() === currentYear) {
                monthlyData[orderDate.getMonth()] += parseFloat(order.total_amount);
            }
        });
        
        return { labels: months, data: monthlyData };
    };

    const processTopProducts = () => {
        const productSales = {};
        orders.forEach(order => {
            if (order.product) {
                const productName = order.product.name;
                productSales[productName] = (productSales[productName] || 0) + parseInt(order.quantity || 1);
            }
        });
        
        const sortedProducts = Object.entries(productSales)
            .sort(([,a], [,b]) => b - a)
            .slice(0, 5);
            
        // If no products, return default data
        if (sortedProducts.length === 0) {
            return {
                labels: ['No Products'],
                data: [0]
            };
        }
            
        return {
            labels: sortedProducts.map(([name]) => name.length > 12 ? name.substring(0, 12) + '...' : name),
            data: sortedProducts.map(([,sales]) => sales)
        };
    };

    const processCustomerGrowth = () => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const currentYear = new Date().getFullYear();
        const monthlyCustomers = new Array(12).fill(0);
        const seenCustomers = {};
        
        orders.forEach(order => {
            const orderDate = new Date(order.created_at);
            const month = orderDate.getMonth();
            if (orderDate.getFullYear() === currentYear && !seenCustomers[order.customer_id + '-' + month]) {
                monthlyCustomers[month]++;
                seenCustomers[order.customer_id + '-' + month] = true;
            }
        });
        
        return { labels: months, data: monthlyCustomers };
    };

    const processHourlyOrders = () => {
        const hours = Array.from({length: 24}, (_, i) => `${i}:00`);
        const hourlyData = new Array(24).fill(0);
        
        orders.forEach(order => {
            const hour = new Date(order.created_at).getHours();
            hourlyData[hour]++;
        });
        
        return { labels: hours, data: hourlyData };
    };

    // Chart 1: Sales Performance (Weekly)
    const salesData = processWeeklySales();
    new Chart(document.getElementById('salesPerformanceChart'), {
        type: 'line',
        data: {
            labels: salesData.labels,
            datasets: [{
                label: 'Sales (Rs)',
                data: salesData.data,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10B981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { color: 'rgba(255,255,255,0.1)' } }
            }
        }
    });

    // Chart 2: Order Status Distribution
    const statusData = processOrdersByStatus();
    new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.data,
                backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 9 } } } }
        }
    });

    // Chart 3: Monthly Revenue
    const monthlyData = processMonthlyRevenue();
    new Chart(document.getElementById('monthlyRevenueChart'), {
        type: 'bar',
        data: {
            labels: monthlyData.labels,
            datasets: [{
                label: 'Revenue',
                data: monthlyData.data,
                backgroundColor: 'rgba(139, 92, 246, 0.8)',
                borderColor: '#8B5CF6',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { color: 'rgba(255,255,255,0.1)' } }
            }
        }
    });

    // Add error handling and debugging
    console.log('Orders data:', orders);
    console.log('Products data:', products);

    // Chart 4: Top Products
    try {
        const topProductsData = processTopProducts();
        console.log('Top Products Data:', topProductsData);
        
        const topProductsCanvas = document.getElementById('topProductsChart');
        if (topProductsCanvas) {
            new Chart(topProductsCanvas, {
                type: 'bar',
                data: {
                    labels: topProductsData.labels,
                    datasets: [{
                        label: 'Sales',
                        data: topProductsData.data,
                        backgroundColor: 'rgba(245, 158, 11, 0.8)',
                        borderColor: '#F59E0B',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        } else {
            console.error('Top Products chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating Top Products chart:', error);
    }

    // Chart 5: Customer Growth
    try {
        const customerData = processCustomerGrowth();
        console.log('Customer Growth Data:', customerData);
        
        const customerGrowthCanvas = document.getElementById('customerGrowthChart');
        if (customerGrowthCanvas) {
            new Chart(customerGrowthCanvas, {
                type: 'line',
                data: {
                    labels: customerData.labels,
                    datasets: [{
                        label: 'New Customers',
                        data: customerData.data,
                        borderColor: '#06B6D4',
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#06B6D4',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        } else {
            console.error('Customer Growth chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating Customer Growth chart:', error);
    }

    // Chart 6: Hourly Orders
    try {
        const hourlyData = processHourlyOrders();
        console.log('Hourly Orders Data:', hourlyData);
        
        const hourlyOrdersCanvas = document.getElementById('hourlyOrdersChart');
        if (hourlyOrdersCanvas) {
            new Chart(hourlyOrdersCanvas, {
                type: 'bar',
                data: {
                    labels: hourlyData.labels,
                    datasets: [{
                        label: 'Orders',
                        data: hourlyData.data,
                        backgroundColor: 'rgba(251, 191, 36, 0.8)',
                        borderColor: '#FBB936',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { 
                            grid: { color: 'rgba(255,255,255,0.1)' },
                            ticks: { maxTicksLimit: 12 }
                        }
                    }
                }
            });
        } else {
            console.error('Hourly Orders chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating Hourly Orders chart:', error);
    }
});
</script>
@endsection
