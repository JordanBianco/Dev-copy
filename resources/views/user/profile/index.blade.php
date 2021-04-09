<x-profile-layout>
    <header>
        <div class="bg-indigo-500 h-32 w-full"></div>

        <div class="w-3/4 mx-auto">

            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-6 text-center space-y-4 -mt-14 relative">
                
                <div class="flex-shrink-0 -mt-20 flex justify-center">
                    <img src="https://eu.ui-avatars.com/api/?name="{{ $user->name }}" alt="user_avatar" class="rounded-full w-32 h-32 border-8 border-indigo-500">
                </div>

                @if (auth()->id() === $user->id)
                <a href="{{ route('user.settings.profile.edit') }}">
                    <button class="absolute top-2 right-6 bg-gray-900 hover:bg-black text-white rounded p-2 px-5 max-w-max">
                        Edit Profile
                    </button>
                </a>
                @else
                <form action="{{ route('user.follow', $user->username) }}" method="post">
                    @csrf

                    <button
                        type="submit"
                        class="absolute top-2 right-6 bg-gray-900 hover:bg-black text-white rounded p-2 px-5 max-w-max">
                            {{ Auth::check() && auth()->user()->isFollowing($user->id) ? 'Following' : 'Follow' }}
                    </button>
                </form>
                @endif

                <h2 class="font-bold text-3xl text-center">{{ $user->name }}</h2>
                <p class="text-lg">{{ $user->profile->bio ?? '404 bio not found'  }}</p>
                
                <div class="flex justify-center items-center">
                    <div class="flex items-center space-x-1">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg>
                        <p class="text-gray-500 font-bold text-sm">Joined on {{ $user->created_at->format('d M Y') }}</p>                    
                    </div>
                </div>
                
            </div>

        </div>
    </header>

    <main class="mt-3 flex items-start space-x-3 w-3/4 mx-auto">

        <div class="w-1/3 bg-white shadow-sm border border-gray-200 rounded-lg p-4">
            
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>{{ $user->articles->count() }} articles published</span>
                </div>
    
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <span>{{ $user->comments->count() }} comments written</span>
                </div>
    
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                    <span>{{ $user->categories->count() }} tags followed</span>
                </div>
            </div>

        </div>

        <div class="w-2/3">
            @if ($comments->count() > 0)
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg mb-3">

                <h4 class="text-lg font-bold mb-2 p-2">Recent Comments</h4>

                <ul>
                @foreach ($comments as $comment)
                    <a href="{{ route('user.profile.comment.show', [$user->username, $comment->id]) }}" class="block p-3 border-b border-gray-100 hover:bg-gray-100">
                        <h5 class="font-bold">{{ $comment->commentable->title ?? $comment->commentable->body }}</h5>
                        
                        <div class="flex items-center space-x-2 text-gray-500 text-sm">
                            <p>{{ Str::limit($comment->body, 60, '...') }}</p>
                            <p class="text-xs">{{ $comment->created_at->format('M d') }}</p>
                        </div>
                    </a>
                @endforeach

                @if ($comment->count() >= 9)
                    <a
                        href="{{ route('user.profile.comment.index', $user->username) }}"
                        class="block text-blue-700 text-sm px-2 py-4">View all {{ $user->comments->count() }} comments</a>                    
                @endif

                </ul>
            </div>
            @endif

            @foreach ($user->articles as $article)
                @include('inc.single-article')
            @endforeach
        </div>

    </main>
</x-profile-layout>