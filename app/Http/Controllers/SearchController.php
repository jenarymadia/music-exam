<?php

namespace App\Http\Controllers;

use App\Services\LastFM\AlbumServices;
use App\Services\LastFM\ArtistServices;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        return [
            'results' => [
                'artists' => (new ArtistServices())->search($request->value),
                'albums' => (new AlbumServices())->search($request->value)
            ]
        ];
    }

}
