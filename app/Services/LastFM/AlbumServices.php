<?php

namespace App\Services\LastFM;

use LastFmApi\Api\AuthApi;
use LastFmApi\Api\AlbumApi;

class AlbumServices {
    
    private $apiKey;
    private $albumApi;
    private $album;

    public function __construct($album)
    {
        $this->apiKey = config('services.last_fm.client_key'); //required
        $auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
        $this->albumApi = new AlbumApi($auth);
        $this->album = $album;
    }

    public function search($limit = 15) {
        $result = $this->albumApi->search([
            "album" => $this->album,
            "limit" => $limit,
        ]);
        return $result;
    }

    public function getInfo($artist = null) {
        try {
            $result = $this->albumApi->getInfo([
                "album" => $this->album,
                "artist" => $artist,
            ]);
            return $result ?? false;
        } catch (\Throwable $th) {
            return false;
        }
        
    }
}