<x-app-layout>
    <div>
        <h4 class="font-bold text-xl">Edit Comment</h4>

        <form action="{{ route('article.comment.update', [$article->id, $comment->id]) }}" method="POST" class="flex items-start space-x-2 my-6">
    
            @method('PATCH')
            
            @csrf
            
            <div class="flex-shrink-0">
                <img src="https://eu.ui-avatars.com/api/?name="{{ $comment->author->name }}" alt="user_avatar" class="rounded-full w-8 h-8">
            </div>
        
            <div class="w-full">
                <textarea
                    name="body"
                    id="body"
                    class="w-full bg-gray-100 rounded border-0 resize-none"
                    placeholder="Add to the discussion"
                    rows="4">{{ $comment->body }}</textarea>

                    @error('body')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
        
                <div class="flex items-center space-x-4 mt-4">
                    <a href="{{ route('article.show', [$article->author->name, $article->slug]) }}" class="border-gray-400 border hover:border-gray-500 text-gray-600 rounded p-2 px-3 max-w-max">
                        Back
                    </a>

                    <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white rounded p-2 px-3 max-w-max">
                        Update
                    </button>
                </div>
            </div>
        
        </form>
    </div>
</x-app-layout>