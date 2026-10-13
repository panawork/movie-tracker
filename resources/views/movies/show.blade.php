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

                <p>{{ $movie->title }}</p>
                <p>{{ $movie->director }}</p>
                <p>{{ $movie->Rating }}</p>
                <p>{{ $movie->movie_status }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
