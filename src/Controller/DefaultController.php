<?php

namespace App\Controller;

use App\Service\CallApiMovie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(CallApiMovie $callApiMovie, Request $request): Response
    {
        $movies = [];
        $genres = [];
        if (!empty($request->get('genres'))) {
            $genres = $request->get('genres');
            foreach ($callApiMovie->getMostPopular() as $film) {
                if (!empty(array_intersect($film['genre_ids'], $genres)))
                    array_push($movies, $film);
            }
            $movies = array_unique($movies, SORT_REGULAR);
        }
        if (empty($movies)) {
            $movies = $callApiMovie->getMostPopular();
        }

        return $this->render('movie/index.html.twig', [
            'allGenre' => $callApiMovie->getListGenreMovie(),
            'mostPopular' => $movies,
            'genres' => $genres,
        ]);
    }

    /**
     * @Route("/show/movies/{id}", name="show_movies")
     */
    public function showMovies(CallApiMovie $callApiMovie, $id): Response
    {
        $movies = $callApiMovie->getMoviesFromLetter($id);
        return $this->render('movie/movies_search.html.twig', [
            'search' => $id,
            'movies' => $movies,
        ]);
    }


    /**
     * @Route("/searchMovie", name="movie_information", methods={"POST"})
     */
    public function search(Request $request, CallApiMovie $callApiMovie): Response
    {
        if ($request->isXMLHttpRequest()) {
            $search = $request->get('id');
            $movie = $callApiMovie->getMovie($search);
            $video = $callApiMovie->getvideo($search);
            $movie['youtubeKey'] = [];
            if(!empty($video)){
                $movie['youtubeKey'] = $video[0]['key'];
            }
            return new JsonResponse($movie);
        }
        return new Response("Error : this is not an ajax query !", 400);
    }

    /**
     * @Route("/searchCaractere", name="movie_autocomplete", methods={"POST"})
     */
    public function searchCaractere(Request $request, CallApiMovie $callApiMovie): Response
    {
        if ($request->isXMLHttpRequest()) {
            $search = $request->get('query');
            $movies = $callApiMovie->getMoviesFromLetter($search);
            $caracteres = [];
            foreach($movies as $movie){
                array_push($caracteres,$movie['original_title']);
            }
            return new JsonResponse($caracteres);
        }
        return new Response("Error : this is not an ajax query !", 400);
    }
}
