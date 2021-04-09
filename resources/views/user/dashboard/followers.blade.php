<x-dashboard-layout>
    <div class="grid grid-cols-3 gap-4">
        @forelse ($followers as $user)
            <div class="border border-gray-100 rounded shadow-sm bg-white flex justify-center pt-6 py-10">
                
                <div class="space-y-1">
                    <div class="flex-shrink-0 flex justify-center">
                        <a href="{{ route('user.profile', $user->username) }}">
                            <img src="https://eu.ui-avatars.com/api/?name="{{ $user->username }}" alt="user_avatar" class="rounded-full w-14 h-14">
                        </a>
                    </div>
                
                    <div>
                        <span class="text-blue-800 text-center font-bold block text-lg">{{ $user->name }}</span>
                        <span class="text-gray-500 text-center block text-sm">{{ '@' . $user->username }}</span>
                    </div>
                </div>

            </div>
        @empty

            <p class="text-center text-lg">You don't have any followers yet...</p>

        @endforelse
    </div>
</x-dashboard-layout>