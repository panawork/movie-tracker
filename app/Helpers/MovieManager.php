<?php

namespace App\Helpers;
use App\Models\Movie;
use Exception;

class MovieManager
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $params)
    {
        //dump($params);
        Movie::create($params);
    }

    public function update_data($id, array $params)
    {


        $movie = Movie::findOrFail($id);
        $movie_two = Movie::where('title', $movie->title)->get();

        #dump($movie_two);
        #echo gettype($movie_two);
        #echo($movie_two);
        #echo($movie_two[0]);
        #echo(count($movie_two));
        #echo($movie_two[0]['director']);

        if (count($movie_two) == 1){
            $movie->update($params);
        } else {
            echo("error error ");
        }

        

        #echo($movie->title);



        #dump($movie->title);

        #return $movie_two->director;
        


        #$movie->update($params);
    }

    public function delete_data($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();
    }

    public function show_data($id)
    {
        try {
            $movie = Movie::findOrFail($id);

            return $movie;
        } catch (Exception $e) {
            #dump($e);

            return False;
            
        }


    }
}
