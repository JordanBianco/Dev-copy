<div class="flex items-center justify-between py-4 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
    
    <div class="flex items-center space-x-4">

        <div class="flex-shrink-0">
            <a href="{{ route('user.profile', $notification->data['user']) }}">
                <img src="https://eu.ui-avatars.com/api/?name="{{$notification->data['user'] }}" alt="user_avatar" class="rounded-full w-10 h-10">
            </a>
        </div>

        <div>
            <a
                href="{{ route('user.profile', $notification->data['user'] ) }}"
                class="font-bold hover:text-blue-500">{{ $notification->data['user'] }}
            </a>
            <span>
                ha messo mi piace all'articolo
                <a
                    href="{{ route('article.show', [$notification->data['article']['author']['username'], $notification->data['article']['slug'] ]) }}"
                    class="font-bold hover:text-blue-500">
                        "{{ $notification->data['article']['title'] }}"
                </a>
            </span>
            <p class="text-xs text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
        </div>
    </div>

    @if ($notification->read_at === null)
    <form action="{{ route('user.notification.read', $notification->id) }}" method="post">
        @csrf
        <button type="submit" class="hover:text-green-500 transition duration-200 text-sm">
            Segna come letto
        </button>
    </form>
    @endif
</div>