<x-guest-layout>
    
    <header class="flex items-center justify-between px-6 py-2">
        <div class="flex items-center space-x-2">
            <h1 class="font-bold text-xl bg-black hover:bg-gray-900 text-white p-1 tracking-tighter rounded">
                <a href="{{ route('article.index') }}">DEV</a>
            </h1>
    
            <span>Write a new post</span>
        </div>

        <a href="{{ route('article.index') }}">
            <button class="p-2 hover:bg-gray-100 transition duration-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </a>
    </header>
   
    <div class="w-2/3 mx-auto">

        <form action="{{ route('article.store') }}" method="POST">

            @csrf

            <div class="shadow p-10 rounded border">

                @if ($errors->any())
                    <div class="bg-red-100 p-4 rounded">
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    class="text-4xl w-full placeholder-gray-500 font-bold border-0 focus:outline-none mb-6"
                    placeholder="New post title here...">
                

                <p class="text-sm text-gray-500text-sm">Seleziona fino a 4 categorie</p>
                <select multiple size="5" name="categories[]" class="w-full mb-6">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <textarea
                    name="body"
                    placeholder="Write your article content here..."
                    class="text-xl resize-none w-full placeholder-gray-400 border-0 focus:outline-none mb-6""
                    rows="6">{{ old('title') }}</textarea>

            </div>

            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white rounded p-2 px-3 max-w-max mt-4">
                Publish
            </button>

        </form>

   </div>
</x-guest-layout>