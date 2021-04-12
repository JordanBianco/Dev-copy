<x-settings-layout>

    {{-- User Account Info --}}
    <form action="{{ route('user.settings.update') }}" method="POST" class="bg-white shadow-sm border p-6 border-gray-200 rounded-lg mb-10">

        @method('PATCH')

        @csrf
        <h3 class="font-bold text-2xl mb-8">User</h3>

        <div class="mb-6">
            <label for="name" class="block font-bold mb-1">Name</label>
            <input
                name="name"
                type="text"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->name }}"
                >
                @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block font-bold mb-1">Email</label>
            <input
                name="email"
                type="email"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->email }}"
                >
                @error('email')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="username" class="block font-bold mb-1">Username</label>
            <input
                name="username"
                type="text"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->username }}"
                >
                @error('username')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <button type="submit" class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 w-full">
            Save User Info
        </button>
    </form>

    {{-- User Profile Info --}}
    <form action="{{ route('user.settings.update-profile') }}" method="POST" class="bg-white shadow-sm border p-6 border-gray-200 rounded-lg mb-10">

        @method('PATCH')

        @csrf

        <h3 class="font-bold text-2xl mb-8">Profile</h3>

        <div class="mb-6">
            <label for="bio" class="block font-bold mb-1">Bio</label>
            <textarea
                name="bio"
                rows="2"
                placeholder="A short bio..."
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300">{{ auth()->user()->bio }}</textarea>
                @error('bio')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="website_url" class="block font-bold mb-1">Website</label>
            <input
                name="website_url"
                type="text"
                placeholder="https://yoursite.com"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->profile->website_url }}">
                @error('website_url')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="location" class="block font-bold mb-1">Location</label>
            <input
                name="location"
                type="text"
                placeholder="Rome, Italy"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->profile->location }}">
                @error('location')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
        </div>

        <button type="submit" class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 w-full">
            Save User Info
        </button>
    </form>

    <div class="bg-white shadow-sm border p-6 py-10 border-gray-200 rounded-lg mb-10 flex items-center space-x-4">
        
        <form action="{{ route('user.delete', auth()->id()) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm border text-red-500 border-red-500 p-2 px-4 rounded hover:bg-red-500 hover:text-white transition duration-200">
                DELETE ACCOUNT
            </button>
        </form>

        <p class="text-gray-600">Attenzione! Questa azione è irreversibile</p>
    </div>

    {{-- <form action="{{ route('user.settings.update-skills') }}" method="POST" class="bg-white shadow-sm border p-6 border-gray-200 rounded-lg mb-10">

        @method('PATCH')

        @csrf

        <h3 class="font-bold text-2xl mb-8">Coding</h3>

        <div class="mb-6">
            <label for="bio" class="block font-bold mb-1">Bio</label>
            <textarea
                name="bio"
                rows="2"
                placeholder="A short bio..."
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300">{{ auth()->user()->bio }}</textarea>
        </div>

        <div class="mb-6">
            <label for="website_url" class="block font-bold mb-1">Website</label>
            <input
                name="website_url"
                type="text"
                placeholder="https://yoursite.com"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->profile->website_url }}"
                >
        </div>

        <div class="mb-6">
            <label for="location" class="block font-bold mb-1">Location</label>
            <input
                name="location"
                type="text"
                placeholder="Rome, Italy"
                class="bg-gray-100 rounded p-2 px-3 border border-gray-100 w-full hover:border-gray-300"
                value="{{ auth()->user()->profile->location }}"
                >
        </div>

        <button type="submit" class="bg-gray-900 hover:bg-black text-white rounded p-2 px-3 w-full">
            Save User Info
        </button>
    </form> --}}

    </div>
</x-profile-layout>