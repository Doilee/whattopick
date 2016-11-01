<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    const baseUrl = 'https://euw.api.pvp.net';

    private $key;

    private $url;

    private $client;

    public function __construct()
    {
        $this->key = env('RIOT_KEY', '');

        $this->client = new Client();
    }

    public function getAllChampions()
    {
        $this->url = static::baseUrl . '/api/lol/euw/v1.2/champion?api_key=' . $this->key;

        $collection = collect(json_decode($this->get()));

        return $collection;
    }

    protected function get()
    {

        $request = $this->client->request('GET', $this->url);

        return $request->getBody()->getContents();
    }
}
