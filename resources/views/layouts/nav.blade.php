<nav class="flex items-center justify-between space-x-16 bg-white shadow-sm border-b px-6 border-gray-300 py-2">
    
    <div class="flex items-center space-x-2 w-1/3">
        <h1 class="font-bold text-xl bg-black hover:bg-gray-900 text-white p-1 tracking-tighter rounded">
            <a href="{{ route('article.index') }}">DEV</a>
        </h1>

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
    <div class="flex items-center space-x-1 md:space-x-3">

        @guest
        <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:bg-gray-50 px-3 py-2">Log in</a>

        
        <a href="{{ route('register') }}">
            <button class="bg-indigo-700 hover:bg-indigo-800 text-white rounded p-2 px-3 font-semibold max-w-max">
                Create Account
            </button>
        </a>
        @else
        <a href="{{ route('article.create') }}">
            <button class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 max-w-max">
                Write a post
            </button>
        </a>

        <a href="{{ route('dashboard.index') }}">
            <div class="flex-shrink-0">
                <img src="https://eu.ui-avatars.com/api/?name="{{ auth()->user()->name }}" alt="user_avatar" class="rounded-full w-10 h-10">
            </div>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endguest
        
        
    </div>

</nav>