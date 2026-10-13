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
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                    @csrf
                    @method('PUT')

                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ old('title', $movie->title) }}">

                    <label for="">Director</label>
                    <input type="text" name="director" value="{{ old('director', $movie->director) }}">

                    <label for="">Rating</label>
                    <input type="number" name="rating" value="{{ $rating }}">

                    <label for="">Status</label>
                    <select name="movie_status" id="status">

                        {{-- @foreach ($statuses as $status)
                            @if ($status === $movie_status)
                                @php
                                    $item = array_search($statuses, $status);


                                @endphp
                            @endif
                        @endforeach --}}

                        {{-- @foreach ($statuses as $status)
                            @if ($status === $movie_status)
                                @php
                                    $item = array_search($status, $statuses);
                                    unset($statuses[$item]);
                                @endphp
                                <option selected>{{ $status }}</option>
                            @endif
                        @endforeach --}}

                        @foreach ($statuses as $status)
                            @if ($status === $movie_status)
                                <option selected >{{ $movie_status }}</option>
                            @else
                                <option value="{{ $status }}">{{ $status }}</option>    
                            @endif
                        @endforeach

                        
                        
                        {{-- @if ( $movie_status  === App\MovieStatus::WantToWatch() )
                            <option selected value="want to watch">want to watch</option>
                        @endif --}}

                        {{-- @if ($movie_status === App\MovieStatus::WantToWatch->value)
                            <option selected value="want to watch">want to watch</option>
                            <option value="watching">watching</option>
                            <option value="finished">finished</option>
                        @elseif ($movie_status === App\MovieStatus::Watching->value)
                            <option selected value="watching">watching</option>
                            <option value="want to watch">want to watch</option>
                            <option value="finished">finished</option>
                        @elseif ($movie_status === App\MovieStatus::Finished->value)
                            <option selected>finished</option>
                            <option value="want to watch">want to watch</option>
                            <option value="watching">watching</option>    
                        @endif --}}

                        {{-- @foreach (array_column(MovieStatus::cases(), 'value') $status)
                            <p>{{ $status }}</p>
                        @endfor --}}

                        


                        {{-- <option value="want to watch">want to watch</option>
                        <option value="watching">watching</option>
                        <option value="finished">finished</option> --}}

                        {{-- <option value="want to watch">want to watch</option>
                        <option value="watching">watching</option>
                        <option value="finished">finished</option> --}}
                        
                    </select>

                    <p>{{ $movie_status }}</p>
                    {{-- @foreach ($statuses as $status)
                        <p>{{ $status }}</p>
                    @endforeach --}}
                    @dump($statuses);

                    

                    
                    

                    <button type="submit">Update</button>

                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
