<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;

class jsonToDb extends Command
{
    protected $signature = 'json-to-db {path}';

    protected $description = 'Fills database rows and columns with data from JSON file';

    public function handle(): void
    {
        $path = $this->argument("path");
        $moviesString = file_get_contents($path);
        $movies = json_decode($moviesString, true, 512, JSON_THROW_ON_ERROR);

        foreach($movies as $movie){
            $newMovie = new Movie;
            $newMovie->released     = $movie['Released'];
            $newMovie->plot         = $movie['Plot'];
            $newMovie->poster       = $movie['Poster'];
            $newMovie->description  = $movie['Description'];
            $newMovie->summary      = $movie['Summary'];
            $newMovie->save();
        }
    }

}
