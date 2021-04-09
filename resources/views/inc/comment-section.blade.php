<div class="flex items-center justify-between mb-6">
    <h3 class="font-bold text-2xl">Discussion ({{ $article->comments->count() }})</h3>

    <button class="border rounded border-gray-300 text-sm font-semibold focus:outline-none px-4 py-2">
        Subscribe
    </button>
</div>

@auth
<form action="{{ route('article.comment.store', $article->id) }}" method="post" class="flex items-start space-x-2 mb-6">
    
    @csrf
    
    <div class="flex-shrink-0">
        <img src="https://eu.ui-avatars.com/api/?name="{{ auth()->user()->name }}" alt="user_avatar" class="rounded-full w-8 h-8">
    </div>

    <div class="w-full">
        <textarea
        name="body"
        id="body"
        class="w-full bg-gray-100 rounded border-0 resize-none"
        placeholder="Add to the discussion"
        rows="4"></textarea>

        <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white rounded p-2 px-3 max-w-max">
            Submit
        </button>
    </div>

</form>
@else
    <div class="mb-6">
        <a href="{{ route('login') }}">Devi essere loggato per partecipare alla discussione.</a>
    </div>
@endauth
    
<div>
    @foreach ($article->comments as $comment)

        @include('inc.single-comment')

        @if ($comment->comments->count() > 0)
            @foreach ($comment->comments as $reply)
                <div class="w-11/12 ml-auto">
                    <div class="flex items-start space-x-1 my-4">

                        <div class="flex-shrink-0 mt-2">
                            <a href="{{ route('user.profile', $reply->author->username) }}">
                                <img src="https://eu.ui-avatars.com/api/?name="{{ $reply->author->name }}" alt="user_avatar" class="rounded-full w-8 h-8">
                            </a>
                        </div>
                    
                        <div class="w-full">
                            <section class="rounded border border-gray-100 shadow-sm px-3 py-4">
                                <header class="flex items-center space-x-2">
                    
                                    <a href="{{ route('user.profile', $reply->author->username) }}">
                                        <span class="font-bold">{{ $reply->author->name }}</span>
                                    </a>

                                    @if ($article->author->id === $reply->author->id)
                                    <div title="author" class="bg-indigo-800 w-2 h-2 rounded-full"></div>
                                    @endif
                    
                                    <span class="text-xs text-gray-400">&bull;</span>
                    
                                    @if ($reply->created_at != $reply->updated_at)
                                    <span class="text-gray-600">Edited {{ $reply->updated_at->format('M d') }}</span>
                                    @else 
                                    <span class="text-gray-600">{{ $reply->created_at->format('M d') }}</span>
                                    @endif
                    
                                </header>
                                <p class="text-sm text-gray-600">@ replied to {{ $comment->author->name }}</p>
                    
                                <div class="text-lg my-3">
                                    {{ $reply->body }}
                                </div>
                    
                                <div class="flex items-center space-x-4">
                                    @if (auth()->id() == $reply->author->id)
                                        <form action="{{ route('article.comment.destroy', [$article->id, $reply->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            
                                            <button type="submit" title="delete">
                                                <svg class="w-5 h-5 cursor-pointer text-gray-400 hover:text-gray-500 transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                    
                                        <a title="edit" href="{{ route('article.comment.edit', [$article->slug, $reply->id]) }}">
                                            <svg class="w-5 h-5 mb-1 cursor-pointer text-gray-400 hover:text-gray-500 transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                    @endif
                               </div>
                            </section>
                    
                            <footer class="m-2 ml-4">
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('comment.like.store', $reply->id) }}" method="post">
                                        @csrf
                                        <button type="submit">
                                            <svg class="w-5 h-5 {{ $reply->hasBeenLikedByAuthUser() ? 'text-red-600' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                    </form>
                                    <span>{{$reply->likes->count()}} likes</span>
                                </div>
                            </footer>
                    
                        </div>
                    </div>
                </div>
            @endforeach            
        @endif
    @endforeach
</div>