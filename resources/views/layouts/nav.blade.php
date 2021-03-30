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

        <a href="{{ route('login') }}" class="font-semibold text-indigo-700 hover:bg-gray-50 px-3 py-2">Log in</a>

        <button class="bg-indigo-700 hover:bg-indigo-800 text-white rounded p-2 px-3 font-semibold max-w-max">
            <a href="{{ route('register') }}">
                Create Account
            </a>
        </button>

    </div>

</nav>