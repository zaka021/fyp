<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Join Virtual Shop Nest - Register</title>
    
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
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(16, 185, 129, 0.4); }
            to { box-shadow: 0 0 40px rgba(16, 185, 129, 0.8), 0 0 60px rgba(34, 197, 94, 0.3); }
        }
        @keyframes sparkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.5); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.8), 0 0 60px rgba(34, 197, 94, 0.4); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f3460 50%, #16213e 75%, #1a1a2e 100%);
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
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-glow:focus {
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.6);
            transform: scale(1.02);
        }
        .hover-lift:hover {
            transform: translateY(-10px) scale(1.05);
            transition: all 0.3s ease;
        }
        .animate-slide-in {
            animation: slideIn 1s ease-out;
        }
        .animate-fade-up {
            animation: fadeUp 1s ease-out;
        }
        .animate-pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-inter gradient-bg relative">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-20 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute top-60 right-20 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-10 left-1/3 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/2 right-1/3 w-60 h-60 bg-orange-300 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-float" style="animation-delay: 5s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 relative z-10 py-8">
        <div class="w-full max-w-7xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side - Branding & Benefits with Hero Image -->
            <div class="text-white text-center lg:text-left order-2 lg:order-1 animate-slide-in">
                <!-- Hero Visual -->
                <div class="relative mb-12 lg:mb-8">
                    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20 hover-lift">
                        <img src="https://images.unsplash.com/photo-1472851294608-062f824d29cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Join Community" 
                             class="w-full h-64 object-cover rounded-2xl shadow-xl">
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 bg-gradient-to-r from-yellow-400 to-orange-500 p-4 rounded-xl shadow-2xl animate-float">
                        <i class="fas fa-crown text-white text-2xl"></i>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-gradient-to-r from-green-400 to-emerald-500 p-4 rounded-xl shadow-2xl animate-float" style="animation-delay: 1s;">
                        <i class="fas fa-rocket text-white text-2xl"></i>
                    </div>
                </div>
                
                <div class="mb-8">
                    <div class="flex items-center justify-center lg:justify-start space-x-4 mb-8">
                        <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-4 rounded-3xl shadow-2xl animate-pulse-glow">
                            <i class="fas fa-store text-4xl text-black"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-black">Virtual Shop</h1>
                            <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">Nest</h1>
                        </div>
                    </div>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    Join the
                    <span class="text-yellow-300 animate-pulse">Hyperlocal Revolution</span>
                </h2>
                
                <p class="text-lg lg:text-xl text-green-100 mb-8 leading-relaxed">
                    Become part of a community that supports local businesses and gets amazing products delivered in under 2 hours! 🌟
                </p>
                
                <!-- Enhanced Benefits Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 p-3 rounded-xl animate-sparkle">
                                <i class="fas fa-rocket text-black text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Fast Delivery</h3>
                                <p class="text-green-100 text-sm">Under 2 hours guaranteed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gradient-to-r from-pink-400 to-rose-500 p-4 rounded-xl animate-sparkle" style="animation-delay: 0.5s;">
                                <i class="fas fa-heart text-white text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Support Local</h3>
                                <p class="text-green-100">Help your community thrive</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gradient-to-r from-blue-400 to-cyan-500 p-4 rounded-xl animate-sparkle" style="animation-delay: 1s;">
                                <i class="fas fa-map-marker-alt text-white text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Hyperlocal</h3>
                                <p class="text-green-100">Your neighborhood focus</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gradient-to-r from-purple-400 to-indigo-500 p-4 rounded-xl animate-sparkle" style="animation-delay: 1.5s;">
                                <i class="fas fa-star text-white text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Quality</h3>
                                <p class="text-green-100">Curated local products</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Right Side - Registration Form -->
            <div class="order-1 lg:order-2 animate-fade-up">
                <div class="glass-effect rounded-3xl p-8 shadow-2xl max-w-lg mx-auto hover-lift animate-pulse-glow">
                    <div class="text-center mb-8">
                        <div class="bg-gradient-to-r from-vsn-secondary to-emerald-600 p-4 rounded-3xl inline-block mb-4 shadow-2xl animate-sparkle">
                            <i class="fas fa-user-plus text-3xl text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Join Virtual Shop Nest</h2>
                        <p class="text-green-100 text-base">Start your hyperlocal shopping journey today! 🚀</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="relative">
                            <label class="block text-white font-semibold mb-3 text-lg">
                                <i class="fas fa-user mr-2 text-yellow-300"></i>Full Name
                            </label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required 
                                   autocomplete="name"
                                   class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg input-glow hover:bg-white/25"
                                   placeholder="Enter your full name">
                            @error('name')
                                <span class="text-red-300 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Email Field -->
                        <div class="relative">
                            <label class="block text-white font-semibold mb-3 text-lg">
                                <i class="fas fa-envelope mr-2 text-yellow-300"></i>Email Address
                            </label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autocomplete="email"
                                   class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg input-glow hover:bg-white/25"
                                   placeholder="Enter your email address">
                            @error('email')
                                <span class="text-red-300 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Password Field -->
                        <div class="relative">
                            <label class="block text-white font-semibold mb-3 text-lg">
                                <i class="fas fa-lock mr-2 text-yellow-300"></i>Password
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       id="password"
                                       class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg pr-12 input-glow hover:bg-white/25"
                                       placeholder="Create a strong password">
                                <button type="button" 
                                        onclick="togglePassword('password')"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-green-200 hover:text-white transition-colors">
                                    <i class="fas fa-eye" id="toggleIcon1"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-300 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Confirm Password Field -->
                        <div class="relative">
                            <label class="block text-white font-semibold mb-3 text-lg">
                                <i class="fas fa-shield-alt mr-2 text-yellow-300"></i>Confirm Password
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       id="password_confirmation"
                                       class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg pr-12 input-glow hover:bg-white/25"
                                       placeholder="Confirm your password">
                                <button type="button" 
                                        onclick="togglePassword('password_confirmation')"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-green-200 hover:text-white transition-colors">
                                    <i class="fas fa-eye" id="toggleIcon2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Role Selection -->
                        <div class="relative">
                            <label class="block text-white font-semibold mb-3 text-lg">
                                <i class="fas fa-user-tag mr-2 text-yellow-300"></i>I want to join as
                            </label>
                            <select name="role" 
                                    required
                                    class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg input-glow hover:bg-white/25">
                                <option value="" class="bg-gray-800 text-white">Select your role</option>
                                <option value="customer" class="bg-gray-800 text-white">Customer - I want to shop</option>
                                <option value="shopkeeper" class="bg-gray-800 text-white">Shopkeeper - I want to sell</option>
                            </select>
                            @error('role')
                                <span class="text-red-300 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start space-x-3 bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <input type="checkbox" 
                                   name="terms" 
                                   required
                                   class="mt-1 rounded border-white/30 bg-white/20 text-yellow-400 focus:ring-yellow-300 w-4 h-4">
                            <label class="text-white text-base leading-relaxed">
                                I agree to the 
                                <a href="#" class="text-yellow-300 hover:text-yellow-200 underline hover:animate-pulse">Terms</a> 
                                and 
                                <a href="#" class="text-yellow-300 hover:text-yellow-200 underline hover:animate-pulse">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <!-- Register Button -->
                        <button type="submit" class="group w-full bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-6 py-4 rounded-2xl font-bold text-xl hover:from-yellow-300 hover:to-orange-300 transition-all duration-300 shadow-2xl transform hover:scale-105 hover:shadow-yellow-400/50 animate-pulse-glow">
                            <i class="fas fa-rocket mr-3 group-hover:animate-bounce"></i>Create My VSN Account
                        </button>
                        
                        <!-- Social Registration -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/30"></div>
                            </div>
                            <div class="relative flex justify-center text-lg">
                                <span class="bg-transparent px-4 text-green-100">Or register with</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" class="group flex items-center justify-center bg-white/20 backdrop-blur-sm border border-white/30 text-white px-4 py-3 rounded-2xl hover:bg-white/30 transition-all duration-300 text-lg transform hover:scale-105 hover-lift">
                                <i class="fab fa-google mr-2 text-red-400 text-lg group-hover:animate-bounce"></i>Google
                            </button>
                            <button type="button" class="group flex items-center justify-center bg-white/20 backdrop-blur-sm border border-white/30 text-white px-4 py-3 rounded-2xl hover:bg-white/30 transition-all duration-300 text-lg transform hover:scale-105 hover-lift">
                                <i class="fab fa-facebook mr-2 text-blue-400 text-lg group-hover:animate-bounce"></i>Facebook
                            </button>
                        </div>
                    </form>
                    
                    <!-- Back to Home -->
                    <div class="text-center mt-6">
                        <a href="/" class="inline-flex items-center text-green-200 hover:text-white transition-colors text-lg hover-lift">
                            <i class="fas fa-arrow-left mr-2 animate-bounce"></i>Back to Home
                        </a>
                    </div>
                </div>
                
                <!-- Floating Success Elements -->
                <div class="hidden lg:block absolute -top-6 -right-6 bg-yellow-400 rounded-full p-4 shadow-2xl animate-bounce">
                    <i class="fas fa-crown text-black text-2xl"></i>
                </div>
                <div class="hidden lg:block absolute -bottom-6 -left-6 bg-pink-400 rounded-full p-4 shadow-2xl animate-pulse">
                    <i class="fas fa-gift text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Success Stats and Login Link -->
    <div class="absolute bottom-4 left-4 right-4 animate-fade-up">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Stats Section -->
            <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 border border-white/30 shadow-xl hover-lift flex-1">
                <h3 class="text-white font-semibold text-base mb-2 text-center">Join 10,000+ Happy Customers</h3>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div class="animate-sparkle">
                        <div class="text-lg font-bold text-yellow-300">500+</div>
                        <div class="text-green-100 text-xs">Local Stores</div>
                    </div>
                    <div class="animate-sparkle" style="animation-delay: 0.5s;">
                        <div class="text-lg font-bold text-yellow-300">50K+</div>
                        <div class="text-green-100 text-xs">Orders</div>
                    </div>
                    <div class="animate-sparkle" style="animation-delay: 1s;">
                        <div class="text-lg font-bold text-yellow-300">4.9★</div>
                        <div class="text-green-100 text-xs">Rating</div>
                    </div>
                </div>
            </div>
            
            <!-- Login Link Section -->
            <div class="text-center lg:text-right">
                <p class="text-green-200 mb-2 text-sm">Already have an account?</p>
                <a href="{{ route('login') }}" class="inline-flex items-center bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId === 'password' ? 'toggleIcon1' : 'toggleIcon2');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>
