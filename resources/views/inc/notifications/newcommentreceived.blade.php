<div class="flex items-start space-x-4 py-4 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
    
    <div class="flex-shrink-0">
        <a href="{{ route('user.profile', $notification->data['comment']['author']['username']) }}">
            <img src="https://eu.ui-avatars.com/api/?name="{{$notification->data['comment']['author']['username']}}" alt="user_avatar" class="rounded-full w-10 h-10">
        </a>
    </div>

    <div class="w-full">

        <section class="flex items-start justify-between">
            <div class="mb-1">
                <div class="flex items-center space-x-1">
                    <a href="{{ route('user.profile', $notification->data['comment']['author']['username']) }}">
                        <h2 class="text-base font-bold hover:text-gray-900">{{ $notification->data['comment']['author']['name'] }}</h2>
                    </a>
                    <div class="flex items-center space-x-1">
                        <span>ha commentato </span>
                        <a href="{{ route('user.profile.comment.show', [$notification->data['comment']['author']['username'], $notification->data['comment']['id'] ]) }}">
                            <h2 class="font-bold">"{{ Str::limit($notification->data['comment']['body'], 30, '...') }}"</h2>
                        </a>
                        <span> l'articolo </span>
                        <a href="{{ route('article.show', [$notification->data['article']['author']['username'], $notification->data['article']['slug'] ]) }}">
                            <h2 class="font-bold">"{{ Str::limit($notification->data['article']['title'], 30, '...') }}"</h2>
                        </a>
                    </div>
                </div>
                <span class="text-xs text-gray-600">{{ $notification->created_at->diffForHumans() }}</span>
            </div>

           @if ($notification->read_at === null)
           <form action="{{ route('user.notification.read', $notification->id) }}" method="post">
                @csrf
                <button type="submit" class="hover:text-green-500 transition duration-200 text-sm">
                    Segna come letto
                </button>
            </form>
           @endif
        </section>

    </div>
</div>