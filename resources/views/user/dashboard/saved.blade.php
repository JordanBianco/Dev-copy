<x-dashboard-layout>
    <div>

        <h2 class="font-bold text-2xl mb-6">Reading List ({{ $articles->count() }})</h2>

        <div class="p-6 bg-white border shadow border-gray-300">
            @forelse ($articles as $article)
                <div class="flex items-start justify-between my-6">

                    {{-- Left Side --}}
                    <div class="flex items-start space-x-4">

                        <div class="flex-shrink-0 -mt-1">
                            <img src="https://eu.ui-avatars.com/api/?name="{{ $article->author->username }}" alt="user_avatar" class="rounded-full w-8 h-8">
                        </div>

                        <div>
                            <a href="{{ route('article.show', [$article->author->username, $article->slug]) }}">
                                <h2 class="font-bold text-xl">{{ $article->title }}</h2>
                            </a>

                            <div class="flex items-center space-x-1 mt-1">
                                <h3 class="font-bold text-sm">{{ $article->author->username }}</h3>

                                <span class="text-gray-400 text-xs">&bull;</span>

                                <span class="text-sm text-gray-500">{{ $article->created_at->format('M d') }}</span>

                                <span class="text-gray-400 text-xs">&bull;</span>

                                <span class="text-gray-500 text-sm">{{ readingTime($article->body) }} min read</span>
                            
                                <span class="text-gray-400 text-xs">&bull;</span>

                                <div class="space-x-1">
                                    @foreach ($article->categories as $category)
                                        <a href="{{ route('category.show', $category->name) }}">
                                            <span class="hover:text-blue-800 text-gray-500 transition duration-300">#{{$category->name}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Right Side --}}
                    <div>
                        <span class="text-gray-500 text-sm">Archive</span>
                    </div>

                </div>
            @empty
                <div>
                    <h2 class="text-center text-lg font-bold">Your reading list is empty</h2>
                    <p class="text-center text-lg">Click the <span class="font-bold">bookmark reaction</span> when viewing a post to add it to your reading list.</p>
                </div>
            @endforelse
        </div>
        

    </div>
</x-dashboard-layout>