<?php

namespace App\Services\LastFM;

use LastFmApi\Api\AuthApi;
use LastFmApi\Api\ArtistApi;

class ArtistServices {
    
    private $apiKey;
    private $artistApi;

    public function __construct()
    {
        $this->apiKey = config('services.last_fm.client_key'); //required
        $auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
        $this->artistApi = new ArtistApi($auth);
    }

    public function search($artist) {
        $result = $this->artistApi->search(["artist" => $artist]);
        return $result;
    }

    public function getInfo($artist) {
        $result = $this->artistApi->getInfo(["artist" => $artist]);
        return $result ?? false;
    }
}