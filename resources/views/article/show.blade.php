<x-app-layout>
    <div class="flex items-start space-x-6">

        <div class="w-28 py-10 flex justify-center">
            
            <div class="flex flex-col space-y-6">

                {{-- Heart --}}
                <div class="space-y-1 max-w-max">
                    <div title="Heart" class="p-2 rounded-full text-gray-600 hover:text-red-600 hover:bg-red-100 transition duration-300 cursor-pointer">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <span class="block text-sm text-center text-gray-600">14</span>
                </div>

                {{-- Saved --}}
                <div class="space-y-1 max-w-max">
                    <div title="Saved" class="p-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-100 transition duration-300 cursor-pointer">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    </div>
                    <span class="block text-sm text-center text-gray-600">10</span>
                </div>

            </div>
        </div>

        <div class="w-2/3 bg-white shadow rounded-lg py-8 px-12">
            
            <h2 class="font-extrabold text-6xl">{{ $article->title }}</h2>

            <div class="flex items-center space-x-2 text-sm my-3 text-gray-600">
                @foreach ($article->categories as $category)
                <a href="{{ route('category.show', $category->name) }}">
                    <span class="hover:text-blue-800 transition duration-300">#{{$category->name}}</span>
                </a>
                @endforeach
            </div>

            <div class="flex items-center space-x-4">

                <div class="flex items-center space-x-1">
                    <div class="flex-shrink-0">
                        <img src="https://eu.ui-avatars.com/api/?name="{{ $user->email }} alt="user_avatar" class="rounded-full w-8 h-8">
                    </div>
                    <h3 class="font-semibold">{{ $user->name }}</h3>
                </div>
                
                <span class="text-sm text-gray-600">{{ $article->created_at->format('M d') }}</span>

                <span class="text-sm text-gray-600">{{ readingTime($article->body) }} min read</span>

            </div>

            <div class="text-lg mt-10">
                {{ $article->body }}
            </div>

        </div>

        <div class="w-1/3 bg-white shadow rounded-lg">

            <div class="bg-green-700 p-4 rounded-t-lg"></div>

            <div class="p-4 py-2">
                <div class="flex items-baseline space-x-2 -mt-8 mb-3">
                    <div class="flex-shrink-0">
                        <img src="https://eu.ui-avatars.com/api/?name="{{ $user->email }} alt="user_avatar" class="rounded-full w-12 h-12">
                    </div>
                    <h4 class="text-lg font-bold -mt-2">{{ $user->name }}</h4>
                </div>
    
                <div class="text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam rerum obcaecati reiciendis consequuntur nobis, temporibus
                </div>

                <button class="w-full text-white font-semibold bg-indigo-700 hover:bg-indigo-800 py-2 my-4 transition duration-200 rounded">
                    Follow
                </button>
            </div>

            <div class="space-y-3 p-4 py-2">
                <div class="flex flex-col">
                    <span class="uppercase font-semibold text-xs text-gray-600 font-semibold">Work</span>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                </div>

                <div class="flex flex-col">
                    <span class="uppercase font-semibold text-xs text-gray-600 font-semibold">Location</span>
                    <span>London, UK</span>
                </div>

                <div class="flex flex-col">
                    <span class="uppercase font-semibold text-xs text-gray-600 font-semibold">Education</span>
                    <span>Columbia</span>
                </div>

                <div class="flex flex-col">
                    <span class="uppercase font-semibold text-xs text-gray-600 font-semibold">Work</span>
                    <span>{{ $user->created_at->format('d M Y') }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>