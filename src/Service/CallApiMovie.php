<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiMovie
{

    private $client;
    private $params;

    public function __construct(HttpClientInterface $client, ContainerBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
    }

    public function getMostPopular():array
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/movie/popular?language=fr&api_key='.$this->params->get('app.apikey').'&language=fr-FR'
        );
        return $response->toArray()['results'];
    }

    public function getListGenreMovie(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/genre/movie/list?api_key='.$this->params->get('app.apikey').'&language=fr-FR'
        );
        return $response->toArray();
    }

    public function getMovie(int $id): array
    {
        $response = $this->client->request(
            'GET',
            "https://api.themoviedb.org/3/movie/$id?api_key=".$this->params->get('app.apikey')."&language=fr-FR"
        );
        return $response->toArray();
    }

    public function getVideo(int $id): array
    {
        $response = $this->client->request(
            'GET',
            "https://api.themoviedb.org/3/movie/$id/videos?api_key=".$this->params->get('app.apikey')."&language=fr-FR"
        );
        return $response->toArray()['results'];
    }

    public function getMoviesFromLetter(string $value): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/search/movie?api_key='.$this->params->get('app.apikey').'&language=fr-FR&query=$value'
        );
        return $response->toArray()['results'];
    }
}