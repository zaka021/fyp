<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Virtual Shop Nest</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'sparkle': 'sparkle 3s ease-in-out infinite',
                        'slide-in': 'slideIn 1s ease-out',
                        'fade-up': 'fadeUp 1s ease-out',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                        'gradient-shift': 'gradientShift 15s ease infinite',
                        'neon-pulse': 'neonPulse 3s ease-in-out infinite',
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
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        
        .product-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .product-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #3b82f6, #10b981, #f59e0b, #ef4444);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .product-card:hover::before {
            opacity: 1;
        }
        
        .product-card:hover {
            transform: translateY(-15px) rotateX(5deg);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }
        
        .btn-futuristic {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-futuristic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-futuristic:hover::before {
            left: 100%;
        }
        
        .btn-futuristic:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }
        
        .nav-item {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .nav-active {
            background: linear-gradient(135deg, #059669, #10b981);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
        }
        
        .search-container {
            position: relative;
            overflow: hidden;
        }
        
        .search-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .search-container:focus-within::before {
            left: 100%;
        }
        
        .category-btn {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }
        
        .category-btn:hover,
        .category-btn.active {
            background: linear-gradient(135deg, #10b981, #059669);
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }
        
        .floating-elements {
            position: fixed;
            pointer-events: none;
            z-index: 0;
        }
        
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(26, 26, 46, 0.1), rgba(15, 52, 96, 0.1));
            animation: float 8s ease-in-out infinite;
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(26, 26, 46, 0.8) 0%, rgba(15, 52, 96, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        .cart-item {
            animation: slideIn 0.3s ease-out;
        }
        
        .hover-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .product-image {
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-image {
            transform: scale(1.08);
        }
        .nav-btn {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .nav-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.4);
        }
        .favorite-btn {
            transition: all 0.3s ease;
        }
        .favorite-btn:hover {
            transform: scale(1.15);
            color: #ec4899;
        }
        .cart-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .search-focus:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.3);
            border-color: rgba(34, 197, 94, 0.5);
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .cart-item {
            animation: slideIn 0.3s ease-out;
        }
        
        /* Enhanced button styles */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }
        
        /* Enhanced navigation */
        .nav-enhanced {
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Enhanced product cards */
        .product-card-enhanced {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .product-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .product-card-enhanced:hover::before {
            left: 100%;
        }
        
        .product-card-enhanced:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        /* Enhanced text styling */
        .text-glow {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
        
        .price-highlight {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: bold;
        }
        
        /* Enhanced icons */
        .icon-glow {
            filter: drop-shadow(0 0 5px rgba(59, 130, 246, 0.5));
            transition: all 0.3s ease;
        }
        
        .icon-glow:hover {
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.8));
            transform: scale(1.1);
        }
        
        /* Enhanced category filters */
        .category-filter {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .category-filter:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }
        
        .category-filter.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-color: transparent;
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen relative overflow-x-hidden">
    
    
    <!-- Navigation -->
    <nav class="nav-enhanced bg-white/10 backdrop-blur-lg border-b border-white/20 sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-18">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-shopping-bag text-white text-xl icon-glow"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl text-glow">VSN Customer</h1>
                        <p class="text-blue-200 text-sm">Local Shopping Hub</p>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Search Bar -->
                    <div class="relative hidden md:block">
                        <input type="text" id="search-input" placeholder="Search products..." 
                               class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 pl-12 text-white placeholder-blue-200 w-72 search-focus backdrop-blur-sm">
                        <i class="fas fa-search absolute left-4 top-4 text-blue-300 icon-glow"></i>
                    </div>
                    
                    <!-- Cart Icon -->
                    <button onclick="toggleCart()" class="relative p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-shopping-cart text-xl text-white icon-glow"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center cart-badge hidden shadow-lg">0</span>
                    </button>
                    
                    <!-- Favorites Icon -->
                    <button onclick="toggleFavorites()" class="relative p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-heart text-xl text-white icon-glow"></i>
                        <span id="favorites-count" class="absolute -top-2 -right-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center hidden shadow-lg">0</span>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button onclick="toggleProfileMenu()" class="flex items-center space-x-3 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm text-blue-300"></i>
                        </button>
                        <div id="profile-menu" class="hidden absolute right-0 mt-3 w-52 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 shadow-2xl overflow-hidden">
                            <a href="#" onclick="showSection('profile')" class="block px-5 py-4 text-white hover:bg-white/15 transition-all duration-200">
                                <i class="fas fa-user mr-3 text-blue-300"></i>Profile
                            </a>
                            <a href="#" onclick="showSection('orders')" class="block px-5 py-4 text-white hover:bg-white/15 transition-all duration-200">
                                <i class="fas fa-receipt mr-3 text-green-300"></i>My Orders
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-5 py-4 text-red-400 hover:bg-red-500/20 transition-all duration-200 border-t border-white/10">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        
        <!-- Messages -->
        @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/30 text-green-300 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-500/20 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        <!-- Welcome Section -->
        <div class="text-center mb-8 slide-in">
            <h2 class="text-4xl font-bold text-white mb-4 text-glow">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="text-blue-200 text-lg">Discover amazing local products and enjoy fast delivery</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button onclick="showSection('browse')" class="nav-btn btn-secondary text-white px-8 py-4 rounded-xl font-semibold shadow-lg">
                <i class="fas fa-store mr-2 icon-glow"></i>Browse Products
            </button>
            <button onclick="showSection('orders')" class="nav-btn bg-white/10 text-white px-8 py-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all backdrop-blur-sm">
                <i class="fas fa-receipt mr-2 icon-glow"></i>My Orders
            </button>
            <button onclick="showSection('favorites')" class="nav-btn bg-white/10 text-white px-8 py-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all backdrop-blur-sm">
                <i class="fas fa-heart mr-2 icon-glow"></i>Favorites
            </button>
            <button onclick="showSection('profile')" class="nav-btn bg-white/10 text-white px-8 py-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all backdrop-blur-sm">
                <i class="fas fa-user mr-2 icon-glow"></i>Profile
            </button>
        </div>

        <!-- Mobile Search -->
        <div class="md:hidden mb-6">
            <div class="relative">
                <input type="text" id="mobile-search" placeholder="Search products..." 
                       class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 pl-10 text-white placeholder-gray-400 search-focus">
                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
            </div>
        </div>

        <!-- Category Filters -->
        <div id="category-filters" class="flex flex-wrap gap-3 mb-8 slide-in">
            <button onclick="filterByCategory('all')" class="category-filter active bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-lg">
                <i class="fas fa-th-large mr-2"></i>All Products
            </button>
            <button onclick="filterByCategory('food')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-utensils mr-2 icon-glow"></i>🍽️ Food & Dining
            </button>
            <button onclick="filterByCategory('grocery')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-shopping-basket mr-2 icon-glow"></i>🛒 Grocery
            </button>
            <button onclick="filterByCategory('fashion')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-tshirt mr-2 icon-glow"></i>👕 Fashion
            </button>
            <button onclick="filterByCategory('electronics')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-laptop mr-2 icon-glow"></i>📱 Electronics
            </button>
            <button onclick="filterByCategory('pharmacy')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-pills mr-2 icon-glow"></i>💊 Pharmacy
            </button>
            <button onclick="filterByCategory('gifts')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-gift mr-2 icon-glow"></i>🎁 Gifts
            </button>
            <button onclick="filterByCategory('taxi')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-car mr-2 icon-glow"></i>🚗 Taxi
            </button>
            <button onclick="filterByCategory('beauty')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-spa mr-2 icon-glow"></i>💄 Beauty
            </button>
            <button onclick="filterByCategory('home')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-home mr-2 icon-glow"></i>🏠 Home
            </button>
            <button onclick="filterByCategory('sports')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-dumbbell mr-2 icon-glow"></i>⚽ Sports
            </button>
            <button onclick="filterByCategory('books')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-book mr-2 icon-glow"></i>📚 Books
            </button>
            <button onclick="filterByCategory('pets')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-paw mr-2 icon-glow"></i>🐕 Pets
            </button>
            <button onclick="filterByCategory('automotive')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-wrench mr-2 icon-glow"></i>🔧 Auto
            </button>
            <button onclick="filterByCategory('services')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-tools mr-2 icon-glow"></i>🛠️ Services
            </button>
            <button onclick="filterByCategory('education')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-graduation-cap mr-2 icon-glow"></i>🎓 Education
            </button>
            <button onclick="filterByCategory('travel')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-plane mr-2 icon-glow"></i>✈️ Travel
            </button>
            <button onclick="filterByCategory('entertainment')" class="category-filter bg-white/10 text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 hover:bg-white/20">
                <i class="fas fa-film mr-2 icon-glow"></i>🎬 Entertainment
            </button>
        </div>

        <!-- Browse Section -->
        <div id="browse-section" class="section-content">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-3xl font-bold text-white text-glow">
                    <i class="fas fa-shopping-bag mr-3 icon-glow"></i>Available Products
                </h3>
                <div class="flex items-center space-x-4">
                    <select id="sort-select" class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white text-sm backdrop-blur-sm hover:bg-white/15 transition-all">
                        <option value="name">Sort by Name</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="rating">Highest Rated</option>
                    </select>
                    <button onclick="toggleView()" class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white hover:bg-white/20 transition-all hover:scale-105">
                        <i id="view-icon" class="fas fa-th-large icon-glow"></i>
                    </button>
                </div>
            </div>
            
            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($products as $product)
                <div class="product-card-enhanced hover-card transition-all duration-300" data-category="{{ $product->category }}" data-name="{{ strtolower($product->name) }}" data-price="{{ $product->price }}">
                    <div class="relative overflow-hidden rounded-t-2xl">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-52 object-cover product-image">
                        @else
                            <div class="w-full h-52 bg-gradient-to-br from-gray-600 to-gray-700 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Favorite Button -->
                        <button onclick="toggleFavorite({{ $product->id }})" class="favorite-btn absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all shadow-lg">
                            <i class="fas fa-heart text-lg" id="fav-{{ $product->id }}"></i>
                        </button>
                        
                        <!-- Category Badge -->
                        <span class="absolute top-4 left-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                            {{ ucfirst($product->category) }}
                        </span>
                        
                        <!-- Stock Badge -->
                        @if($product->stock_quantity < 5)
                            <span class="absolute bottom-4 left-4 bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg animate-pulse">
                                Only {{ $product->stock_quantity }} left!
                            </span>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h4 class="text-white font-bold text-lg mb-2 text-glow">{{ $product->name }}</h4>
                        <p class="text-blue-200 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="price-highlight text-2xl font-bold">Rs {{ number_format($product->price, 2) }}</span>
                            <span class="text-blue-300 text-sm bg-white/10 px-3 py-1 rounded-full">
                                <i class="fas fa-box mr-1"></i>{{ $product->stock_quantity }} left
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-white text-sm font-bold">{{ substr($product->shopkeeper->name, 0, 1) }}</span>
                                </div>
                                <span class="text-blue-200 text-sm font-medium">{{ $product->shopkeeper->name }}</span>
                            </div>
                            <button onclick="chatWithShopkeeper({{ $product->shopkeeper->id }}, {{ $product->id }}, '{{ addslashes($product->name) }}')" class="p-2 bg-white/10 rounded-full text-blue-400 hover:text-blue-300 hover:bg-white/20 transition-all hover:scale-110">
                                <i class="fas fa-comment text-lg icon-glow"></i>
                            </button>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image_url }}')" class="flex-1 btn-secondary text-white py-3 px-4 rounded-xl font-medium">
                                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                            </button>
                            <button onclick="orderNow({{ $product->id }})" class="btn-primary text-white py-3 px-4 rounded-xl">
                                <i class="fas fa-bolt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <i class="fas fa-store-slash text-gray-500 text-6xl mb-6"></i>
                    <h3 class="text-white text-2xl font-bold mb-4">No Products Available</h3>
                    <p class="text-gray-400 text-lg">Check back later for amazing new products!</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Orders Section -->
        <div id="orders-section" class="section-content hidden">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-3xl font-bold text-white text-glow">
                    <i class="fas fa-receipt mr-3 icon-glow"></i>My Orders
                </h3>
                <div class="flex items-center space-x-4">
                    <select id="order-filter" class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white text-sm backdrop-blur-sm hover:bg-white/15 transition-all">
                        <option value="all">All Orders</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="preparing">Preparing</option>
                        <option value="out_for_delivery">Out for Delivery</option>
                        <option value="delivered">Delivered</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
            
            <div id="orders-grid" class="space-y-6">
                @forelse($orders as $order)
                <div class="order-item bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all" data-status="{{ $order->status }}">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-white font-bold text-lg">Order #{{ $order->id }}</h4>
                            <p class="text-gray-400 text-sm">{{ $order->created_at->format('M d, Y \\a\\t h:i A') }}</p>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-medium
                            @if($order->status === 'pending') bg-yellow-500/20 text-yellow-400
                            @elseif($order->status === 'accepted') bg-blue-500/20 text-blue-400
                            @elseif($order->status === 'confirmed') bg-blue-500/20 text-blue-400
                            @elseif($order->status === 'preparing') bg-purple-500/20 text-purple-400
                            @elseif($order->status === 'out_for_delivery') bg-orange-500/20 text-orange-400
                            @elseif($order->status === 'delivered') bg-green-500/20 text-green-400
                            @elseif($order->status === 'completed') bg-emerald-500/20 text-emerald-400
                            @else bg-red-500/20 text-red-400
                            @endif">
                            {{ $order->status === 'completed' ? 'Order Completed' : ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-4">
                        @if($order->product->image_url)
                            <img src="{{ $order->product->image_url }}" alt="{{ $order->product->name }}" class="w-16 h-16 object-cover rounded-xl">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center">
                                <i class="fas fa-box text-gray-400 text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h5 class="text-white font-semibold text-lg">{{ $order->product->name }}</h5>
                            <p class="text-gray-400 text-sm">Quantity: {{ $order->quantity }} • By {{ $order->product->shopkeeper->name }}</p>
                            @if($order->delivery_address)
                                <p class="text-gray-400 text-sm mt-1"><i class="fas fa-map-marker-alt mr-1"></i>{{ Str::limit($order->delivery_address, 50) }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-green-400 font-bold text-xl">Rs {{ number_format($order->total_amount) }}</p>
                        </div>
                    </div>
                    
                    <!-- Order Progress -->
                    @if($order->status !== 'cancelled')
                    <div class="mt-4 mb-4">
                        <div class="flex items-center justify-between text-sm text-gray-400 mb-2">
                            <span>Order Progress</span>
                            <span>{{ $order->status === 'completed' ? '100' : ($order->status === 'delivered' ? '95' : ($order->status === 'out_for_delivery' ? '80' : ($order->status === 'preparing' ? '60' : ($order->status === 'confirmed' ? '40' : ($order->status === 'accepted' ? '30' : '20'))))) }}%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-2 rounded-full transition-all duration-500" 
                                 style="width: {{ $order->status === 'completed' ? '100' : ($order->status === 'delivered' ? '95' : ($order->status === 'out_for_delivery' ? '80' : ($order->status === 'preparing' ? '60' : ($order->status === 'confirmed' ? '40' : ($order->status === 'accepted' ? '30' : '20'))))) }}%"></div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Customer Feedback Display -->
                    @if($order->rating && $order->feedback)
                    <div class="mt-4 mb-4 bg-white/5 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h6 class="text-white font-semibold">Your Feedback</h6>
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $order->rating ? 'text-yellow-400' : 'text-gray-600' }}"></i>
                                @endfor
                                <span class="text-yellow-400 ml-2 font-semibold">{{ $order->rating }}/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm">{{ $order->feedback }}</p>
                        <p class="text-gray-500 text-xs mt-2">Submitted {{ $order->feedback_at->diffForHumans() }}</p>
                    </div>
                    @endif
                    
                    <!-- Order Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-white/20">
                        <div class="flex space-x-3">
                            @if($order->status === 'pending')
                                <button onclick="cancelOrder({{ $order->id }})" class="bg-red-500/20 text-red-400 hover:bg-red-500/30 px-4 py-2 rounded-xl text-sm font-medium transition-all">
                                    <i class="fas fa-times mr-2"></i>Cancel Order
                                </button>
                            @endif
                            
                            @if($order->status === 'out_for_delivery')
                                <button onclick="trackOrder({{ $order->id }})" class="bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 px-4 py-2 rounded-xl text-sm font-medium transition-all">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Live Tracking
                                </button>
                            @endif
                            
                            @if($order->status === 'out_for_delivery')
                                <button onclick="markOrderReceived({{ $order->id }})" class="bg-green-500/20 text-green-400 hover:bg-green-500/30 px-4 py-2 rounded-xl text-sm font-medium transition-all">
                                    <i class="fas fa-check mr-2"></i>Order Received
                                </button>
                            @endif
                            
                            @if($order->status === 'delivered' && !$order->rating)
                                <button onclick="showFeedbackModal({{ $order->id }}, '{{ addslashes($order->product->name) }}')" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500/30 px-4 py-2 rounded-xl text-sm font-medium transition-all">
                                    <i class="fas fa-star mr-2"></i>Rate Order
                                </button>
                            @endif
                        </div>
                        
                        <div class="flex space-x-2">
                            <button onclick="chatWithShopkeeper({{ $order->product->shopkeeper->id }}, {{ $order->product->id }}, '{{ addslashes($order->product->name) }}')" class="p-2 bg-white/10 rounded-full text-blue-400 hover:text-blue-300 hover:bg-white/20 transition-all hover:scale-110">
                                <i class="fas fa-comment text-lg"></i>
                            </button>
                            @if($order->status === 'delivered')
                                <button onclick="reorderProduct({{ $order->product->id }})" class="p-2 bg-white/10 rounded-full text-green-400 hover:text-green-300 hover:bg-white/20 transition-all hover:scale-110">
                                    <i class="fas fa-redo text-lg"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <i class="fas fa-receipt text-gray-500 text-6xl mb-6"></i>
                    <h3 class="text-white text-2xl font-bold mb-4">No Orders Yet</h3>
                    <p class="text-gray-400 text-lg">Start shopping to see your orders here!</p>
                    <button onclick="showSection('browse')" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl font-semibold mt-4 hover:shadow-lg transition-all">
                        Start Shopping
                    </button>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Favorites Section -->
        <div id="favorites-section" class="section-content hidden">
            <h3 class="text-2xl font-bold text-white mb-6">My Favorites</h3>
            <div id="favorites-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Favorites will be populated by JavaScript -->
            </div>
            <div id="no-favorites" class="text-center py-16">
                <i class="fas fa-heart text-gray-500 text-6xl mb-6"></i>
                <h3 class="text-white text-2xl font-bold mb-4">No Favorites Yet</h3>
                <p class="text-gray-400 text-lg">Start adding products to your favorites!</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile-section" class="section-content hidden">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-white mb-8">My Profile</h3>
                
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <div class="flex items-center space-x-6 mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-white text-xl font-bold">{{ Auth::user()->name }}</h4>
                            <p class="text-gray-400">{{ Auth::user()->email }}</p>
                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm mt-2 inline-block">Active Customer</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-shopping-cart text-blue-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-xl">{{ $orders->count() }}</p>
                            <p class="text-gray-400 text-sm">Total Orders</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-heart text-pink-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-xl" id="profile-favorites-count">0</p>
                            <p class="text-gray-400 text-sm">Favorites</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-rupee-sign text-green-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-xl">Rs {{ number_format($orders->sum('total_amount')) }}</p>
                            <p class="text-gray-400 text-sm">Total Spent</p>
                        </div>
                    </div>

        </div>
    </main>

    <!-- Shopping Cart Sidebar -->
    <div id="cart-sidebar" class="hidden fixed inset-y-0 right-0 w-96 bg-white/10 backdrop-blur-lg border-l border-white/20 z-50 transform translate-x-full transition-transform duration-300">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-6 border-b border-white/20">
                <h3 class="text-white text-xl font-bold">Shopping Cart</h3>
                <button onclick="toggleCart()" class="text-white hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div id="cart-items" class="flex-1 overflow-y-auto p-6 space-y-4">
                <!-- Cart items will be populated by JavaScript -->
            </div>
            
            <div id="cart-empty" class="flex-1 flex items-center justify-center text-center p-6">
                <div>
                    <i class="fas fa-shopping-cart text-gray-500 text-4xl mb-4"></i>
                    <h4 class="text-white text-lg font-bold mb-2">Your cart is empty</h4>
                    <p class="text-gray-400">Add some products to get started!</p>
                </div>
            </div>
            
            <div id="cart-footer" class="hidden p-6 border-t border-white/20">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-300">Subtotal:</span>
                        <span id="cart-subtotal" class="text-white font-medium">Rs 0</span>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-300">Delivery:</span>
                        <span class="text-green-400 font-medium">Free</span>
                    </div>
                    <div class="border-t border-white/20 pt-2">
                        <div class="flex items-center justify-between">
                            <span class="text-white font-bold text-lg">Total:</span>
                            <span id="cart-total" class="text-green-400 font-bold text-xl">Rs 0</span>
                        </div>
                    </div>
                </div>
                <button onclick="proceedToCheckout()" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all">
                    <i class="fas fa-shopping-bag mr-2"></i>Place Order
                </button>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div id="checkout-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-white text-2xl font-bold">Complete Your Order</h3>
                <button onclick="hideCheckoutModal()" class="text-white hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form method="POST" action="/orders/bulk" id="checkout-form">
                @csrf
                <div class="mb-6">
                    <h4 class="text-white font-bold mb-4">Order Summary</h4>
                    <div id="checkout-items" class="space-y-3 mb-4 max-h-32 overflow-y-auto">
                        <!-- Items will be populated by JavaScript -->
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-white/20">
                        <span class="text-white font-bold text-lg">Total:</span>
                        <span id="checkout-total" class="text-green-400 font-bold text-xl">Rs 0</span>
                    </div>
                </div>
                
                <input type="hidden" name="cart_data" id="cart-data">
                
                <!-- Customer Information -->
                <div class="mb-6">
                    <h4 class="text-white font-bold mb-4">Customer Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-300 text-sm mb-2">Full Name *</label>
                            <input type="text" name="customer_name" value="{{ Auth::user()->name }}" required
                                   class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label class="block text-gray-300 text-sm mb-2">Email Address *</label>
                            <input type="email" name="customer_email" value="{{ Auth::user()->email }}" required
                                   class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white"
                                   placeholder="Your email address">
                        </div>
                    </div>
                </div>
                
                <!-- Delivery Information -->
                <div class="mb-6">
                    <h4 class="text-white font-bold mb-4">Delivery Information</h4>
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm mb-2">Phone Number *</label>
                        <input type="tel" name="customer_phone" required
                               class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white"
                               placeholder="Your phone number (e.g., +92 300 1234567)">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm mb-2">Complete Delivery Address *</label>
                        <textarea name="delivery_address" required rows="3"
                                  class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white"
                                  placeholder="House/Flat No, Street, Area, City, Postal Code"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 text-sm mb-2">Delivery Instructions (Optional)</label>
                        <textarea name="notes" rows="2"
                                  class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white"
                                  placeholder="Any special delivery instructions, landmarks, or notes"></textarea>
                    </div>
                </div>
                
                <!-- Order Actions -->
                <div class="flex space-x-3">
                    <button type="submit" id="place-order-btn" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all">
                        <i class="fas fa-shopping-bag mr-2"></i>Place Order
                    </button>
                    <button type="button" onclick="hideCheckoutModal()" class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Order Modal -->
    <div id="order-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 max-w-md w-full mx-4">
            <h3 class="text-white text-xl font-bold mb-4">Place Order</h3>
    </div>

    <script>
        // Global variables
        let cart = [];
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            updateCartUI();
            updateFavoritesUI();
            loadFavorites();
            
            // Search functionality
            const searchInput = document.getElementById('search-input');
            const mobileSearch = document.getElementById('mobile-search');
            if (searchInput) searchInput.addEventListener('input', handleSearch);
            if (mobileSearch) mobileSearch.addEventListener('input', handleSearch);
        });
        
        // Section management
        function showSection(sectionName) {
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });
            
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'shadow-lg');
                btn.classList.add('bg-white/10');
            });
            
            const targetSection = document.getElementById(sectionName + '-section');
            if (targetSection) targetSection.classList.remove('hidden');
            
            if (event && event.target) {
                event.target.classList.remove('bg-white/10');
                event.target.classList.add('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'shadow-lg');
            }
            
            if (sectionName === 'favorites') displayFavorites();
            if (sectionName === 'orders') {
                // Reset order filter when showing orders section
                const orderFilter = document.getElementById('order-filter');
                if (orderFilter) orderFilter.value = 'all';
            }
        }
        
        // Cart functionality
        function addToCart(productId, productName, productPrice, productImage) {
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                });
            }
            
            updateCartUI();
            showToast('Product added to cart!', 'success');
        }
        
        function updateCartUI() {
            const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartTotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            const cartCountEl = document.getElementById('cart-count');
            const floatingCartCount = document.getElementById('floating-cart-count');
            const cartTotalEl = document.getElementById('cart-total');
            const cartSubtotalEl = document.getElementById('cart-subtotal');
            const cartFooter = document.getElementById('cart-footer');
            const cartEmpty = document.getElementById('cart-empty');
            
            if (cartCountEl) {
                cartCountEl.textContent = cartCount;
                cartCountEl.classList.toggle('hidden', cartCount === 0);
            }
            if (floatingCartCount) {
                floatingCartCount.textContent = cartCount;
                floatingCartCount.classList.toggle('hidden', cartCount === 0);
            }
            if (cartTotalEl) {
                cartTotalEl.textContent = 'Rs ' + cartTotal.toLocaleString();
            }
            if (cartSubtotalEl) {
                cartSubtotalEl.textContent = 'Rs ' + cartTotal.toLocaleString();
            }
            if (cartFooter && cartEmpty) {
                cartFooter.classList.toggle('hidden', cart.length === 0);
                cartEmpty.classList.toggle('hidden', cart.length > 0);
            }
        }
        
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartUI();
            displayCartItems();
            showToast('Item removed from cart', 'info');
        }
        
        function updateCartQuantity(productId, quantity) {
            const item = cart.find(item => item.id === productId);
            if (item && quantity > 0) {
                item.quantity = quantity;
                updateCartUI();
                displayCartItems();
            }
        }
        
        function toggleCart() {
            const cartSidebar = document.getElementById('cart-sidebar');
            const isHidden = cartSidebar.classList.contains('hidden');
            
            if (isHidden) {
                cartSidebar.classList.remove('hidden');
                setTimeout(() => {
                    cartSidebar.classList.remove('translate-x-full');
                }, 10);
                displayCartItems();
            } else {
                cartSidebar.classList.add('translate-x-full');
                setTimeout(() => {
                    cartSidebar.classList.add('hidden');
                }, 300);
            }
        }
        
        function displayCartItems() {
            const cartItemsContainer = document.getElementById('cart-items');
            if (!cartItemsContainer) return;
            
            cartItemsContainer.innerHTML = '';
            
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item bg-white/5 rounded-xl p-4 border border-white/10';
                cartItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-600 rounded-lg flex items-center justify-center overflow-hidden">
                            ${item.image ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">` : '<i class="fas fa-image text-gray-400"></i>'}
                        </div>
                        <div class="flex-1">
                            <h5 class="text-white font-semibold text-sm">${item.name}</h5>
                            <p class="text-green-400 font-bold">Rs ${item.price.toLocaleString()}</p>
                            <p class="text-gray-400 text-xs">Total: Rs ${(item.price * item.quantity).toLocaleString()}</p>
                        </div>
                        <div class="flex flex-col items-center space-y-2">
                            <div class="flex items-center space-x-2">
                                <button onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-all">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="text-white font-bold w-8 text-center">${item.quantity}</span>
                                <button onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-all">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                            <button onclick="removeFromCart(${item.id})" class="text-red-400 hover:text-red-300 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });
        }
        
        // Favorites functionality
        function toggleFavorite(productId) {
            const index = favorites.indexOf(productId);
            const heartIcon = document.getElementById(`fav-${productId}`);
            
            if (index > -1) {
                favorites.splice(index, 1);
                heartIcon.classList.remove('text-pink-500');
                heartIcon.classList.add('text-white');
                showToast('Removed from favorites', 'info');
            } else {
                favorites.push(productId);
                heartIcon.classList.remove('text-white');
                heartIcon.classList.add('text-pink-500');
                showToast('Added to favorites!', 'success');
            }
            
            localStorage.setItem('favorites', JSON.stringify(favorites));
            updateFavoritesUI();
        }
        
        function updateFavoritesUI() {
            const favoritesCount = favorites.length;
            const favoritesCountEl = document.getElementById('favorites-count');
            const profileFavoritesCount = document.getElementById('profile-favorites-count');
            
            if (favoritesCountEl) {
                favoritesCountEl.textContent = favoritesCount;
                favoritesCountEl.classList.toggle('hidden', favoritesCount === 0);
            }
            if (profileFavoritesCount) {
                profileFavoritesCount.textContent = favoritesCount;
            }
        }
        
        function loadFavorites() {
            favorites.forEach(productId => {
                const heartIcon = document.getElementById(`fav-${productId}`);
                if (heartIcon) {
                    heartIcon.classList.remove('text-white');
                    heartIcon.classList.add('text-pink-500');
                }
            });
        }
        
        function toggleFavorites() {
            showSection('favorites');
        }
        
        function displayFavorites() {
            const favoritesGrid = document.getElementById('favorites-grid');
            const noFavorites = document.getElementById('no-favorites');
            
            if (!favoritesGrid || !noFavorites) return;
            
            if (favorites.length === 0) {
                noFavorites.classList.remove('hidden');
                favoritesGrid.classList.add('hidden');
            } else {
                noFavorites.classList.add('hidden');
                favoritesGrid.classList.remove('hidden');
                // Populate favorites grid with favorite products
            }
        }
        
        // Search and filter functionality
        function handleSearch(event) {
            const searchTerm = event.target.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach(card => {
                const productName = card.dataset.name;
                const isVisible = productName.includes(searchTerm);
                card.style.display = isVisible ? 'block' : 'none';
            });
        }
        
        function filterByCategory(category) {
            const productCards = document.querySelectorAll('.product-card');
            const categoryButtons = document.querySelectorAll('.category-filter');
            
            categoryButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-green-500', 'to-emerald-600');
                btn.classList.add('bg-white/10');
            });
            
            event.target.classList.remove('bg-white/10');
            event.target.classList.add('active', 'bg-gradient-to-r', 'from-green-500', 'to-emerald-600');
            
            productCards.forEach(card => {
                const productCategory = card.dataset.category;
                const isVisible = category === 'all' || productCategory === category;
                card.style.display = isVisible ? 'block' : 'none';
            });
        }
        
        function proceedToCheckout() {
            if (cart.length === 0) {
                showToast('Your cart is empty!', 'error');
                return;
            }
            
            toggleCart(); // Close cart
            
            // Populate checkout modal
            const checkoutItems = document.getElementById('checkout-items');
            const checkoutTotal = document.getElementById('checkout-total');
            
            if (checkoutItems && checkoutTotal) {
                checkoutItems.innerHTML = '';
                let total = 0;
                
                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    const checkoutItem = document.createElement('div');
                    checkoutItem.className = 'flex items-center justify-between text-sm py-2';
                    checkoutItem.innerHTML = `
                        <span class="text-white">${item.name} x ${item.quantity}</span>
                        <span class="text-green-400 font-bold">Rs ${itemTotal.toLocaleString()}</span>
                    `;
                    checkoutItems.appendChild(checkoutItem);
                });
                
                checkoutTotal.textContent = 'Rs ' + total.toLocaleString();
            }
            
            // Show checkout modal
            document.getElementById('checkout-modal').classList.remove('hidden');
        }
        
        function hideCheckoutModal() {
            document.getElementById('checkout-modal').classList.add('hidden');
        }
        
        function showQuickView(productId) {
            showToast('Quick view coming soon!', 'info');
        }
        
        function toggleProfileMenu() {
            const profileMenu = document.getElementById('profile-menu');
            profileMenu.classList.toggle('hidden');
        }
        
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-xl text-white font-medium ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 3000);
        }
        
        // Checkout form submission
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutForm = document.getElementById('checkout-form');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    if (cart.length === 0) {
                        showToast('Your cart is empty!', 'error');
                        return;
                    }
                    
                    const customerName = this.querySelector('input[name="customer_name"]').value.trim();
                    const customerEmail = this.querySelector('input[name="customer_email"]').value.trim();
                    const deliveryAddress = this.querySelector('textarea[name="delivery_address"]').value.trim();
                    const customerPhone = this.querySelector('input[name="customer_phone"]').value.trim();
                    
                    if (!customerName) {
                        showToast('Please enter your name!', 'error');
                        return;
                    }
                    
                    if (!customerEmail) {
                        showToast('Please enter your email!', 'error');
                        return;
                    }
                    
                    if (!deliveryAddress) {
                        showToast('Please enter delivery address!', 'error');
                        return;
                    }
                    
                    if (!customerPhone) {
                        showToast('Please enter phone number!', 'error');
                        return;
                    }
                    
                    // Prepare cart data for submission
                    document.getElementById('cart-data').value = JSON.stringify(cart);
                    
                    // Show loading state
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Placing Order...';
                    submitBtn.disabled = true;
                    
                    // Submit the form normally (this will redirect and show success/error messages)
                    this.submit();
                });
            }
        });

        // Chat with shopkeeper function
        function chatWithShopkeeper(shopkeeperId, productId, productName) {
            console.log('Chat button clicked:', { shopkeeperId, productId, productName });
            
            // Always create a fresh modal
            createCustomerChatModal();
            
            // Set current chat details
            window.currentShopkeeperId = shopkeeperId;
            window.currentProductId = productId;
            
            // Get the modal
            const customerChatModal = document.getElementById('customerChatModal');
            if (!customerChatModal) {
                console.error('Failed to find chat modal after creation');
                alert('Failed to open chat. Please try again.');
                return;
            }
            
            console.log('Showing chat modal...');
            
            // Show modal immediately
            customerChatModal.classList.remove('hidden');
            customerChatModal.style.display = 'flex';
            
            // Update header
            const headerElement = document.getElementById('customerChatHeader');
            if (headerElement) {
                headerElement.innerHTML = `
                    <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Chat about: ${productName}</h3>
                                <p class="text-sm text-gray-600">Ask questions about this product</p>
                            </div>
                        </div>
                        <button onclick="closeCustomerChat()" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                `;
            }
            
            console.log('Chat modal should now be visible');
        }

        function createCustomerChatModal() {
            console.log('Creating customer chat modal...');
            
            // Remove existing modal if it exists
            const existingModal = document.getElementById('customerChatModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            const modalHTML = `
            <!-- Customer Chat Modal -->
            <div id="customerChatModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
                <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-hidden transform transition-all duration-300">
                    <div class="flex flex-col h-[70vh]">
                        <div id="customerChatHeader" class="p-4 border-b border-gray-200 bg-white">
                            <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900" id="chatShopkeeperName">Chat</h3>
                                        <p class="text-sm text-gray-600">Ask questions about this product</p>
                                    </div>
                                </div>
                                <button onclick="closeCustomerChat()" class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>
                        <div id="customerChatMessages" class="flex-1 overflow-y-auto p-4 bg-gray-50">
                            <div class="flex items-center justify-center h-full text-gray-500">
                                <div class="text-center">
                                    <i class="fas fa-comments text-4xl mb-4"></i>
                                    <p>Start a conversation with the shopkeeper</p>
                                    <p class="text-sm mt-2">Ask questions about products, delivery, or anything else</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-t border-gray-200 bg-white">
                            <div class="flex space-x-3">
                                <input type="text" id="customerMessageInput" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onkeypress="if(event.key==='Enter') sendCustomerMessage()">
                                <button onclick="sendCustomerMessage()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            console.log('Modal HTML added to body');
            
            // Verify modal was created
            const createdModal = document.getElementById('customerChatModal');
            if (createdModal) {
                console.log('Modal successfully created');
            } else {
                console.error('Failed to create modal');
            }
        }

        function closeCustomerChatOld() {
            const customerChatModal = document.getElementById('customerChatModal');
            if (customerChatModal) {
                customerChatModal.classList.add('hidden');
            }
        }

        function loadCustomerConversation(shopkeeperId) {
            // For now, show empty conversation - in real implementation, fetch from backend
            document.getElementById('customerChatMessages').innerHTML = `
                <div class="flex items-center justify-center h-full text-gray-500">
                    <div class="text-center">
                        <i class="fas fa-comment-dots text-4xl mb-4"></i>
                        <p>Start a conversation with the shopkeeper</p>
                        <p class="text-sm">Ask questions about products, delivery, or anything else</p>
                    </div>
                </div>
            `;
        }

        function sendCustomerMessage() {
            const messageInput = document.getElementById('customerMessageInput');
            const message = messageInput.value.trim();
            
            if (!message) {
                showToast('Please enter a message', 'error');
                return;
            }
            
            if (!window.currentShopkeeperId) {
                showToast('Shopkeeper not selected', 'error');
                return;
            }
            
            console.log('Sending message:', {
                shopkeeper_id: window.currentShopkeeperId,
                product_id: window.currentProductId,
                message: message
            });
            
            // Show loading state
            const sendBtn = document.querySelector('#customerChatModal button[onclick="sendCustomerMessage()"]');
            const originalText = sendBtn.innerHTML;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            sendBtn.disabled = true;
            
            // Send message to backend
            fetch('/chats/send-customer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    shopkeeper_id: window.currentShopkeeperId,
                    product_id: window.currentProductId,
                    message: message
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                
                // Reset button
                sendBtn.innerHTML = originalText;
                sendBtn.disabled = false;
                
                if (data.success) {
                    // Add message to chat immediately
                    const chatMessages = document.getElementById('customerChatMessages');
                    
                    // If this is the first message, clear the placeholder
                    if (chatMessages.innerHTML.includes('Start a conversation')) {
                        chatMessages.innerHTML = '';
                    }
                    
                    const messageHTML = `
                        <div class="flex justify-end mb-4">
                            <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-blue-500 text-white">
                                <p class="text-sm">${message}</p>
                                <p class="text-xs mt-1 text-blue-100">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                            </div>
                        </div>
                    `;
                    
                    chatMessages.insertAdjacentHTML('beforeend', messageHTML);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    
                    // Clear input
                    messageInput.value = '';
                    
                    showToast('Message sent to shopkeeper!', 'success');
                } else {
                    showToast(data.message || 'Failed to send message', 'error');
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                
                // Reset button
                sendBtn.innerHTML = originalText;
                sendBtn.disabled = false;
                
                showToast('Network error - please try again', 'error');
            });
        }

        function closeCustomerChat() {
            const modal = document.getElementById('customerChatModal');
            modal.classList.add('hidden');
            
            // Reset modal state
            window.currentShopkeeperId = null;
            window.currentProductId = null;
            
            // Clear input
            const messageInput = document.getElementById('customerMessageInput');
            if (messageInput) {
                messageInput.value = '';
            }
        }
        
        // Order management functions
        function markOrderReceived(orderId) {
            if (!confirm('Are you sure you want to mark this order as received?')) {
                return;
            }
            
            fetch(`/orders/${orderId}/received`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Order marked as received! Shopkeeper has been notified.', 'success');
                    // Refresh the page to update order status
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to update order status', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Network error - please try again', 'error');
            });
        }
        
        function trackOrder(orderId) {
            // Create tracking modal
            const trackingModal = document.createElement('div');
            trackingModal.id = 'tracking-modal';
            trackingModal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center';
            trackingModal.innerHTML = `
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-white text-2xl font-bold">Live Order Tracking</h3>
                        <button onclick="closeTrackingModal()" class="text-white hover:text-gray-300">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-white font-bold mb-4">Order #${orderId} Status</h4>
                        <div class="bg-white/5 rounded-xl p-4">
                            <div class="flex items-center justify-center h-96 bg-gray-800 rounded-xl">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt text-blue-400 text-6xl mb-4"></i>
                                    <h5 class="text-white text-xl font-bold mb-2">Live Tracking Map</h5>
                                    <p class="text-gray-400 mb-4">Your delivery is on the way!</p>
                                    <div class="flex items-center justify-center space-x-4 mb-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                            <span class="text-green-400 text-sm">Delivery Boy: Active</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                                            <span class="text-blue-400 text-sm">ETA: 15-20 mins</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-500 text-sm">Map integration coming soon...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-motorcycle text-blue-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold">On the Way</p>
                            <p class="text-gray-400 text-sm">Delivery in progress</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-clock text-orange-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold">15-20 mins</p>
                            <p class="text-gray-400 text-sm">Estimated arrival</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center">
                            <i class="fas fa-phone text-green-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold">Contact</p>
                            <p class="text-gray-400 text-sm">Call delivery boy</p>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button onclick="callDeliveryBoy()" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all">
                            <i class="fas fa-phone mr-2"></i>Call Delivery Boy
                        </button>
                        <button onclick="closeTrackingModal()" class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all">
                            Close
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(trackingModal);
        }
        
        function closeTrackingModal() {
            const modal = document.getElementById('tracking-modal');
            if (modal) {
                modal.remove();
            }
        }
        
        function callDeliveryBoy() {
            showToast('Connecting you with delivery boy...', 'info');
            // In a real implementation, this would initiate a call
            setTimeout(() => {
                showToast('Feature coming soon - SMS sent to delivery boy', 'success');
            }, 2000);
        }
        
        function cancelOrder(orderId) {
            if (!confirm('Are you sure you want to cancel this order?')) {
                return;
            }
            
            fetch(`/orders/${orderId}/cancel-customer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Order cancelled successfully', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to cancel order', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Network error - please try again', 'error');
            });
        }
        
        function reorderProduct(productId) {
            addToCart(productId);
            showToast('Product added to cart for reorder!', 'success');
        }
        
        function markOrderReceived(orderId) {
            if (!confirm('Confirm that you have received this order?')) {
                return;
            }
            
            fetch(`/orders/${orderId}/received`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Order marked as received! Revenue added to shopkeeper.', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to update order', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Network error - please try again', 'error');
            });
        }
        
        function showFeedbackModal(orderId, productName) {
            const modal = document.createElement('div');
            modal.id = 'feedback-modal';
            modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 max-w-md w-full mx-4">
                    <div class="text-center mb-6">
                        <i class="fas fa-star text-yellow-400 text-4xl mb-4"></i>
                        <h3 class="text-white text-2xl font-bold mb-2">Rate Your Order</h3>
                        <p class="text-gray-300">How was your experience with <strong>${productName}</strong>?</p>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-3">Rating</label>
                        <div class="flex justify-center space-x-2 mb-4">
                            ${[1,2,3,4,5].map(i => `
                                <button onclick="setRating(${i})" class="rating-star text-3xl text-gray-600 hover:text-yellow-400 transition-all" data-rating="${i}">
                                    <i class="fas fa-star"></i>
                                </button>
                            `).join('')}
                        </div>
                        <input type="hidden" id="selected-rating" value="0">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-white font-semibold mb-3">Feedback (Optional)</label>
                        <textarea id="feedback-text" rows="4" placeholder="Share your experience..." 
                                  class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 resize-none"></textarea>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button onclick="submitFeedback(${orderId})" class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Feedback
                        </button>
                        <button onclick="closeFeedbackModal()" class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all">
                            Cancel
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
        }
        
        function setRating(rating) {
            document.getElementById('selected-rating').value = rating;
            const stars = document.querySelectorAll('.rating-star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-600');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-600');
                }
            });
        }
        
        function submitFeedback(orderId) {
            const rating = document.getElementById('selected-rating').value;
            const feedback = document.getElementById('feedback-text').value;
            
            if (rating == 0) {
                showToast('Please select a rating', 'error');
                return;
            }
            
            fetch(`/orders/${orderId}/feedback`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    rating: rating,
                    feedback: feedback
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Thank you for your feedback!', 'success');
                    closeFeedbackModal();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to submit feedback', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Network error - please try again', 'error');
            });
        }
        
        function closeFeedbackModal() {
            const modal = document.getElementById('feedback-modal');
            if (modal) {
                modal.remove();
            }
        }
        
        // Order filtering
        document.addEventListener('DOMContentLoaded', function() {
            const orderFilter = document.getElementById('order-filter');
            if (orderFilter) {
                orderFilter.addEventListener('change', function() {
                    const selectedStatus = this.value;
                    const orderItems = document.querySelectorAll('.order-item');
                    
                    orderItems.forEach(item => {
                        const orderStatus = item.dataset.status;
                        if (selectedStatus === 'all' || orderStatus === selectedStatus) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        });

        // Chat functionality
        function chatWithShopkeeper(shopkeeperId, productId, productName) {
            // Create and show chat modal
            if (!document.getElementById('customerChatModal')) {
                createCustomerChatModal();
            }
            
            // Set current chat details
            window.currentShopkeeperId = shopkeeperId;
            window.currentProductId = productId;
            window.currentProductName = productName;
            
            // Show modal
            document.getElementById('customerChatModal').classList.remove('hidden');
            
            // Load existing messages
            loadChatMessages(shopkeeperId);
        }

        function createCustomerChatModal() {
            const modalHTML = `
            <!-- Customer Chat Modal -->
            <div id="customerChatModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl h-[70vh] flex flex-col overflow-hidden">
                        <!-- Chat Header -->
                        <div class="bg-green-600 text-white p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div>
                                    <h4 id="chatShopkeeperName" class="font-semibold">Shopkeeper</h4>
                                    <p id="chatProductName" class="text-sm text-green-100">Product Chat</p>
                                </div>
                            </div>
                            <button onclick="closeCustomerChatModal()" class="text-white hover:text-gray-200">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Messages Container -->
                        <div id="customerChatMessages" class="flex-1 overflow-y-auto p-4 bg-gray-50">
                            <div class="flex items-center justify-center h-full text-gray-500">
                                <div class="text-center">
                                    <i class="fas fa-comments text-4xl mb-4"></i>
                                    <p>Start a conversation with the shopkeeper</p>
                                    <p class="text-sm mt-2">Ask questions about products, delivery, or anything else</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Message Input -->
                        <div class="bg-white p-4 border-t">
                            <form id="customerSendMessageForm" class="flex items-center space-x-3">
                                <div class="flex-1 relative">
                                    <input type="text" id="customerMessageText" placeholder="Type your message..." class="w-full px-4 py-3 bg-gray-100 rounded-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500" required>
                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-smile"></i>
                                    </button>
                                </div>
                                <button type="submit" class="bg-green-500 text-white p-3 rounded-full hover:bg-green-600 transition-colors">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            // Add event listener for message form
            document.getElementById('customerSendMessageForm').addEventListener('submit', function(e) {
                e.preventDefault();
                sendCustomerMessage();
            });
        }

        function closeCustomerChatModal() {
            const modal = document.getElementById('customerChatModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function loadChatMessages(shopkeeperId) {
            // Update header with shopkeeper info
            fetch(`/chats/${shopkeeperId}`)
                .then(response => response.json())
                .then(messages => {
                    const messagesContainer = document.getElementById('customerChatMessages');
                    
                    if (messages.length === 0) {
                        messagesContainer.innerHTML = `
                            <div class="flex items-center justify-center h-full text-gray-500">
                                <div class="text-center">
                                    <i class="fas fa-comment-dots text-4xl mb-4"></i>
                                    <p>No messages yet</p>
                                    <p class="text-sm">Start the conversation!</p>
                                </div>
                            </div>
                        `;
                    } else {
                        const messagesHTML = messages.map(msg => `
                            <div class="flex ${msg.sender_type === 'customer' ? 'justify-end' : 'justify-start'} mb-3">
                                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                                    msg.sender_type === 'customer' 
                                    ? 'bg-green-500 text-white rounded-br-none' 
                                    : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none'
                                }">
                                    <p class="text-sm">${msg.message}</p>
                                    ${msg.product ? `<div class="text-xs mt-1 ${msg.sender_type === 'customer' ? 'text-green-100' : 'text-gray-500'}">
                                        <i class="fas fa-box mr-1"></i>About: ${msg.product.name}
                                    </div>` : ''}
                                    <p class="text-xs mt-1 ${msg.sender_type === 'customer' ? 'text-green-100' : 'text-gray-500'}">
                                        ${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                                    </p>
                                </div>
                            </div>
                        `).join('');
                        
                        messagesContainer.innerHTML = messagesHTML;
                    }
                    
                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                    document.getElementById('customerChatMessages').innerHTML = `
                        <div class="flex items-center justify-center h-full text-red-500">
                            <div class="text-center">
                                <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                                <p>Error loading messages</p>
                            </div>
                        </div>
                    `;
                });
        }

        function sendCustomerMessage() {
            const messageInput = document.getElementById('customerMessageText');
            const message = messageInput.value.trim();
            
            if (!message || !window.currentShopkeeperId) return;
            
            // Send message to backend
            fetch('/chats/send-customer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    shopkeeper_id: window.currentShopkeeperId,
                    product_id: window.currentProductId,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear input
                    messageInput.value = '';
                    
                    // Reload messages
                    loadChatMessages(window.currentShopkeeperId);
                    
                    showToast('Message sent successfully!', 'success');
                } else {
                    showToast('Failed to send message', 'error');
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                showToast('Error sending message', 'error');
            });
        }
        
        // Update customer personal profile (name + phone)
        async function updateCustomerProfile(e) {
            e.preventDefault();
            const form = document.getElementById('customer-profile-form');
            const status = document.getElementById('customer-profile-status');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());
            status.className = 'mt-4 text-sm text-blue-300';
            status.textContent = 'Saving...';
            try {
                const res = await fetch('/customer/profile', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    status.className = 'mt-4 text-sm text-green-400';
                    status.textContent = 'Profile updated successfully.';
                    // Update visible name in nav/profile header if present
                    const nameEls = document.querySelectorAll('span.text-white.font-medium');
                    nameEls.forEach(el => { if (el.innerText.trim().length) el.innerText = payload.name; });
                } else {
                    status.className = 'mt-4 text-sm text-red-400';
                    status.textContent = data.message || 'Failed to update profile.';
                }
            } catch (err) {
                status.className = 'mt-4 text-sm text-red-400';
                status.textContent = 'Network error. Please try again.';
            }
            return false;
        }
        
    </script>
</body>
</html>
