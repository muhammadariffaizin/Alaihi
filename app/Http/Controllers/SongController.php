<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Lyric;

class SongController extends Controller
{
    /**
     * Menampilkan halaman detail lirik.
     *
     * @return \App\Song
     */
    public function index($id) {
        $songs = Song::where('id', $id)->first();
        $lyrics = Lyric::where('song_id', $id)->get();
        return view('song_detail', compact('songs', 'lyrics'));
    }

    /**
     * Membuat data lirik sholawat baru
     *
     * @return \App\Song
     */
    public function create(Request $request) {
        Song::create([
            'name' => $request->name,
            'name_alias' => $request->name_alias,
            'genre_id' => $request->genre,
            'description' => $request->description,
            'source' => $request->source
        ]);
        return redirect()->back();
    }
}
