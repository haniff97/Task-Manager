<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #0284c7 0%, #059669 100%);
            position: relative;
            overflow: hidden;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 60%);
            animation: pulse-rotate 25s linear infinite reverse;
        }
        @keyframes pulse-rotate {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(-180deg) scale(1.05); }
            100% { transform: rotate(-360deg) scale(1); }
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .dark .glass-panel {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="antialiased bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 selection:bg-emerald-500 selection:text-white">
    <div class="min-h-screen flex w-full">
        <!-- Left Side: Vibrant Abstract Background -->
        <div class="hidden lg:flex w-1/2 gradient-bg items-center justify-center p-12 relative">
            <div class="relative z-10 text-white max-w-lg">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight tracking-tight">Unlock your<br>productivity.</h1>
                <p class="text-lg lg:text-xl opacity-90 mb-10 font-light leading-relaxed">
                    Platform to track projects, manage tasks, and hit every deadline.
                </p>
            </div>
            
            <!-- Floating Decorative Elements -->
            <div class="absolute top-1/4 right-1/4 w-48 h-48 bg-white/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-1/4 left-1/4 w-64 h-64 bg-cyan-500/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-3/4 right-1/3 w-56 h-56 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12 relative overflow-hidden bg-white/50 dark:bg-gray-900/50">
            <!-- Decorative circle for mobile -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-sky-200 dark:bg-sky-900/40 rounded-full mix-blend-multiply dark:mix-blend-color-dodge filter blur-3xl opacity-60 lg:hidden pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-emerald-200 dark:bg-emerald-900/40 rounded-full mix-blend-multiply dark:mix-blend-color-dodge filter blur-3xl opacity-60 lg:hidden pointer-events-none"></div>

            <div class="w-full max-w-md relative z-10 glass-panel p-8 sm:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.4)] my-12">
                
                <div class="mb-8 text-center sm:text-left flex flex-col items-center sm:block">
                    <x-application-logo class="w-12 h-12 mb-6 fill-emerald-600 dark:fill-emerald-400 mx-auto sm:mx-0" />
                    <h2 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white tracking-tight">Create an Account</h2>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">Join us to manage your tasks efficiently.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5 text-left">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-800/60 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all duration-300 outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500 text-left" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5 text-left">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-800/60 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all duration-300 outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="name@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500 text-left" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5 text-left">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-800/60 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all duration-300 outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500 text-left" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5 text-left">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-800/60 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all duration-300 outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500 text-left" />
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full mt-4 py-3.5 px-4 bg-gradient-to-r from-sky-500 to-emerald-600 hover:from-sky-400 hover:to-emerald-500 text-white rounded-xl font-semibold shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-0.5 transition-all duration-300 active:translate-y-0 flex items-center justify-center gap-2 group">
                        <span>Get Started</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-80 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-0">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-emerald-600 dark:after:bg-emerald-400 after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
            
            <div class="absolute bottom-6 w-full flex justify-center lg:hidden z-0">
                <p class="text-xs text-gray-400 font-medium tracking-wide shadow-sm">&copy; {{ date('Y') }} Task Manager.</p>
            </div>
        </div>
    </div>

    <!-- Dark Mode Toggle Button -->
    <button id="theme-toggle" type="button" class="fixed top-4 right-4 z-50 p-3 rounded-full bg-white/20 dark:bg-black/20 backdrop-blur-md border border-white/30 dark:border-gray-700/50 text-gray-800 dark:text-gray-200 hover:bg-white/40 dark:hover:bg-black/40 transition-all duration-300 shadow-lg cursor-pointer">
        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
    </button>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>
