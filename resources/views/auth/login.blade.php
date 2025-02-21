<x-guest-layout>
    <div class="bg-white bg-opacity-20 backdrop-blur-lg shadow-lg rounded-xl p-8 transition duration-500 ease-in-out transform hover:scale-105">
        
        <!-- Ilustrasi -->
        <img src="{{ asset('images/logos/logo.svg') }}" class="w-20 mx-auto mb-4 animate-fadeIn" alt="Login Logo">

        
        <!-- Judul -->
        <h2 class="text-white text-center text-2xl font-bold mb-2">Welcome Back</h2>
        <p class="text-gray-300 text-center text-sm mb-6">Log in to your account</p>
        
        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-white text-sm mb-1">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Enter your password">
            </div>
            <div class="flex items-center justify-between text-sm text-gray-300 mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-400 hover:text-blue-500 transition">Forgot password?</a>
            </div>
            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition">LOG IN</button>
        </form>
    </div>

    <!-- Animasi Fade-in -->
    <style>
        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-guest-layout>
