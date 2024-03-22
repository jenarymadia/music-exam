<?php

namespace App\Services\LastFM;

use LastFmApi\Api\AuthApi;
use LastFmApi\Api\ArtistApi;

class ArtistServices {
    
    private $apiKey;
    private $artistApi;
    private $artist;

    public function __construct($artist)
    {
        $this->artist = $artist;
        $this->apiKey = config('services.last_fm.client_key'); //required
        $auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
        $this->artistApi = new ArtistApi($auth);
    }

    public function search($limit = 15) {
        $result = $this->artistApi->search([
            "artist" => $this->artist,
            "limit" => $limit,
        ]);
        return $result;
    }

    public function getInfo() {
        $result = $this->artistApi->getInfo([
            "artist" => $this->artist
        ]);
        return $result ?? false;
    }

    public function getTopAlbums($limit = 5) {
        $result = $this->artistApi->getTopAlbums([
            "artist" => $this->artist,
            "limit" => $limit
        ]);
        return $result ?? false;
    }

    public function getTopTracks($limit = 5) {
        $result = $this->artistApi->getTopTracks([
            "artist" => $this->artist,
            "limit" => $limit
        ]);
        return $result ?? false;
    }

    public function getSimilar($limit = 5) {
        $result = $this->artistApi->getSimilar([
            "artist" => $this->artist,
            "limit" => $limit
        ]);
        return $result ?? false;
    }
}