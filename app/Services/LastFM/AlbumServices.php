<?php

namespace App\Services\LastFM;

use LastFmApi\Api\AuthApi;
use LastFmApi\Api\AlbumApi;

class AlbumServices {
    
    private $apiKey;
    private $albumApi;

    public function __construct()
    {
        $this->apiKey = config('services.last_fm.client_key'); //required
        $auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
        $this->albumApi = new AlbumApi($auth);
    }

    public function search($album) {
        $result = $this->albumApi->search(["album" => $album]);
        return $result;
    }

    public function getInfo($album, $artist = null) {
        try {
            $result = $this->albumApi->getInfo([
                "album" => $album,
                "artist" => $artist,
            ]);
            return $result ?? false;
        } catch (\Throwable $th) {
            return false;
        }
        
    }
}