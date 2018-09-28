<?php

namespace App\Riot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RiotApi
{
    use RateLimiter;

    protected $client;

    const MAX_CALLS_PER_TWO_MINUTES = 100;

    const TWO_MINUTES = 120;

    public function __construct()
    {
        if (!self::$startTime) $this->startClock();

        $this->limitRate();

        self::$calls++;

        $this->client = new Client([
            'base_uri' => 'https://euw1.api.riotgames.com/lol',
            'headers' => [
                'X-Riot-Token' => env('RIOT_KEY'),
            ]
        ]);

    }

    public function challengers() : array
    {
        return $this->get('/lol/league/v3/challengerleagues/by-queue/RANKED_SOLO_5x5')->entries;
    }

    public function getAccountId(int $summonerId) : int
    {
        return $this->get('/lol/summoner/v3/summoners/' . $summonerId)->accountId;
    }

    private function get(string $url)
    {
        try {
            $response = $this->client->get($url);
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() === 429) {
                $this->wait(self::TWO_MINUTES);
                $this->get($url);
            }
        }

        $body = \GuzzleHttp\json_decode($response->getBody());
        return $body;
    }
}