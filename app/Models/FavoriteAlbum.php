<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FavoriteAlbum extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function userFave($album, $artist = null) {
        $data = FavoriteAlbum::where([
            "user_id" => Auth::id(),
            "name" => $album,
            "artist" => $artist
        ])->first();

        return $data ? $data->id : 0;
    }
}
