<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body class="gradient-bg min-h-screen">
    <div class="relative">
        <!-- Navigation Bar -->
        @if (Route::has('login'))
            <nav class="glass-effect fixed w-full top-0 z-50 px-6 py-4">
                <div class="container mx-auto flex justify-between items-center">
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/home') }}" class="inline-block px-4 py-2 text-white hover:bg-white hover:text-purple-600 rounded-lg transition duration-300">Home</a>
                            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Log out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-4 py-2 text-white hover:bg-white hover:text-purple-600 rounded-lg transition duration-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-block px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-purple-100 transition duration-300">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </nav>
        @endif

        <!-- Main Content -->
        <main class="container mx-auto pt-24 px-6">
            @auth
                @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                    <div class="glass-effect rounded-xl p-8 mt-8">
                        <h2 class="text-2xl font-bold text-white mb-4">Admin Dashboard</h2>
                        <ul class="space-y-4">
                            <li>
                                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 bg-white bg-opacity-20 rounded-lg text-white hover:bg-opacity-30 transition duration-300">
                                    User Approval
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="glass-effect rounded-xl p-8 mt-8">
                        <h2 class="text-2xl font-bold text-white mb-4">User Dashboard</h2>
                        <ul class="space-y-4">
                            <li>
                                <a href="{{ route('merchant.index') }}" class="flex items-center px-4 py-3 bg-white bg-opacity-20 rounded-lg text-white hover:bg-opacity-30 transition duration-300">
                                    Biodata
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('store.index') }}" class="flex items-center px-4 py-3 bg-white bg-opacity-20 rounded-lg text-white hover:bg-opacity-30 transition duration-300">
                                    Dagangan
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endauth

            @guest
                <div class="text-center py-20">
                    <h1 class="text-4xl font-bold text-white mb-6">Welcome to Our Platform</h1>
                    <p class="text-xl text-white mb-8">Please login or register to access your dashboard.</p>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-white text-purple-600 rounded-lg hover:bg-purple-100 transition duration-300">Get Started</a>
                    </div>
                </div>
            @endguest
        </main>
    </div>
</body>
</html>
