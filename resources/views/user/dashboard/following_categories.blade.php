<x-dashboard-layout>
    <div class="bg-white p-6">
        <div class="space-y-3">

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @forelse (auth()->user()->categories as $category)

                <div class="shadow rounded-lg bg-white relative">
                    <div class="bg-red-400 rounded-t-lg py-2"></div>

                    <div class="p-4 mb-20">
                        <a href="{{ route('category.show', $category->name) }}" class="font-bold text-lg hover:text-blue-800 transition duration-300">
                            #{{ $category->name }}
                        </a>

                        <p class="mt-4 mb-2">
                            {{ $category->description }}
                        </p>

                        <span class="text-sm text-gray-500">{{ $category->articles_count }} posts published</span>    
                    </div>

                    <form action="{{ route('category.follow', $category->name) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="absolute bottom-4 left-4 transtion duration-300 text-sm px-4 py-2 rounded focus:outline-none
                            {{ $category->users->pluck('id')->contains(auth()->id()) ? 'text-white bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-200 hover:bg-gray-300' }}
                            ">
                                {{ $category->users->pluck('id')->contains(auth()->id()) ? 'Following' : 'Follow' }}
                        </button>    
                    </form>
                </div>

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
    </div>
</x-dashboard-layout>