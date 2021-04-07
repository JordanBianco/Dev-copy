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
        <div class="min-h-screen bg-gray-50">

            @include('layouts.nav')

            <div class="w-3/4 mx-auto py-6">
                <h2 class="font-bold text-3xl">Settings for 
                    <a href="{{ route('user.profile', auth()->user()->username) }}" class="text-blue-700">{{ '@' . auth()->user()->name }}</a>
                </h2>
    
                <!-- Page Content -->
                <main class="mt-8 flex items-start space-x-4">
    
                    <div class="w-1/4">
                        <ul class="space-y-3">
                            {{-- Profile --}}
                            <li>
                                <a href="{{ route('user.settings.profile.edit') }}" class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="{{ request()->is('settings') ? 'font-bold' : '' }}">Profile</span>
                                </a>
                            </li>
        
                            {{-- Account --}}
                            <li>
                                <a href="" class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>Account</span>    
                                </a>
                            </li>
                            
                        </ul>
                    </div>
    
                    <section class="w-3/4">
                        {{ $slot }}
                    </section>
                    
                </main>
    
            </div>

        </div>            
    </body>
</html>
