<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Virtual Shop Nest</title>
    
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
            from { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
            to { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(147, 51, 234, 0.3); }
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
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(147, 51, 234, 0.4); }
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
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.6);
            transform: scale(1.02);
        }
        .hover-lift:hover {
            transform: translateY(-10px) scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-inter gradient-bg relative">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 relative z-10 py-8">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            
            <!-- Left Side - Branding with Hero Image -->
            <div class="text-white text-center lg:text-left order-2 lg:order-1 animate-slide-in">
                <!-- Hero Visual -->
                <div class="relative mb-12 lg:mb-8">
                    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20 hover-lift">
                        <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Local Shopping" 
                             class="w-full h-64 object-cover rounded-2xl shadow-xl">
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 bg-gradient-to-r from-green-400 to-emerald-500 p-4 rounded-xl shadow-2xl animate-float">
                        <i class="fas fa-shopping-bag text-white text-2xl"></i>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-gradient-to-r from-yellow-400 to-orange-500 p-4 rounded-xl shadow-2xl animate-float" style="animation-delay: 1s;">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                </div>
                
                <div class="mb-8">
                    <div class="flex items-center justify-center lg:justify-start space-x-4 mb-6">
                        <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-4 rounded-3xl shadow-2xl animate-pulse-glow">
                            <i class="fas fa-store text-4xl text-black"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-black">Virtual Shop</h1>
                            <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">Nest</h1>
                        </div>
                    </div>
                </div>
                
                <h2 class="text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                    Welcome Back to Your
                    <span class="text-yellow-300 animate-pulse">Local Marketplace</span>
                </h2>
                
                <p class="text-lg lg:text-xl text-blue-100 mb-8 leading-relaxed">
                    Continue your hyperlocal shopping journey. Support local businesses and get everything delivered in under 2 hours! 🚀
                </p>
                
                <!-- Enhanced Features -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center space-x-3 bg-white/15 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="bg-gradient-to-r from-blue-400 to-cyan-500 p-3 rounded-xl animate-sparkle">
                            <i class="fas fa-bolt text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Under 2hrs</div>
                            <div class="text-blue-200 text-sm">Lightning Fast Delivery</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white/15 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="bg-gradient-to-r from-pink-400 to-rose-500 p-3 rounded-xl animate-sparkle" style="animation-delay: 0.5s;">
                            <i class="fas fa-heart text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Support Local</div>
                            <div class="text-blue-200 text-sm">Community First</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white/15 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-3 rounded-xl animate-sparkle" style="animation-delay: 1s;">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Hyperlocal</div>
                            <div class="text-blue-200 text-sm">Your Neighborhood</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white/15 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/20 transition-all duration-300 hover-lift">
                        <div class="bg-gradient-to-r from-purple-400 to-indigo-500 p-3 rounded-xl animate-sparkle" style="animation-delay: 1.5s;">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="font-bold text-lg">4.9★ Rating</div>
                            <div class="text-blue-200 text-sm">Trusted Platform</div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center lg:text-left">
                    <p class="text-blue-200 mb-4 text-xl">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-gradient-to-r from-green-400 to-emerald-500 text-white px-10 py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-pulse-glow">
                        <i class="fas fa-user-plus mr-3 animate-bounce"></i>Create Account
                    </a>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="order-1 lg:order-2 animate-fade-up">
                <div class="glass-effect rounded-3xl p-8 shadow-2xl max-w-lg mx-auto hover-lift animate-pulse-glow">
                    <div class="text-center mb-10">
                        <div class="bg-gradient-to-r from-vsn-primary to-purple-600 p-4 rounded-3xl inline-block mb-6 shadow-2xl animate-sparkle">
                            <i class="fas fa-sign-in-alt text-3xl text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-white mb-3">Welcome Back!</h2>
                        <p class="text-blue-100 text-lg">Sign in to continue your amazing shopping journey 🛍️</p>
                    </div>
                    
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-500/20 border border-green-500/30 rounded-xl p-4 mb-6">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-400 text-xl"></i>
                                <p class="text-green-300 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
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
                                   class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-blue-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg input-glow hover:bg-white/25"
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
                                       autocomplete="current-password"
                                       id="password"
                                       class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-2xl text-white placeholder-blue-200 focus:outline-none focus:ring-4 focus:ring-yellow-300/50 focus:border-yellow-300 transition-all duration-300 text-lg pr-12 input-glow hover:bg-white/25"
                                       placeholder="Enter your password">
                                <button type="button" 
                                        onclick="togglePassword()"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-200 hover:text-white transition-colors">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-300 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center text-white">
                                <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/20 text-yellow-400 focus:ring-yellow-300 mr-3">
                                <span class="text-lg">Remember me</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-yellow-300 hover:text-yellow-200 transition-colors text-lg">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        
                        <!-- Login Button -->
                        <button type="submit" class="group w-full bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-6 py-4 rounded-2xl font-bold text-xl hover:from-yellow-300 hover:to-orange-300 transition-all duration-300 shadow-2xl transform hover:scale-105 hover:shadow-yellow-400/50 animate-pulse-glow">
                            <i class="fas fa-sign-in-alt mr-3 group-hover:animate-bounce"></i>Sign In to VSN
                        </button>
                        
                        <!-- Social Login -->
                        <div class="relative my-10">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/30"></div>
                            </div>
                            <div class="relative flex justify-center text-xl">
                                <span class="bg-transparent px-6 text-blue-100">Or continue with</span>
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
                        <a href="/" class="inline-flex items-center text-blue-200 hover:text-white transition-colors text-lg">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
    </script>
</body>
</html>
