<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Shop Nest - Hyperlocal E-commerce Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#2563EB',
                        'secondary': '#059669',
                        'accent': '#DC2626',
                        'vsn-blue': '#1E40AF',
                        'vsn-green': '#047857',
                        'vsn-orange': '#EA580C',
                        'vsn-purple': '#7C3AED',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-poppins bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-primary to-vsn-purple p-2 rounded-xl">
                        <i class="fas fa-store text-2xl text-white"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold gradient-text">Virtual Shop Nest</span>
                        <div class="text-xs text-gray-500">Hyperlocal Commerce</div>
                    </div>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-primary to-vsn-blue text-white px-6 py-2 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary transition-all duration-300 px-4 py-2 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary to-vsn-blue text-white px-6 py-2 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-user-plus mr-2"></i>Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800 flex items-center pt-20 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white">
                    <div class="mb-8">
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-6 py-3 rounded-full text-sm font-semibold shadow-lg animate-pulse-slow">
                            🚀 Hyperlocal E-commerce Revolution
                        </span>
                    </div>
                    <h1 class="text-6xl lg:text-8xl font-extrabold mb-8 leading-tight">
                        Virtual Shop
                        <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">Nest</span>
                    </h1>
                    <h2 class="text-3xl lg:text-4xl mb-8 text-blue-100 font-light">
                        Connect • Discover • Deliver
                        <span class="block text-xl mt-2 text-yellow-300">Under 2 Hours ⚡</span>
                    </h2>
                    <p class="text-xl mb-10 text-blue-100 leading-relaxed">
                        Transform your neighborhood shopping experience. Discover amazing local businesses, 
                        support your community, and get everything delivered to your doorstep in record time.
                    </p>
                    
                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-10">
                        <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <i class="fas fa-clock text-yellow-300 text-2xl"></i>
                            <div>
                                <div class="font-semibold">Under 2hrs</div>
                                <div class="text-sm text-blue-200">Lightning Fast</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <i class="fas fa-map-marker-alt text-green-300 text-2xl"></i>
                            <div>
                                <div class="font-semibold">Hyperlocal</div>
                                <div class="text-sm text-blue-200">Your Neighborhood</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <i class="fas fa-heart text-pink-300 text-2xl"></i>
                            <div>
                                <div class="font-semibold">Support Local</div>
                                <div class="text-sm text-blue-200">Community First</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <i class="fas fa-star text-orange-300 text-2xl"></i>
                            <div>
                                <div class="font-semibold">Reviews</div>
                                <div class="text-sm text-blue-200">Community Driven</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6">
                        <a href="/register" class="group bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-10 py-5 rounded-2xl font-bold text-xl hover:from-yellow-300 hover:to-orange-300 transition-all duration-300 text-center shadow-2xl transform hover:scale-105">
                            <i class="fas fa-rocket mr-3 group-hover:animate-bounce"></i>Start Shopping
                        </a>
                        <a href="/login" class="group border-3 border-white text-white px-10 py-5 rounded-2xl font-bold text-xl hover:bg-white hover:text-blue-600 transition-all duration-300 text-center backdrop-blur-sm">
                            <i class="fas fa-sign-in-alt mr-3"></i>Login
                        </a>
                    </div>
                </div>
                
                <!-- Right Content -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="bg-white rounded-3xl p-8 shadow-2xl transform hover:scale-105 transition-all duration-500 hover:rotate-1">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=500&h=400&fit=crop&crop=center" 
                                 alt="Local Business Delivery" 
                                 class="rounded-2xl w-full h-80 object-cover mb-6">
                            <div class="text-center">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Discover Local Gems</h3>
                                <p class="text-gray-600 mb-6">Amazing businesses in your neighborhood</p>
                                <div class="flex justify-center space-x-3 text-sm">
                                    <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-4 py-2 rounded-full">🍕 Food</span>
                                    <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 px-4 py-2 rounded-full">🛒 Grocery</span>
                                    <span class="bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 px-4 py-2 rounded-full">👕 Fashion</span>
                                </div>
                            </div>
                        </div>
                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 bg-yellow-400 rounded-full p-3 shadow-lg animate-bounce">
                            <i class="fas fa-bolt text-black text-xl"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-green-400 rounded-full p-3 shadow-lg animate-pulse">
                            <i class="fas fa-heart text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold gradient-text mb-6">Why Choose Virtual Shop Nest?</h2>
                <p class="text-2xl text-gray-600">Empowering local economies, one delivery at a time</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-rotate-1">
                    <div class="bg-gradient-to-r from-primary to-vsn-blue text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-bolt text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Lightning Fast</h3>
                    <p class="text-gray-600 text-lg">Get your orders delivered in under 2 hours from local businesses near you. Speed meets convenience!</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-green-50 to-green-100 hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                    <div class="bg-gradient-to-r from-secondary to-vsn-green text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-map-marked-alt text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Hyperlocal Focus</h3>
                    <p class="text-gray-600 text-lg">Discover amazing businesses in your neighborhood and support your local community ecosystem.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-orange-50 to-orange-100 hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:rotate-1">
                    <div class="bg-gradient-to-r from-vsn-orange to-red-500 text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:animate-bounce">
                        <i class="fas fa-handshake text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Support Local</h3>
                    <p class="text-gray-600 text-lg">Every purchase helps local businesses thrive and strengthens your community bonds.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold gradient-text mb-6">Available Services</h2>
                <p class="text-2xl text-gray-600">Everything you need, delivered from local businesses</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Service Cards -->
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-utensils text-5xl text-red-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Restaurants</h3>
                    <p class="text-gray-600">Fresh meals from local eateries</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-shopping-cart text-5xl text-green-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Grocery</h3>
                    <p class="text-gray-600">Fresh produce & essentials</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-tshirt text-5xl text-purple-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Fashion</h3>
                    <p class="text-gray-600">Trendy clothes & accessories</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-car text-5xl text-blue-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Transport</h3>
                    <p class="text-gray-600">Quick rides around city</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-pills text-5xl text-teal-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Pharmacy</h3>
                    <p class="text-gray-600">Medicines & health products</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-laptop text-5xl text-indigo-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Electronics</h3>
                    <p class="text-gray-600">Gadgets & tech accessories</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-gift text-5xl text-pink-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Gifts</h3>
                    <p class="text-gray-600">Perfect gifts for loved ones</p>
                </div>
                
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-110">
                    <i class="fas fa-tools text-5xl text-yellow-500 mb-6 group-hover:animate-bounce"></i>
                    <h3 class="font-bold text-gray-800 text-xl mb-2">Services</h3>
                    <p class="text-gray-600">Home & repair services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-gradient-to-r from-primary via-vsn-blue to-vsn-purple text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="group">
                    <div class="text-6xl font-bold mb-4 group-hover:animate-pulse">500+</div>
                    <div class="text-blue-200 text-xl">Local Businesses</div>
                </div>
                <div class="group">
                    <div class="text-6xl font-bold mb-4 group-hover:animate-pulse">10K+</div>
                    <div class="text-blue-200 text-xl">Happy Customers</div>
                </div>
                <div class="group">
                    <div class="text-6xl font-bold mb-4 group-hover:animate-pulse">50K+</div>
                    <div class="text-blue-200 text-xl">Orders Delivered</div>
                </div>
                <div class="group">
                    <div class="text-6xl font-bold mb-4 group-hover:animate-pulse">< 2hrs</div>
                    <div class="text-blue-200 text-xl">Average Delivery</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-secondary via-vsn-green to-emerald-600 text-white relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-black/10"></div>
        </div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-5xl font-bold mb-8">Ready to Discover Your Neighborhood?</h2>
            <p class="text-2xl mb-12 text-green-100">Join thousands of customers supporting local businesses</p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="/register" class="group bg-white text-secondary px-12 py-6 rounded-2xl font-bold text-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl transform hover:scale-105">
                    <i class="fas fa-user-plus mr-3 group-hover:animate-bounce"></i>Sign Up Now
                </a>
                <a href="#" class="group border-3 border-white text-white px-12 py-6 rounded-2xl font-bold text-xl hover:bg-white hover:text-secondary transition-all duration-300">
                    <i class="fas fa-play mr-3"></i>Watch Demo
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-r from-primary to-vsn-purple p-2 rounded-xl">
                            <i class="fas fa-store text-2xl text-white"></i>
                        </div>
                        <span class="text-2xl font-bold">Virtual Shop Nest</span>
                    </div>
                    <p class="text-gray-400 text-lg">Connecting communities through hyperlocal commerce and empowering local businesses.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-6 text-xl">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition text-lg">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">For Businesses</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6 text-xl">Support</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition text-lg">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition text-lg">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6 text-xl">Connect</h3>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="bg-blue-600 p-3 rounded-xl text-white hover:bg-blue-700 transition">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="bg-sky-500 p-3 rounded-xl text-white hover:bg-sky-600 transition">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="bg-pink-500 p-3 rounded-xl text-white hover:bg-pink-600 transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                    </div>
                    <p class="text-gray-400">Follow us for updates and local business spotlights</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p class="text-lg">&copy; 2024 Virtual Shop Nest. All rights reserved. Made with ❤️ for local communities.</p>
            </div>
        </div>
    </footer>
</body>
</html>
