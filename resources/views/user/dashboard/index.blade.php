<x-dashboard-layout>
    <div class="bg-white p-6">

        <div class="space-y-3">
            @forelse ($articles as $article)
                <div class="shadow-sm border border-gray-200 rounded bg-white p-4 flex items-start space-x-4">

                    <div class="flex-shrink-0">
                        <img src="https://eu.ui-avatars.com/api/?name="{{ auth()->user()->name }}" alt="user_avatar" class="rounded-full w-10 h-10">
                    </div>
                
                    <div class="w-full">
                        <div class="mb-1">                            
                            <h2 class="-mb-1 text-sm">{{ auth()->user()->name }}</h2>
                            <span class="text-xs text-gray-600">{{ $article->created_at->format('M d') }}</span>
                        </div>
                
                        <div>
                            <a href="{{ route('article.show', [auth()->user()->name, $article->slug]) }}">
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
                                        <span>{{ $article->comments_count === 0 ? 'Add comment' :  $article->comments_count . ' comments' }}</span> 
                                    </div>
                                    
                                </div>
                
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="uppercase text-gray-500 hover:text-red-600 transition duration-200 text-sm">
                                            Delete
                                        </button>
                                    </form>

                                    <span class="text-gray-600 text-xs">{{ readingTime($article->body) }} min read</span>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
            @empty
            <div class="flex justify-center">
                <div>
                    <p class="text-lg mb-2">
                        This is where you can manage your articles, but you haven't written anything yet.
                    </p>
                    <a href="{{ route('article.create') }}" class="block text-center">
                        <button class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 max-w-max">
                            Write an article
                        </button>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>