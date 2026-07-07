<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – mBuild Tech</title>
    
    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#ab5e40',
                        'brand-dark': '#8a4a30',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#1e1c1b] font-sans min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 md:p-8">

    <div class="w-full sm:max-w-md bg-[#2a2726] border border-white/5 rounded-2xl p-6 sm:p-8 shadow-xl">
        
        <!-- Logo & Header -->
        <div class="text-center mb-6 sm:mb-8">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="mBuild Tech" 
                class="h-12 sm:h-14 mx-auto mb-5 object-contain"
            >
            <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
            <p class="text-white/50 text-xs sm:text-sm mt-1">Sign in to your dashboard</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="#" class="space-y-4 sm:space-y-5">
            <!-- @csrf -->

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-[10px] sm:text-xs font-medium text-white/60 uppercase tracking-wider mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    placeholder="name@company.com"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 sm:py-3 text-white text-sm focus:outline-none focus:border-brand focus:bg-white/10 transition-colors"
                >
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-[10px] sm:text-xs font-medium text-white/60 uppercase tracking-wider">Password</label>
                </div>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 sm:py-3 text-white text-sm focus:outline-none focus:border-brand focus:bg-white/10 transition-colors"
                >
            </div>

            <!-- Remember Me -->
            <div class="flex items-center pt-1">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded accent-brand cursor-pointer">
                <label for="remember" class="text-xs sm:text-sm text-white/50 ml-2 cursor-pointer select-none">Remember this device</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-semibold py-3 sm:py-3.5 rounded-xl transition-all text-sm shadow-lg shadow-brand/20 active:scale-[0.98] mt-2">
                Sign In
            </button>
        </form>

        <!-- Back Link -->
        <div class="mt-6 sm:mt-8 text-center border-t border-white/5 pt-5 sm:pt-6">
            <a href="{{ route('home') }}" class="text-xs text-white/30 hover:text-white/60 transition-colors inline-flex items-center gap-1">
                ← Back to the website
            </a>
        </div>

    </div>

    <!-- SweetAlert: Sign In Error -->
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Sign In Failed',
                text: @json($errors->first()),
                confirmButtonColor: '#ab5e40',
                background: '#2a2726',
                color: '#ffffff',
                customClass: {
                    popup: 'rounded-2xl'
                }
            });
        });
    </script>
    @endif

</body>

</html>