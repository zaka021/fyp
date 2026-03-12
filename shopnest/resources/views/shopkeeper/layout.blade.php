<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Shopkeeper Dashboard') - Virtual Shop Nest</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'vsn-primary': '#3B82F6',
                        'vsn-secondary': '#10B981',
                        'vsn-accent': '#F59E0B',
                        'vsn-dark': '#1F2937',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'sparkle': 'sparkle 3s ease-in-out infinite',
                        'slide-in': 'slideIn 1s ease-out',
                        'fade-up': 'fadeUp 1s ease-out',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes glow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(59, 130, 246, 0.4); }
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }
        
        @keyframes slideIn {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeUp {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 15px rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.8), 0 0 45px rgba(16, 185, 129, 0.3); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes neonPulse {
            0%, 100% { text-shadow: 0 0 10px rgba(59, 130, 246, 0.8), 0 0 20px rgba(59, 130, 246, 0.6); }
            50% { text-shadow: 0 0 20px rgba(59, 130, 246, 1), 0 0 30px rgba(59, 130, 246, 0.8), 0 0 40px rgba(59, 130, 246, 0.6); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f3460 50%, #16213e 75%, #1a1a2e 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .neon-text {
            animation: neonPulse 3s ease-in-out infinite;
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .sidebar-active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(16, 185, 129, 0.2) 100%);
            border-left: 4px solid #10B981;
        }
        
        .notification-dot {
            animation: pulseGlow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-inter gradient-bg min-h-screen">
    
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 glass-effect shadow-2xl transform transition-transform duration-300 border-r border-white/20" id="sidebar">
        <!-- Logo Section -->
        <div class="flex items-center justify-center h-20 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-purple-400/20 animate-pulse"></div>
            <div class="flex items-center space-x-3 relative z-10">
                <div class="bg-white/20 backdrop-blur-lg p-3 rounded-xl shadow-lg border border-white/30 hover-lift">
                    <i class="fas fa-store text-white text-2xl animate-sparkle"></i>
                </div>
                <div class="text-white">
                    <h1 class="font-bold text-xl neon-text">VSN</h1>
                    <p class="text-xs text-blue-200">Shopkeeper Hub</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-8 px-4">
            <a href="{{ route('shopkeeper.dashboard') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.dashboard') ? 'sidebar-active' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('shopkeeper.analytics') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.analytics') ? 'sidebar-active' : '' }}">
                <i class="fas fa-chart-line mr-3"></i>
                <span>Analytics</span>
            </a>
            <a href="{{ route('shopkeeper.products') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.products') ? 'sidebar-active' : '' }}">
                <i class="fas fa-box mr-3"></i>
                <span>Products</span>
            </a>
            <a href="{{ route('shopkeeper.orders') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.orders') ? 'sidebar-active' : '' }}">
                <i class="fas fa-shopping-cart mr-3"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('shopkeeper.customers') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.customers') ? 'sidebar-active' : '' }}">
                <i class="fas fa-users mr-3"></i>
                <span>Customers</span>
            </a>
            <a href="{{ route('shopkeeper.settings') }}" class="sidebar-link w-full flex items-center px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 rounded-xl mb-2 {{ request()->routeIs('shopkeeper.settings') ? 'sidebar-active' : '' }}">
                <i class="fas fa-user mr-3"></i>
                <span>Profile</span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-vsn-accent to-orange-500 p-2 rounded-full">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-gray-400 text-xs">Shopkeeper</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 min-h-screen">
        <!-- Top Bar -->
        <header class="glass-effect border-b border-white/20 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 animate-pulse"></div>
            <div class="flex items-center justify-between px-8 py-6 relative z-10">
                <div class="animate-fade-up">
                    <h1 class="text-3xl font-bold text-white neon-text">@yield('page-title', 'Shopkeeper Dashboard')</h1>
                    <p class="text-blue-200 mt-1">@yield('page-subtitle', 'Manage your store and grow your business 🚀')</p>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="glass-effect rounded-xl px-6 py-3 border border-white/30 hover-lift">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt text-blue-300 animate-sparkle"></i>
                            <span class="text-white font-medium">{{ date('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="relative">
                        @include('components.order-notifications')
                    </div>
                    <div class="glass-effect rounded-xl p-3 border border-white/30 hover-lift">
                        <i class="fas fa-comments text-blue-300 text-xl cursor-pointer hover:text-white transition-colors" onclick="openChatModal()"></i>
                        <span class="notification-dot absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-6 bg-green-500/20 border border-green-500/30 text-green-300 px-6 py-4 rounded-xl backdrop-blur-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-500/20 border border-red-500/30 text-red-300 px-6 py-4 rounded-xl backdrop-blur-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 bg-red-500/20 border border-red-500/30 text-red-300 px-6 py-4 rounded-xl backdrop-blur-sm">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                    <div>
                        <p class="font-semibold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
