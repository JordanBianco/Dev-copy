<x-app-layout>

    <div class="flex items-start space-x-4">
        
        <div class="w-96">

            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Home</span>
            </div>
        
        </div>
        
        <div class="space-y-3 w-full">
            @foreach ($articles as $article)
                <div class="border border-gray-300 rounded bg-white p-4 flex items-start space-x-4">

                    <div class="flex-shrink-0">
                        <img src="https://eu.ui-avatars.com/api/?name="{{ $article->author->name }}" alt="user_avatar" class="rounded-full w-10 h-10">
                    </div>

                    <div class="w-full">
                        <div class="mb-1">                            
                            <h2 class="-mb-1 text-sm">{{ $article->author->name }}</h2>
                            <span class="text-xs text-gray-600">{{ $article->created_at->format('M d') }}</span>
                        </div>

                        <div>
                            <a href="{{ route('article.show', [$article->author->name, $article->slug]) }}">
                                <h2 class="font-bold text-2xl">{{ $article->title }}</h2>
                            </a>

                            <div class="flex text-sm items-center space-x-2 my-3 text-gray-600">
                                <span>#career</span>
                                <span>#webdev</span> 
                            </div>

                            <div class="flex items-center justify-between">
                                {{-- Interactions --}}
                                <div class="flex items-center space-x-6">

                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        <span>7 reactions</span>
                                    </div>
    
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        {{-- If ! 0 comments -- 3 comments  --}}
                                        <span>Add comment</span> 
                                    </div>
                                    
                                </div>

                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-600 text-xs">2 min read</span>
                                    <button class="bg-gray-200 text-sm px-3 py-1 rounded focus:outline-none">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                    
                </div>
            @endforeach
        </div>

        {{-- Right side --}}
        <div class="w-96">
            right side
        </div>
    </div>

    
</x-app-layout>