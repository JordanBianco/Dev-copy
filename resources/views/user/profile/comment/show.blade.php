<x-profile-layout>
    <div class="w-3/4 mx-auto mt-6 border border-gray-200 shadow-sm p-4 rounded">
        
        <h2 class="mb-4 text-2xl">Discussion on: <span class="font-bold">{{ $comment->commentable->title ?? $comment->commentable->commentable->title }}</span></h2>
        
        {{-- Se il commento è riferito ad un articolo --}}
        @if ($comment->commentable_type === 'App\Models\Article')
            <a href="{{ route('article.show', [$comment->commentable->author->username, $comment->commentable->slug]) }}">
                <button class="p-2 border border-gray-400 hover:border-gray-500 transition duration-200 rounded text-sm">View post</button>
            </a>

            @include('inc.single-comment', ['article' => $comment->commentable])

        {{-- Se riferito ad una reply --}}
        @else 
            <a href="{{ route('article.show', [$comment->commentable->commentable->author->username, $comment->commentable->commentable->slug]) }}">
                <button class="p-2 border border-gray-400 hover:border-gray-500 transition duration-200 rounded text-sm">View post</button>
            </a>

            <div class="my-6">
                <span class="text-lg">Replies for: <span class="font-bold text-2xl">{{ $comment->commentable->body }}</span></span>
            </div>

            @include('inc.single-comment', ['article' => $comment->commentable->commentable])

        @endif
    </div>
</x-profile-layout>