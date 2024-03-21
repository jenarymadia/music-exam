<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LastFM\ArtistServices;
use App\Models\FavoriteArtist;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
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
        $favoriteArtist = new FavoriteArtist();
        $favoriteArtist->user_id = Auth::id();
        $favoriteArtist->name = $request->name;
        $favoriteArtist->save();
    
        // Optionally, you can return a response indicating success
        return response()->json([
            'message' => 'Favorite artist saved successfully',
            'id' => $favoriteArtist->id
        ], 200);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $artist)
    {
        $artist = (new ArtistServices)->getInfo($artist);
        if (! $artist) {
            abort(404);
        }

        $favorite = FavoriteArtist::userFave($artist['name']);
        return view('artists.index', compact('artist','favorite'));
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
    public function destroy($id)
    {
        // Find the favorite artist by ID
        $favoriteArtist = FavoriteArtist::find($id);
    
        // Check if the favorite artist exists
        if (!$favoriteArtist) {
            return response()->json(['message' => 'Favorite artist not found'], 404);
        }
    
        // Check if the authenticated user owns the favorite artist record
        if ($favoriteArtist->user_id !== auth()->id()) {
            return response()->json(['message' => 'You are not authorized to delete this favorite artist'], 403);
        }
    
        // Delete the favorite artist from the database
        $favoriteArtist->delete();
    
        // Return a response indicating success
        return response()->json(['message' => 'Favorite artist deleted successfully'], 200);
    }
}
