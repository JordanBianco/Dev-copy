<x-app-layout>
    <div class="w-3/5 mx-auto">
        <h4 class="font-bold text-xl mb-6">Reply to {{ $comment->author->name }}</h4>

        <div class="w-full bg-gray-100 rounded border-0 p-6">
            {{ $comment->body }}
        </div>

        <form action="" method="POST" class="mt-10 pt-10 border-t border-gray-200 flex items-start space-x-2">
                                    
            @csrf
                    
            <div class="flex-shrink-0">
                <img src="https://eu.ui-avatars.com/api/?name="{{auth()->user()->name}}" alt="user_avatar" class="rounded-full w-8 h-8">
            </div>
                
            <div class="w-full">
                <textarea
                    name="body"
                    id="body"
                    class="w-full bg-gray-100 rounded border-0 resize-none"
                    placeholder="Reply to {{$comment->author->name}}"
                    rows="4"></textarea>

                    @error('body')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
        
                <div class="flex items-center space-x-4 mt-4">
                    <a href="{{ route('article.show', [$article->author->name, $article->slug]) }}" class="border-gray-400 border hover:border-gray-500 text-gray-600 rounded p-2 px-3 max-w-max">
                        Back
                    </a>

                    <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white rounded p-2 px-3 max-w-max">
                        Reply
                    </button>
                </div>
            </div>
                
        </form>
    </div>
</x-app-layout>