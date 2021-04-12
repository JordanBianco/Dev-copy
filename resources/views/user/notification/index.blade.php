<x-profile-layout>
    <div class="w-3/4 mx-auto py-4">
        
        <h2 class="font-bold text-3xl mb-8">Notifications</h2>

            <div>
                <h4 class="mb-6 font-bold text-gray-500">Hai <span>({{ auth()->user()->unreadnotifications->count() }}) nuove notifiche</span></h4>
                @foreach (auth()->user()->unreadnotifications as $notification)
                    @include('inc.notifications.'. Str::lower(class_basename($notification->type)))
                @endforeach

                @if (auth()->user()->unreadnotifications->count() > 0)
                    <form action="{{ route('user.notification.readAll') }}" method="post" class="pt-4 flex justify-end border-t border-gray-200">
                        @csrf
                        <button type="submit" class="hover:text-green-500 transition duration-200 text-sm">
                            Segna tutti come letto
                        </button>
                    </form>
                @endif
            </div>

            @if (auth()->user()->readnotifications->count() > 0)
            <hr class="my-10">

                <div>
                    <h4 class="mb-2 font-bold text-lg">Lette</h4>
                    @foreach (auth()->user()->readnotifications as $notification)
                        @include('inc.notifications.'. Str::lower(class_basename($notification->type)))
                    @endforeach
                </div>
            @endif
    </div>
</x-profile-layout>