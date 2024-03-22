<?php

namespace App\Http\Controllers;

use App\Models\FavoriteAlbum;
use Illuminate\Http\Request;
use App\Services\LastFM\AlbumServices;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Raw;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new FavoriteArtist instance
        $favoriteArtist = new FavoriteAlbum();
        $favoriteArtist->user_id = Auth::id();
        $favoriteArtist->name = $request->name;
        $favoriteArtist->artist = $request->artist;
        $favoriteArtist->save();
    
        // Optionally, you can return a response indicating success
        return response()->json([
            'message' => 'Favorite album saved successfully',
            'id' => $favoriteArtist->id
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $album)
    {   
        $artist = $request->query('artist');
        $album = new AlbumServices($album);
        $info = $album->getInfo($artist);
        if (! $info) {
            abort(404);
        }
        return view('albums.index', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
