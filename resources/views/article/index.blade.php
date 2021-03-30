<x-app-layout>

    <div class="flex items-start space-x-4">
        
        <div class="w-1/3">

            <div class="flex flex-col">

                <div class="flex items-center space-x-2 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Home</span>
                </div>
    
                <a href="{{ route('category.index') }}" class="flex items-center space-x-2 hover:bg-gray-200 rounded p-2 hover:text-blue-800 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span>Tags</span>
                </a>
            </div>
        
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