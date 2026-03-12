@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-primary me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Users</h6>
                        <h3 class="mb-0">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-success me-3">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Customers</h6>
                        <h3 class="mb-0">{{ $totalCustomers }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-info me-3">
                        <i class="fas fa-store"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Shopkeepers</h6>
                        <h3 class="mb-0">{{ $totalShopkeepers }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-warning me-3">
                        <i class="fas fa-box"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Products</h6>
                        <h3 class="mb-0">{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-danger me-3">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h3 class="mb-0">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-success me-3">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Revenue</h6>
                        <h3 class="mb-0">Rs. {{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-purple me-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Avg. Order Value</h6>
                        <h3 class="mb-0">Rs. {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 2) : '0.00' }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="stats-card">
                <h5 class="mb-4">Analytics Dashboard</h5>
                <div class="row">
                    <!-- Chart 1: Monthly Revenue -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Monthly Revenue</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 2: Order Status -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Order Status</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="orderStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 3: User Growth -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">User Growth</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="userGrowthChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 4: Product Categories -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Product Categories</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="categoriesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 5: Daily Sales -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Daily Sales</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 6: Customer Satisfaction -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Customer Ratings</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="ratingsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 7: Payment Methods -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Payment Methods</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="paymentChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 8: Weekly Orders -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Weekly Orders</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="weeklyOrdersChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart 9: Top Shopkeepers -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="border rounded p-3" style="height: 280px;">
                            <h6 class="text-center mb-3">Top Shopkeepers</h6>
                            <div style="height: 220px; width: 100%; position: relative;">
                                <canvas id="topShopkeepersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Section -->
    <div class="row">
        <div class="col-12">
            <div class="stats-card">
                <h5 class="mb-4">Recent Orders</h5>
                <div class="row">
                    @forelse($recentOrders as $order)
                    <div class="col-xl-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <div class="me-3">
                                <div class="bg-light rounded-circle p-2">
                                    <i class="fas fa-shopping-bag text-muted"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $order->product->name ?? 'N/A' }}</h6>
                                <small class="text-muted">{{ $order->customer->name ?? 'N/A' }} • {{ $order->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</div>
                                <span class="badge badge-custom 
                                    @if($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'accepted') bg-info
                                    @elseif($order->status == 'delivered') bg-success
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-3"></i>
                            <p>No recent orders</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="stats-card">
                <h5 class="mb-4">Quick Actions</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-users fa-2x mb-2 d-block"></i>
                            Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.products') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-box fa-2x mb-2 d-block"></i>
                            Manage Products
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-shopping-cart fa-2x mb-2 d-block"></i>
                            Manage Orders
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.settings') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-cog fa-2x mb-2 d-block"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Static data - no database calls
    const staticData = {
        revenue: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000],
        orderStatus: [65, 25, 10],
        userGrowth: [15, 25, 35, 42, 58, 67, 75, 82],
        categories: [25, 20, 18, 12, 10, 8, 4, 3],
        dailySales: [1200, 1900, 1500, 2500, 2200, 3000, 2800, 3200],
        ratings: [2, 5, 15, 35, 43, 38, 42, 45],
        payments: [35, 25, 15, 10, 8, 3, 2, 2],
        weeklyOrders: [45, 52, 61, 58, 67, 72, 68, 75],
        topShops: [120, 95, 87, 73, 68, 62, 58, 52]
    };

    // Chart 1: Monthly Revenue
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            datasets: [{
                data: staticData.revenue,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 40000 } }
        }
    });

    // Chart 2: Order Status
    new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Delivered', 'Pending', 'Cancelled'],
            datasets: [{
                data: staticData.orderStatus,
                backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Chart 3: User Growth
    new Chart(document.getElementById('userGrowthChart'), {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
            datasets: [{
                data: staticData.userGrowth,
                backgroundColor: '#3B82F6'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });

    // Chart 4: Product Categories
    new Chart(document.getElementById('categoriesChart'), {
        type: 'pie',
        data: {
            labels: ['Electronics', 'Clothing', 'Food', 'Books', 'Home', 'Sports', 'Beauty', 'Toys'],
            datasets: [{
                data: staticData.categories,
                backgroundColor: ['#6366F1', '#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#06B6D4', '#F97316', '#EF4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Chart 5: Daily Sales
    new Chart(document.getElementById('dailySalesChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon'],
            datasets: [{
                data: staticData.dailySales,
                borderColor: '#F97316',
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 4000 } }
        }
    });

    // Chart 6: Customer Ratings
    new Chart(document.getElementById('ratingsChart'), {
        type: 'bar',
        data: {
            labels: ['1★', '2★', '3★', '4★', '5★', '4.5★', '4.8★', '4.9★'],
            datasets: [{
                data: staticData.ratings,
                backgroundColor: ['#EF4444', '#F97316', '#FBBF24', '#10B981', '#059669', '#06B6D4', '#3B82F6', '#6366F1']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 50 } }
        }
    });

    // Chart 7: Payment Methods
    new Chart(document.getElementById('paymentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Card', 'UPI', 'Cash', 'Wallet', 'Bank', 'Crypto', 'PayPal', 'Other'],
            datasets: [{
                data: staticData.payments,
                backgroundColor: ['#10B981', '#3B82F6', '#F59E0B', '#8B5CF6', '#EC4899', '#06B6D4', '#F97316', '#EF4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Chart 8: Weekly Orders
    new Chart(document.getElementById('weeklyOrdersChart'), {
        type: 'bar',
        data: {
            labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8'],
            datasets: [{
                data: staticData.weeklyOrders,
                backgroundColor: '#8B5CF6'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, max: 80 } }
        }
    });

    // Chart 9: Top Shopkeepers
    new Chart(document.getElementById('topShopkeepersChart'), {
        type: 'horizontalBar',
        data: {
            labels: ['Ali Store', 'Sara Shop', 'Ahmed Mart', 'Fatima Store', 'Hassan Shop', 'Ayesha Mart', 'Omar Store', 'Zara Shop'],
            datasets: [{
                data: staticData.topShops,
                backgroundColor: '#EC4899'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, max: 150 } }
        }
    });
</script>
@endsection
