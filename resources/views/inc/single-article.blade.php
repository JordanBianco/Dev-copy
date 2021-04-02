<div class="shadow-sm border border-gray-100 rounded bg-white p-4 flex items-start space-x-4">

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
                @foreach ($article->categories as $category)
                    <a href="{{ route('category.show', $category->name) }}">
                        <span class="hover:text-blue-800 transition duration-300">#{{$category->name}}</span>
                    </a>
                @endforeach
            </div>

            <div class="flex items-center justify-between">
                {{-- Interactions --}}
                <div class="flex items-center space-x-6">

                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span>{{ $article->likes_count + $article->users_count }} reactions</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        {{-- If ! 0 comments -- 3 comments  --}}
                        <span>Add comment</span> 
                    </div>
                    
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-xs">{{ readingTime($article->body) }} min read</span>
                    
                    @guest
                    <a href="{{ route('login') }}">
                        <button class="bg-gray-200 text-sm px-3 py-1 rounded focus:outline-none">
                            Save
                        </button>
                    </a>
                    @else
                        @if (auth()->id() !== $article->author->id)
                        <form action="{{ route('saved.store', $article->id) }}" method="POST">
                            
                            @csrf
                            
                            <button type="submit" class="bg-gray-200 text-sm px-3 py-1 rounded focus:outline-none">
                                {{-- {{ auth()->user()->savedArticles()->pluck('articles.id')->contains($article->id) ? 'Saved' : 'Save' }} --}}
                            </button>
                        </form>
                        @endif
                    @endguest
                    
                </div>
            </div>

        </div>
    </div>
</div>