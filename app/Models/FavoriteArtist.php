<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FavoriteArtist extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function userFave($artist) {
        $data = FavoriteArtist::where([
            "user_id" => Auth::id(),
            "name" => $artist
        ])->first();

        return $data ? $data->id : 0;
    }
}
