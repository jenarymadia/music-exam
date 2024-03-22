<?php

namespace App\Http\Controllers;

use App\Models\FavoriteAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $favoriteArtists = Auth::user()->favoriteArtists;
        $favoriteAlbums = Auth::user()->favoriteAlbums;
        return view('home',compact('favoriteArtists','favoriteAlbums'));
    }
}
