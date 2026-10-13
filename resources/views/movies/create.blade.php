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
                <a href="movies/create">Add Movie</a>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! woohooooooooooo") }}
                </div>

                @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                    
                @endif

                <form method="POST" action="{{ route('movies.store') }}">
                    @csrf

                    <label for="">Title</label>
                    <input type="text" name="title">

                    <label for="">Director</label>
                    <input type="text" name="director">

                    <label for="">Rating</label>
                    <input type="number" name="rating">

                    <label for="">Status</label>
                    <select name="movie_status" id="status">
                        <option value="want to watch">want to watch</option>
                        <option value="watching">watching</option>
                        <option value="finished">finished</option>
                    </select>

                    <button type="submit">Save</button>

                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
