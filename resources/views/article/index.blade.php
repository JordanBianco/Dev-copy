<x-app-layout>

    <div class="flex items-start space-x-4">
        
        <div class="w-1/3">
            @guest
            <div class="shadow rounded bg-white p-4 mb-2">
                <div>
                    <span class="text-lg font-extrabold text-indigo-700">DEV Community</span>
                    <span class="font-extrabold">is a community of 595,022 amazing developers</span>
                    <p class="my-2 text-gray-500">
                        We're a place where coders share, stay up-to-date and grow their careers.
                    </p>
                </div>

                <div class="flex flex-col space-y-2">

                    <a href="{{ route('register') }}">
                        <button class="bg-indigo-700 hover:bg-indigo-800 text-white rounded py-2 px-3 font-semibold w-full">
                            Create Account
                        </button>
                    </a>
                    
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-700 w-full text-center hover:bg-gray-50 px-3 py-1">Log in</a>
                </div>
            </div>                
            @endguest

            <div class="flex flex-col">

                <a href="{{ route('article.index') }}" class="flex items-center space-x-2 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Home</span>
                </a>
    
                <a href="{{ route('category.index') }}" class="flex items-center space-x-2 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span>Categories</span>
                </a>

                <a href="{{ route('dashboard.saved') }}" class="flex items-center space-x-2 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    <span>Reading List</span>
                </a>
            </div>
        
            @guest
            <h4 class="font-bold my-4">Popular Categories</h4>

            <ul class="h-64 overflow-y-auto">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->name) }}">
                        <li class="text-gray-600 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                            #{{ $category->name }}
                        </li>
                    </a>
                @endforeach
            </ul>
            @else 
            <h4 class="font-bold my-4">My Categories</h4>

            <ul class="h-64 overflow-y-auto">
                @foreach (auth()->user()->categories as $category)
                    <a href="{{ route('category.show', $category->name) }}">
                        <li class="text-gray-600 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                            #{{ $category->name }}
                        </li>
                    </a>
                @endforeach
            </ul>

            @endguest
        </div>
        
        <div class="space-y-3 w-full">
            @foreach ($articles as $article)
                @include('inc.single-article')
            @endforeach
        </div>

        {{-- Right side --}}
        <div class="w-1/3">
            right side
        </div>
    </div>

    
</x-app-layout>