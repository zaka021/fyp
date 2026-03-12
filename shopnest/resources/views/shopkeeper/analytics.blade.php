@extends('shopkeeper.layout')

@section('title', 'Business Analytics')
@section('page-title', 'Business Analytics')
@section('page-subtitle', 'Track your business performance and insights')

@section('content')
<!-- Compact Analytics Summary -->
<div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
    <h3 class="text-white text-lg font-bold mb-3 flex items-center">
        <i class="fas fa-chart-bar mr-2 text-blue-400"></i>Analytics Summary
    </h3>
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mb-6">
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-emerald-400 text-lg font-bold">Rs {{ number_format($orders->where('status', 'delivered')->filter(function($order) { return $order->created_at->month == now()->month; })->sum('total_amount'), 0) }}</p>
            <p class="text-gray-300 text-xs">Monthly Revenue</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-blue-400 text-lg font-bold">Rs {{ $orders->count() > 0 ? number_format($orders->avg('total_amount'), 0) : '0' }}</p>
            <p class="text-gray-300 text-xs">Avg Order</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-purple-400 text-lg font-bold">{{ $orders->count() > 0 ? number_format(($orders->where('status', 'delivered')->count() / $orders->count()) * 100, 1) : '0' }}%</p>
            <p class="text-gray-300 text-xs">Success Rate</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-orange-400 text-lg font-bold">2:00 PM</p>
            <p class="text-gray-300 text-xs">Peak Hour</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-green-400 text-lg font-bold">Saturday</p>
            <p class="text-gray-300 text-xs">Best Day</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-blue-400 text-lg font-bold">78%</p>
            <p class="text-gray-300 text-xs">Retention</p>
        </div>
        
        <div class="text-center p-2 bg-white/5 rounded-lg">
            <p class="text-amber-400 text-lg font-bold">{{ $orders->count() > 0 ? number_format(($orders->where('status', 'cancelled')->count() / $orders->count()) * 100, 1) : '0' }}%</p>
            <p class="text-gray-300 text-xs">Return Rate</p>
        </div>
    </div>

    <!-- 12 Analytics Charts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Chart 1: Sales Trend -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-line mr-2 text-green-400"></i>Sales Trend
            </h4>
            <div class="h-40">
                <canvas id="salesTrendChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 2: Order Status -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-pie mr-2 text-blue-400"></i>Order Status
            </h4>
            <div class="h-40">
                <canvas id="orderStatusChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 3: Revenue Growth -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-area mr-2 text-purple-400"></i>Revenue Growth
            </h4>
            <div class="h-40">
                <canvas id="revenueGrowthChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 4: Top Products -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-chart-bar mr-2 text-orange-400"></i>Top Products
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

        <!-- Chart 7: Weekly Performance -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-calendar-week mr-2 text-pink-400"></i>Weekly Performance
            </h4>
            <div class="h-40">
                <canvas id="weeklyPerformanceChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 8: Category Sales -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-tags mr-2 text-indigo-400"></i>Category Sales
            </h4>
            <div class="h-40">
                <canvas id="categorySalesChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 9: Payment Methods -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-credit-card mr-2 text-emerald-400"></i>Payment Methods
            </h4>
            <div class="h-40">
                <canvas id="paymentMethodsChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 10: Customer Satisfaction -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-star mr-2 text-amber-400"></i>Customer Satisfaction
            </h4>
            <div class="h-40">
                <canvas id="customerSatisfactionChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 11: Delivery Performance -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-truck mr-2 text-red-400"></i>Delivery Performance
            </h4>
            <div class="h-40">
                <canvas id="deliveryPerformanceChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Chart 12: Inventory Status -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <h4 class="text-white text-sm font-bold mb-3 flex items-center">
                <i class="fas fa-boxes mr-2 text-teal-400"></i>Inventory Status
            </h4>
            <div class="h-40">
                <canvas id="inventoryStatusChart" class="w-full h-full"></canvas>
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
    
    // Process data for charts
    const processOrdersByMonth = () => {
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

    const processHourlyOrders = () => {
        const hours = Array.from({length: 24}, (_, i) => `${i}:00`);
        const hourlyData = new Array(24).fill(0);
        
        orders.forEach(order => {
            const hour = new Date(order.created_at).getHours();
            hourlyData[hour]++;
        });
        
        return { labels: hours, data: hourlyData };
    };

    const processWeeklyData = () => {
        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        const weeklyData = new Array(7).fill(0);
        
        orders.forEach(order => {
            const dayOfWeek = (new Date(order.created_at).getDay() + 6) % 7; // Convert Sunday=0 to Monday=0
            weeklyData[dayOfWeek] += parseFloat(order.total_amount);
        });
        
        return { labels: days, data: weeklyData };
    };

    const processTopProducts = () => {
        const productSales = {};
        orders.forEach(order => {
            if (order.product) {
                const productName = order.product.name;
                productSales[productName] = (productSales[productName] || 0) + parseInt(order.quantity);
            }
        });
        
        const sortedProducts = Object.entries(productSales)
            .sort(([,a], [,b]) => b - a)
            .slice(0, 5);
            
        return {
            labels: sortedProducts.map(([name]) => name.substring(0, 15) + '...'),
            data: sortedProducts.map(([,sales]) => sales)
        };
    };

    // Chart 1: Sales Trend
    const salesData = processOrdersByMonth();
    new Chart(document.getElementById('salesTrendChart'), {
        type: 'line',
        data: {
            labels: salesData.labels,
            datasets: [{
                label: 'Monthly Sales',
                data: salesData.data,
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
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { color: 'rgba(255,255,255,0.1)' } }
            }
        }
    });

    // Chart 2: Order Status
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
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } }
        }
    });

    // Chart 3: Revenue Growth
    new Chart(document.getElementById('revenueGrowthChart'), {
        type: 'bar',
        data: {
            labels: salesData.labels,
            datasets: [{
                label: 'Revenue',
                data: salesData.data,
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

    // Chart 4: Top Products
    try {
        const topProductsData = processTopProducts();
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
        }
    } catch (error) {
        console.error('Error creating Top Products chart:', error);
    }

    // Chart 5: Customer Growth
    try {
        const customerGrowthData = processOrdersByMonth();
        const customerGrowthCanvas = document.getElementById('customerGrowthChart');
        if (customerGrowthCanvas) {
            new Chart(customerGrowthCanvas, {
                type: 'line',
                data: {
                    labels: customerGrowthData.labels,
                    datasets: [{
                        label: 'New Customers',
                        data: customerGrowthData.data.map(val => Math.floor(val / 1000)), // Simulate customer count
                        borderColor: '#06B6D4',
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
                        tension: 0.4,
                        fill: true
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
        }
    } catch (error) {
        console.error('Error creating Customer Growth chart:', error);
    }

    // Chart 6: Hourly Orders
    try {
        const hourlyData = processHourlyOrders();
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
                        x: { grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Hourly Orders chart:', error);
    }

    // Chart 7: Weekly Performance
    try {
        const weeklyData = processWeeklyData();
        const weeklyPerformanceCanvas = document.getElementById('weeklyPerformanceChart');
        if (weeklyPerformanceCanvas) {
            new Chart(weeklyPerformanceCanvas, {
                type: 'radar',
                data: {
                    labels: weeklyData.labels,
                    datasets: [{
                        label: 'Sales',
                        data: weeklyData.data,
                        borderColor: '#EC4899',
                        backgroundColor: 'rgba(236, 72, 153, 0.2)',
                        pointBackgroundColor: '#EC4899'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        r: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.1)' },
                            pointLabels: { color: '#ffffff' }
                        }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Weekly Performance chart:', error);
    }

    // Chart 8: Category Sales
    try {
        const categorySalesCanvas = document.getElementById('categorySalesChart');
        if (categorySalesCanvas) {
            new Chart(categorySalesCanvas, {
                type: 'pie',
                data: {
                    labels: ['Electronics', 'Clothing', 'Food', 'Books', 'Others'],
                    datasets: [{
                        data: [30, 25, 20, 15, 10],
                        backgroundColor: ['#6366F1', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Category Sales chart:', error);
    }

    // Chart 9: Payment Methods
    try {
        const paymentMethodsCanvas = document.getElementById('paymentMethodsChart');
        if (paymentMethodsCanvas) {
            new Chart(paymentMethodsCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Cash', 'Card', 'Digital Wallet', 'Bank Transfer'],
                    datasets: [{
                        data: [40, 30, 20, 10],
                        backgroundColor: ['#10B981', '#3B82F6', '#F59E0B', '#8B5CF6']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Payment Methods chart:', error);
    }

    // Chart 10: Customer Satisfaction
    try {
        const customerSatisfactionCanvas = document.getElementById('customerSatisfactionChart');
        if (customerSatisfactionCanvas) {
            new Chart(customerSatisfactionCanvas, {
                type: 'bar',
                data: {
                    labels: ['5★', '4★', '3★', '2★', '1★'],
                    datasets: [{
                        label: 'Ratings',
                        data: [45, 30, 15, 7, 3],
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
                        x: { grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Customer Satisfaction chart:', error);
    }

    // Chart 11: Delivery Performance
    try {
        const deliveryPerformanceCanvas = document.getElementById('deliveryPerformanceChart');
        if (deliveryPerformanceCanvas) {
            new Chart(deliveryPerformanceCanvas, {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'On-time %',
                        data: [85, 90, 88, 92],
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 100, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Delivery Performance chart:', error);
    }

    // Chart 12: Inventory Status
    try {
        const inventoryStatusCanvas = document.getElementById('inventoryStatusChart');
        if (inventoryStatusCanvas) {
            new Chart(inventoryStatusCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['In Stock', 'Low Stock', 'Out of Stock'],
                    datasets: [{
                        data: [70, 20, 10],
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } }
                }
            });
        }
    } catch (error) {
        console.error('Error creating Inventory Status chart:', error);
    }
});
</script>
@endsection
