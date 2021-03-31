<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            @include('layouts.nav')

            <div class="px-6 py-4">
                <h2 class="font-bold text-3xl">Dashboard</h2>

                <!-- Page Content -->
                <main class="mt-4 flex items-start space-x-4">
    
                    <div class="w-1/5">
                        <ul>
                            {{-- Articles --}}
                            <li>
                                <a href="{{ route('dashboard.index') }}" class="flex items-center justify-between p-2 rounded {{ request()->is('dashboard') ? '' : 'hover:bg-gray-200 transition duration-200' }}">
                                    <span class="{{ request()->is('dashboard') ? 'font-bold' : '' }}">Articles</span>
                                    <span class="bg-gray-300 font-semibold text-xs rounded p-1">
                                        {{ auth()->user()->articles->count() }}
                                    </span>
                                </a>
                            </li>
        
                            {{-- Categories --}}
                            <li>
                                <a href="{{ route('dashboard.following_categories') }}" class="flex items-center justify-between p-2 rounded {{ request()->is('dashboard/following_categories') ? '' : 'hover:bg-gray-200 transition duration-200' }}">
                                    <span class="{{ request()->is('dashboard/following_categories') ? 'font-bold' : '' }}">Following Categories</span>
                                    <span class="bg-gray-300 font-semibold text-xs rounded p-1">
                                        {{ auth()->user()->categories->count() }}
                                    </span>
                                </a>
                            </li>

                            {{-- Reading List --}}
                            <li>
                                <a href="{{ route('dashboard.saved') }}" class="flex items-center justify-between p-2 rounded {{ request()->is('dashboard/saved') ? '' : 'hover:bg-gray-200 transition duration-200' }}">
                                    <span class="{{ request()->is('dashboard/saved') ? 'font-bold' : '' }}">Reading List</span>
                                    <span class="bg-gray-300 font-semibold text-xs rounded p-1">
                                        {{ auth()->user()->savedArticles->count() }}
                                    </span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
    
                    <section class="w-4/5">
                        {{ $slot }}
                    </section>
                    
                </main>
            </div>
            
        </div>
    </body>
</html>
