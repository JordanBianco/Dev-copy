<div class="flex items-start space-x-4 py-4 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
    
    <div class="flex-shrink-0">
        <a href="{{ route('user.profile', $notification->data['article']['author']['username']) }}">
            <img src="https://eu.ui-avatars.com/api/?name="{{$notification->data['article']['author']['username']}}" alt="user_avatar" class="rounded-full w-10 h-10">
        </a>
    </div>

    <div class="w-full">

        <section class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('user.profile', $notification->data['article']['author']['username']) }}">
                        <h2 class="text-base font-bold hover:text-gray-900">{{ $notification->data['article']['author']['name'] }}</h2>
                    </a>
                    <div class="flex items-center space-x-1">
                        <span>ha pubblicato un nuovo articolo </span>
                        <a href="{{ route('article.show', [$notification->data['article']['author']['username'], $notification->data['article']['slug'] ]) }}">
                            <h2 class="font-bold">"{{ $notification->data['article']['title'] }}"</h2>
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

        <form action="{{ route('saved.store', $notification->data['article']['id']) }}" method="POST">
            @csrf
            <button type="submit" class="bg-gray-200 hover:bg-gray-300 transition duration-200 text-sm px-3 py-1 rounded focus:outline-none">
                {{ auth()->user()->hasSaved($notification->data['article']['id']) ? 'Saved' : 'Save' }}
            </button>
        </form>

    </div>
</div>