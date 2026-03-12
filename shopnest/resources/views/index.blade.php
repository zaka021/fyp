<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Shop Nest - Your Local Shopping Destination</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
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
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in': 'fadeIn 1s ease-out',
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(147, 51, 234, 0.3); }
        }
        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .gradient-bg {
            background: linear-gradient(-45deg, #1e3a8a, #3730a3, #7c3aed, #be185d);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .animate-pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
        .animate-slide-in-left {
            animation: slide-in-left 1s ease-out;
        }
        .animate-slide-in-right {
            animation: slide-in-right 1s ease-out;
        }
        .animate-rotate-slow {
            animation: rotate-slow 20s linear infinite;
        }
        .hover-lift:hover {
            transform: translateY(-10px) scale(1.05);
            transition: all 0.3s ease;
        }
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="font-inter gradient-bg overflow-x-hidden">
    
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md shadow-lg border-b border-gray-100">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-vsn-primary to-purple-600 p-3 rounded-xl shadow-lg">
                        <i class="fas fa-store text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-vsn-primary to-purple-600 bg-clip-text text-transparent">
                            Virtual Shop Nest
                        </h1>
                        <p class="text-xs text-gray-500">Hyperlocal Commerce Platform</p>
                    </div>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-vsn-primary to-blue-600 text-white px-6 py-3 rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 font-semibold">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-vsn-primary transition-all duration-300 px-4 py-2 rounded-lg hover:bg-gray-100 font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-vsn-secondary to-green-600 text-white px-6 py-3 rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 font-semibold">
                                    <i class="fas fa-user-plus mr-2"></i>Join Now
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen gradient-bg flex items-center justify-center relative overflow-hidden pt-20">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-purple-900/80 to-indigo-900/90"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80')] bg-cover bg-center opacity-20"></div>
        
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/2 w-96 h-96 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 4s;"></div>
        </div>
        
        <!-- Floating Shopping Icons -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-32 left-20 animate-float opacity-60">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <i class="fas fa-shopping-bag text-yellow-300 text-3xl"></i>
                </div>
            </div>
            <div class="absolute top-48 right-32 animate-float opacity-60" style="animation-delay: 1s;">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <i class="fas fa-pizza-slice text-red-300 text-3xl"></i>
                </div>
            </div>
            <div class="absolute bottom-40 left-32 animate-float opacity-60" style="animation-delay: 3s;">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <i class="fas fa-coffee text-orange-300 text-3xl"></i>
                </div>
            </div>
            <div class="absolute top-60 right-20 animate-float opacity-60" style="animation-delay: 2.5s;">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <i class="fas fa-gift text-pink-300 text-3xl"></i>
                </div>
            </div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="text-left text-white animate-slide-in-left">
                    <!-- Badge -->
                    <div class="inline-flex items-center bg-white/20 glass-effect rounded-full px-6 py-3 mb-8 animate-pulse-glow">
                        <i class="fas fa-rocket text-yellow-300 mr-3 animate-bounce"></i>
                        <span class="font-semibold">Hyperlocal E-commerce Revolution</span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight text-shadow">
                        Virtual Shop
                        <span class="bg-gradient-to-r from-yellow-300 via-orange-300 to-red-300 bg-clip-text text-transparent block animate-pulse">
                            Nest
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-2xl md:text-3xl mb-4 text-blue-100 font-light">
                        Connect • Discover • Deliver
                    </p>
                    <p class="text-xl mb-12 text-blue-200 leading-relaxed">
                        Transform your neighborhood shopping experience. Support local businesses and get everything delivered to your doorstep in under 2 hours.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6 mb-12">
                        <a href="{{ route('register') }}" class="group bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-12 py-5 rounded-2xl font-bold text-xl hover:from-yellow-300 hover:to-orange-300 transition-all duration-300 shadow-2xl transform hover:scale-105">
                            <i class="fas fa-rocket mr-3 group-hover:animate-bounce"></i>Start Shopping Now
                        </a>
                        <a href="{{ route('login') }}" class="group glass-effect text-white px-12 py-5 rounded-2xl font-bold text-xl hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-3"></i>Login to Account
                        </a>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300 mb-2">500+</div>
                            <div class="text-blue-200">Local Stores</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-green-300 mb-2">&lt; 2hrs</div>
                            <div class="text-blue-200">Delivery Time</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-pink-300 mb-2">10K+</div>
                            <div class="text-blue-200">Happy Customers</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Visual Content -->
                <div class="relative animate-slide-in-right" style="animation-delay: 0.5s;">
                    <!-- Main Hero Image -->
                    <div class="relative hover-lift">
                        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20 animate-pulse-glow">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Local Shopping Experience" 
                                 class="w-full h-96 object-cover rounded-2xl shadow-xl hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-8 -left-8 bg-gradient-to-r from-green-400 to-green-600 p-6 rounded-2xl shadow-2xl animate-float hover-lift">
                            <div class="text-white text-center">
                                <i class="fas fa-truck text-3xl mb-2 animate-bounce"></i>
                                <div class="font-bold text-lg">Fast Delivery</div>
                                <div class="text-sm opacity-90">Under 2 Hours</div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-8 -right-8 bg-gradient-to-r from-purple-400 to-purple-600 p-6 rounded-2xl shadow-2xl animate-float hover-lift" style="animation-delay: 1.5s;">
                            <div class="text-white text-center">
                                <i class="fas fa-heart text-3xl mb-2 animate-pulse"></i>
                                <div class="font-bold text-lg">Local Love</div>
                                <div class="text-sm opacity-90">Support Community</div>
                            </div>
                        </div>
                        
                        <div class="absolute top-1/2 -right-12 bg-gradient-to-r from-yellow-400 to-orange-500 p-4 rounded-xl shadow-2xl animate-bounce-slow hover-lift">
                            <div class="text-white text-center">
                                <i class="fas fa-star text-2xl mb-1 animate-spin" style="animation-duration: 3s;"></i>
                                <div class="font-bold">4.9★</div>
                                <div class="text-xs">Rating</div>
                            </div>
                        </div>
                        
                        <!-- Additional Floating Elements -->
                        <div class="absolute top-16 left-16 bg-gradient-to-r from-blue-400 to-cyan-500 p-3 rounded-xl shadow-xl animate-float opacity-80" style="animation-delay: 0.8s;">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                        
                        <div class="absolute bottom-16 left-4 bg-gradient-to-r from-pink-400 to-rose-500 p-3 rounded-xl shadow-xl animate-float opacity-80" style="animation-delay: 2.2s;">
                            <i class="fas fa-store text-white text-xl"></i>
                        </div>
                    </div>
                    
                    <!-- Background Decoration -->
                    <div class="absolute -z-10 top-8 left-8 w-full h-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-3xl blur-xl animate-rotate-slow"></div>
                    
                    <!-- Additional Background Circles -->
                    <div class="absolute -z-20 -top-4 -right-4 w-32 h-32 bg-gradient-to-r from-yellow-400/30 to-orange-400/30 rounded-full blur-2xl animate-pulse"></div>
                    <div class="absolute -z-20 -bottom-8 -left-8 w-40 h-40 bg-gradient-to-r from-green-400/30 to-blue-400/30 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-r from-blue-300 to-purple-300 rounded-full mix-blend-multiply filter blur-xl animate-float"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-gradient-to-r from-pink-300 to-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-float" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 animate-fade-in">
                <div class="inline-flex items-center bg-gradient-to-r from-vsn-primary/10 to-purple-600/10 rounded-full px-8 py-4 mb-8 backdrop-blur-sm border border-vsn-primary/20">
                    <i class="fas fa-store text-vsn-primary mr-3 text-2xl animate-bounce"></i>
                    <span class="font-semibold text-vsn-primary text-lg">Discover Local Services</span>
                </div>
                <h2 class="text-6xl font-black bg-gradient-to-r from-vsn-primary via-purple-600 to-pink-600 bg-clip-text text-transparent mb-6 text-shadow">
                    What We Deliver
                </h2>
                <p class="text-2xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                    Everything you need from your favorite local businesses, delivered fast with love ❤️
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Enhanced Service Cards -->
                <div class="group bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-red-500 to-red-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-red-500/50 animate-pulse-glow">
                        <i class="fas fa-utensils text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-red-600 transition-colors">Food & Dining</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Restaurants, cafes, fast food</p>
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Popular!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-green-500/50 animate-pulse-glow">
                        <i class="fas fa-shopping-basket text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-green-600 transition-colors">Grocery</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Fresh produce, essentials</p>
                    <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Fresh!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-purple-500/50 animate-pulse-glow">
                        <i class="fas fa-tshirt text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-purple-600 transition-colors">Fashion</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Clothing, accessories</p>
                    <div class="absolute -top-2 -right-2 bg-purple-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Trendy!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-blue-500/50 animate-pulse-glow">
                        <i class="fas fa-laptop text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-blue-600 transition-colors">Electronics</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Gadgets, accessories</p>
                    <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Tech!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-500/5 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-teal-500/50 animate-pulse-glow">
                        <i class="fas fa-pills text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-teal-600 transition-colors">Pharmacy</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Medicines, health care</p>
                    <div class="absolute -top-2 -right-2 bg-teal-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Health!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-pink-50 to-pink-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/5 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-pink-500 to-pink-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-pink-500/50 animate-pulse-glow">
                        <i class="fas fa-gift text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-pink-600 transition-colors">Gifts</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Special occasions</p>
                    <div class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Special!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-indigo-50 to-indigo-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-indigo-500/50 animate-pulse-glow">
                        <i class="fas fa-car text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-indigo-600 transition-colors">Transport</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Quick rides, delivery</p>
                    <div class="absolute -top-2 -right-2 bg-indigo-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Fast!
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-3xl hover:shadow-2xl transition-all duration-500 transform hover:scale-110 text-center relative overflow-hidden hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/5 to-yellow-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:animate-bounce shadow-xl group-hover:shadow-yellow-500/50 animate-pulse-glow">
                        <i class="fas fa-tools text-white text-3xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl mb-3 group-hover:text-yellow-600 transition-colors">Services</h3>
                    <p class="text-gray-600 group-hover:text-gray-700 transition-colors">Home, repair services</p>
                    <div class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Pro!
                    </div>
                </div>
            </div>
            
            <!-- Additional Stats Row -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">24/7</h3>
                    <p class="text-gray-600">Available Service</p>
                </div>
                <div class="text-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce" style="animation-delay: 0.5s;">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">100%</h3>
                    <p class="text-gray-600">Secure Payments</p>
                </div>
                <div class="text-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce" style="animation-delay: 1s;">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">50K+</h3>
                    <p class="text-gray-600">Active Users</p>
                </div>
            </div>
        </div>
    </section>

    <!-- High-Tech Innovation Section -->
    <section class="py-24 gradient-bg relative overflow-hidden">
        <!-- Animated Tech Background -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-40 h-40 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 w-60 h-60 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-float" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <!-- Tech Innovation Header -->
            <div class="text-center mb-20">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-8 py-4 mb-8 border border-white/20">
                    <i class="fas fa-microchip text-yellow-300 text-2xl mr-3 animate-pulse"></i>
                    <span class="text-white font-semibold text-lg">Powered by Advanced Technology</span>
                </div>
                <h2 class="text-5xl font-bold text-white mb-6">
                    The Future of 
                    <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent animate-pulse">Hyperlocal Commerce</span>
                </h2>
                <p class="text-xl text-green-100 max-w-3xl mx-auto leading-relaxed">
                    Experience cutting-edge features that revolutionize how you discover and shop from local businesses 🚀
                </p>
            </div>

            <!-- Tech Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                <!-- AI-Powered Discovery -->
                <div class="group bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:animate-bounce shadow-2xl">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">AI Discovery</h3>
                    <p class="text-green-100 leading-relaxed">Smart algorithms learn your preferences to suggest the perfect local businesses and products.</p>
                </div>

                <!-- Real-time Tracking -->
                <div class="group bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:animate-bounce shadow-2xl">
                        <i class="fas fa-satellite-dish text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Live Tracking</h3>
                    <p class="text-green-100 leading-relaxed">Real-time GPS tracking and delivery updates keep you informed every step of the way.</p>
                </div>

                <!-- Smart Recommendations -->
                <div class="group bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 hover-lift">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:animate-bounce shadow-2xl">
                        <i class="fas fa-magic text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Smart Suggestions</h3>
                    <p class="text-green-100 leading-relaxed">Personalized recommendations based on your location, preferences, and shopping history.</p>
                </div>
            </div>

            <!-- Interactive Demo Section -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-12 border border-white/20 shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-bold text-white mb-6">See VSN in Action</h3>
                        <p class="text-green-100 text-xl mb-8 leading-relaxed">
                            Watch how our platform connects you with local businesses in seconds, not minutes.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="bg-yellow-400 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-search text-black"></i>
                                </div>
                                <span class="text-white text-lg">Search local businesses instantly</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="bg-green-400 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-black"></i>
                                </div>
                                <span class="text-white text-lg">Add items with one-click ordering</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-400 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-rocket text-white"></i>
                                </div>
                                <span class="text-white text-lg">Get delivery in under 2 hours</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-8 border border-white/30 shadow-2xl hover-lift">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="VSN Technology" 
                                 class="w-full h-64 object-cover rounded-2xl shadow-xl">
                        </div>
                        <!-- Floating Tech Icons -->
                        <div class="absolute -top-4 -right-4 bg-gradient-to-r from-yellow-400 to-orange-500 p-4 rounded-xl shadow-2xl animate-float">
                            <i class="fas fa-cog text-white text-xl animate-spin"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-gradient-to-r from-green-400 to-emerald-500 p-4 rounded-xl shadow-2xl animate-float" style="animation-delay: 1s;">
                            <i class="fas fa-wifi text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gradient-to-br from-green-600 via-emerald-700 to-teal-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold bg-gradient-to-r from-vsn-primary to-purple-600 bg-clip-text text-transparent mb-6">
                    Why Choose VSN?
                </h2>
                <p class="text-xl text-white max-w-2xl mx-auto">
                    Empowering local economies, one delivery at a time
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="group text-center p-10 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                    <div class="bg-gradient-to-r from-vsn-accent to-orange-500 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-bolt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Lightning Fast</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Get your orders delivered in under 2 hours from local businesses. Speed meets convenience in your neighborhood.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="group text-center p-10 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                    <div class="bg-gradient-to-r from-vsn-secondary to-green-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-map-marker-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Hyperlocal Focus</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Discover amazing businesses in your neighborhood. Support your local community and build stronger connections.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="group text-center p-10 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                    <div class="bg-gradient-to-r from-vsn-primary to-blue-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-heart text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Community First</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Every purchase helps local businesses thrive. Join a platform that puts community and local economy first.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-vsn-primary via-purple-600 to-indigo-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-5xl font-bold mb-8">Ready to Start Shopping Locally?</h2>
            <p class="text-2xl mb-12 text-blue-100 max-w-3xl mx-auto">
                Join thousands of customers supporting local businesses in their neighborhoods
            </p>
            
            <div class="flex flex-col sm:flex-row gap-8 justify-center">
                <a href="{{ route('register') }}" class="group bg-white text-vsn-primary px-12 py-6 rounded-2xl font-bold text-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl transform hover:scale-105">
                    <i class="fas fa-user-plus mr-3 group-hover:animate-bounce"></i>Create Account
                </a>
                <a href="{{ route('login') }}" class="group glass-effect border-2 border-white text-white px-12 py-6 rounded-2xl font-bold text-xl hover:bg-white hover:text-vsn-primary transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-3"></i>Sign In
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-vsn-dark text-white py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-r from-vsn-primary to-purple-600 p-3 rounded-xl">
                            <i class="fas fa-store text-white text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold">Virtual Shop Nest</span>
                    </div>
                    <p class="text-gray-400 text-lg mb-6 max-w-md">
                        Connecting communities through hyperlocal commerce. Empowering local businesses and bringing neighborhoods together.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 p-3 rounded-xl hover:bg-blue-700 transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="bg-sky-500 p-3 rounded-xl hover:bg-sky-600 transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="bg-pink-500 p-3 rounded-xl hover:bg-pink-600 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold mb-6 text-xl">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition text-lg">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">For Businesses</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h3 class="font-bold mb-6 text-xl">Support</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition text-lg">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">FAQ</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p class="text-lg">&copy; 2024 Virtual Shop Nest. All rights reserved. Made with ❤️ for local communities.</p>
            </div>
        </div>
    </footer>

    <!-- Smooth Scrolling -->
    <script>
        // Add smooth scrolling behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
