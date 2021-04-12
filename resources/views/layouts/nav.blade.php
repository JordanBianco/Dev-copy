<nav class="flex items-center justify-between space-x-16 bg-white shadow-sm border-b px-6 border-gray-300 py-2">
    
    <div class="flex items-center space-x-2 w-1/3">
        <a href="{{ route('article.index') }}">
            <h1 class="font-bold text-xl bg-black hover:bg-gray-900 text-white p-1 tracking-tighter rounded">
                DEV
            </h1>
        </a>

        <div class="w-full">
            {{-- Component --}}
            <div class="flex items-center space-x-1">
                <input
                    placeholder="Search..."
                    type="text"
                    class="border-gray-300 border rounded p-2 px-4 w-full placeholder-gray-400 text-sm">
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center space-x-1 md:space-x-2">

        @auth
        <a href="{{ route('article.create') }}">
            <button class="bg-gray-900 hover:bg-black text-white text-sm rounded p-2 px-3 max-w-max">
                Write an article
            </button>
        </a>

        {{-- Notification --}}
        <a href="{{ route('user.notification') }}" title="Notifications" class="relative hover:bg-gray-100 {{ request()->is('notifications') ? 'bg-gray-200' : '' }} p-2 transition duration-200 rounded-full">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>

            @if (auth()->user()->unreadNotifications->count() > 0)
                <div class="absolute top-0 right-0 w-3 h-3 bg-blue-600 rounded-full"></div>                
            @endif
        </a>
        
        <a href="{{ route('dashboard.index') }}" title="Dashboard">
            <div class="flex-shrink-0">
                <img src="https://eu.ui-avatars.com/api/?name="{{ auth()->user()->name }}" alt="user_avatar" class="rounded-full w-8 h-8">
            </div>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="flex">
            @csrf
            <button title="Logout" type="submit">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:bg-gray-50 px-3 py-2">Log in</a>
        
        <a href="{{ route('register') }}">
            <button class="bg-indigo-700 hover:bg-indigo-800 text-white rounded p-2 px-3 font-semibold max-w-max">
                Create Account
            </button>
        </a>
        @endauth
            
    </div>

</nav>