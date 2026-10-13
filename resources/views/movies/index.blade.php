<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('movies.create') }}">Add Movie</a>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! woohooooooooooo") }}
                </div>

                @foreach ($movies as $movie)
                    <p>{{ $movie->title }}</p>
                    <a href="{{ route('movies.edit', $movie->id) }}">Update</a>
                    <a href="{{ route('movies.show', $movie->id) }}">Show Details</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                @endforeach
            </div>

            
        </div>
    </div>

    


</x-app-layout>
