<x-app-layout>
    <div>
        <h2 class="font-bold text-3xl">Top Categories</h2>

        <section class="my-4">

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                @foreach ($categories as $category)
                <div class="border border-gray-300 rounded-lg bg-white relative">
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

                    <button class="absolute bottom-4 left-4 bg-gray-200 hover:bg-gray-300 transtion duration-300 text-sm px-4 py-2 rounded focus:outline-none">
                        Follow
                    </button>
                </div>
                @endforeach

            </div>

        </section>
    </div>
</x-app-layout>