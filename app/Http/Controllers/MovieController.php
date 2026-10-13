<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MovieManager;
use App\MovieStatus;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Http;
//use MovieStatus;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::where('user_id', auth()->id())->get();

        $title = "hunger games";

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MovieManager $manager)
    {

        $userId = Auth::id();

        $request->validate([
            'title' => ['required', 'unique:movies', 'max:25'],
            'director' => ['required', 'max:25', 'alpha'],
            'rating' => ['required', 'lte:10', 'integer'],
            'movie_status' => 'required',
        ]);

        // Movie::create([
        //     'user_id' => $userId,
        //     'title' => $request->title,
        //     'director' => $request->director,
        //     'rating' => $request->rating,
        //     'movie_status' => $request->movie_status,
        // ]);

        $movie = $request->title;

        // $response = Http::get('http://www.omdbapi.com/?apikey=83cf5c09&', [
        //     't' => 'hunger+games',
        // ]);
        #$response = Http::get('http://ww.omdbapi.com/?apikey=83cf5c09&t={hunger games}');

        $response = Http::withUrlParameters([
            'title' => $movie,
        ])->get('http://www.omdbapi.com/?apikey=83cf5c09&t={title}');


        dump($response);
        $data = $response->json();

        dump($data);

        $genre = $response->json('Poster');
        dump($genre);

        $manager->create([
            'user_id' => $userId,
            'title' => $request->title,
            'director' => $request->director,
            'rating' => $request->rating,
            'movie_status' => $request->movie_status,
        ]);



        return redirect()->route('movies.index')->with('success', 'Movie added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieManager $manager, $id)
    {
        #$movie = Movie::findOrFail($id);

        // try {
        //     $movie = Movie::findOrFail($id);
        // } catch (Exception $e) {
        //     dd($e);
        // }






        $movie = $manager->show_data($id);

        if ($movie == False) {
            return view('movies.404');
        } else {
            return view('movies.show', compact('movie'));
        }

        #return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $rating = $movie['Rating'];
        $movie_status = $movie['movie_status'];
        $statuses = array_column(MovieStatus::cases(), 'value');

        #dump($statuses);

        // foreach ($statuses as $status) {
        //     echo "$status <br>";
        // }

        // $item = array_search('want to watch', $statuses);
        // echo($item);

        // unset($statuses[$item]);

        // foreach ($statuses as $status) {
        //     echo($status);
        // }




        // $movie_status_two = MovieStatus::Finished->value;
        // dump($movie_status_two);

        #echo($movie);
        #echo($movie['movie_status']);
        #echo($movie['Rating']);
        #echo('hello world');

        return view('movies.edit', compact('movie', 'rating', 'movie_status', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieManager $manager, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'director' => ['required', 'max:255', 'alpha'],
            'rating' => ['required', 'lte:10'],
            'movie_status' => 'required'
        ]);

        $manager->update_data($id, $validated);

        return redirect()->route('movies.index')->with('success', 'movie updated succesfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieManager $manager, $id)
    {
        $manager->delete_data($id);

        return redirect()->route('movies.index')->with('success', 'Movie deleted succesfully');
    }
}
