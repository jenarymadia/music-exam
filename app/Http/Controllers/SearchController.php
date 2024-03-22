<?php

namespace App\Http\Controllers;

use App\Services\LastFM\AlbumServices;
use App\Services\LastFM\ArtistServices;

use Illuminate\Http\Request;

class SearchController extends Controller
{   
    public function search(Request $request) {
        $artist = new ArtistServices($request->value);
        $album = new AlbumServices($request->value);
        return [
            'results' => [
                'artists' => $artist->search(),
                'albums' => $album->search()
            ]
        ];
    }

}
