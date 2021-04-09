<x-profile-layout>
    <div class="w-3/4 mx-auto mt-6 border border-gray-200 shadow-sm rounded">
        
        <h2 class="text-2xl py-8 px-3 bg-gray-100">All {{ $user->comments->count() }} comments</h2>
        
        @foreach ($comments as $comment)
            <a href="{{ route('user.profile.comment.show', [$user->username, $comment->id]) }}" class="block p-3 border-b border-gray-100 hover:bg-gray-100">
                <h5 class="font-bold">{{ $comment->commentable->title ?? $comment->commentable->body }}</h5>
                
                <div class="flex items-center space-x-2 text-gray-500 text-sm">
                    <p>{{ Str::limit($comment->body, 60, '...') }}</p>
                    <p class="text-xs">{{ $comment->created_at->format('M d') }}</p>
                </div>
            </a>
        @endforeach
    </div>
</x-profile-layout>