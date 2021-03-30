<x-app-layout>
    <div>
        <header class="w-full shadow rounded-lg bg-white my-6">
            <div class="bg-red-400 rounded-t-lg py-2"></div>

            <div class="flex items-center justify-between space-x-16 p-6">

                <div>
                    <h2 class="font-bold text-3xl">{{ $category->name }}</h2>
                    <p class="mt-4">{{ $category->description }}</p>
                </div>

                <button class="bg-indigo-600 hover:bg-indigo-700 transtion duration-300 text-sm px-4 text-white py-2 rounded focus:outline-none">
                    Follow
                </button>

            </div>
        </header>

        <div class="flex items-start space-x-4">
            <div class="w-1/3">

                {{-- Moderator --}}
                <div class="border-b border-gray-300">

                    <h4 class="font-bold text-sm">Category Moderator</h4>

                    <div class="flex-shrink-0 mt-2 mb-6">
                        {{-- {{ $category->moderator }} --}}
                        <img src="https://eu.ui-avatars.com/api/?name="" alt="user_avatar" class="rounded-full w-12 h-12">
                    </div>

                </div>

                <p class="py-4">{{ $articles->count() }} Articles Published</p>

            </div>

            <div class="w-full">
                @foreach ($articles as $article)
                    @include('inc.single-article')
                @endforeach
            </div>

            <div class="w-1/3">
                <span class="text-sm semibold mb-2 block">#discuss</span>

                <ul>
                    @foreach ($latestArticles as $article)
                        <li class="hover:bg-gray-50 p-4 hover:text-blue-800 space-y-2 cursor-pointer">
                            <a href="{{ route('article.show', [$article->author->name, $article->slug]) }}">
                                {{ $article->title }}
                            </a>

                            <div class="bg-indigo-700 text-white text-xs rounded p-1 max-w-max">
                                New
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        
    </div>
</x-app-layout>