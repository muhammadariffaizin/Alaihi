<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Song;

class ApiSongController extends Controller
{
    /**
     * Mengembalikan detail dari salah satu song
     *
     * @return json
     */
    public function index($id) {
        $song = Song::where('id', $id)->with('lyric')->get();
        if($song->count()) {
            return response()->json([
                'success' => true,
                'song' => $song
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Id tidak ditemukan',
            ]);
        }
    }
        
    /**
     * Mengembalikan daftar list song
     *
     * @return json
     */
    public function list() {
        $songs = Song::with('lyric')->get();
        return response()->json([
            'success' => true,
            'songs' => $songs
        ]);
    }

    /**
     * Mengembalikan daftar pencarian song
     *
     * @return json
     */
    public function search($keyword) {
        $songs_name = Song::where('name', 'LIKE', '%'.$keyword.'%')
        ->get();
        $songs_name_alias = Song::where('name_alias', 'LIKE', '%'.$keyword.'%')
        ->get();
        $songs = $songs_name->merge($songs_name_alias);
        if($songs->count()) {
            return response()->json([
                'keyword' => $keyword,
                'success' => true,
                'songs' => $songs
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sholawat dengan kata '.$keyword.' tidak ditemukan',
            ]);            
        }
    }
}
