<div class="flex items-start space-x-1 my-6">

    <div class="flex-shrink-0 mt-2">
        <img src="https://eu.ui-avatars.com/api/?name="{{ $comment->author->name }}" alt="user_avatar" class="rounded-full w-8 h-8">
    </div>

    <div class="w-full">
        <section class="rounded border border-gray-100 shadow-sm px-3 py-4">
            <header class="flex items-center space-x-2">

                <span class="font-bold">{{ $comment->author->name }}</span>
                @if ($article->author->id === $comment->author->id)
                <div title="author" class="bg-indigo-800 w-2 h-2 rounded-full"></div>
                @endif

                <span class="text-xs text-gray-400">&bull;</span>

                @if ($comment->created_at != $comment->updated_at)
                <span class="text-gray-600">Edited {{ $comment->updated_at->format('M d') }}</span>
                @else 
                <span class="text-gray-600">{{ $comment->created_at->format('M d') }}</span>
                @endif

            </header>

            <div class="text-lg my-3">
                {{ $comment->body }}
            </div>

            <div class="flex items-center space-x-4">
                @if (auth()->id() == $comment->author->id)
                    <form action="{{ route('article.comment.destroy', [$article->id, $comment->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        
                        <button type="submit" title="delete">
                            <svg class="w-5 h-5 cursor-pointer text-gray-400 hover:text-gray-500 transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>

                    <a title="edit" href="{{ route('article.comment.edit', [$article->slug, $comment->id]) }}">
                        <svg class="w-5 h-5 mb-1 cursor-pointer text-gray-400 hover:text-gray-500 transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                @endif

                <a href="{{ route('comment.reply.create', [$article->slug, $comment->id]) }}">
                    <span class="text-blue-500 hover:underline">Reply</span>
                </a>
            </div>
        </section>

        <footer class="m-2 ml-4">
            <div class="flex items-center justify-between">
                {{-- Interactions --}}
                <div class="flex items-center space-x-6">

                    <div class="flex items-center space-x-2">
                        <form action="{{ route('comment.like.store', $comment->id) }}" method="post">
                            @csrf
                            <button type="submit">
                                <svg class="w-5 h-5 {{ $comment->hasBeenLikedByAuthUser() ? 'text-red-600' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </form>
                        <span>{{$comment->likes->count() }} likes</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span>{{ $comment->comments->count() }} Reply</span> 
                    </div>

                </div>
            </div>
        </footer>

    </div>
</div>