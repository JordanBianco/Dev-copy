<x-dashboard-layout>
    <div class="bg-white p-6">
        <div class="space-y-3">
            @forelse (auth()->user()->articles as $article)
                @include('inc.single-article')
            @empty
            <div class="flex justify-center">
                <div>
                    <p class="text-lg mb-2">
                        This is where you can manage your posts, but you haven't written anything yet.
                    </p>
                    <a href="{{ route('article.create') }}" class="block text-center">
                        <button class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 max-w-max">
                            Write a post
                        </button>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>