<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Lyric;
use App\Genre;

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
        return view('song_detail', compact('id', 'songs', 'lyrics'));
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
        
    /**
     * Mengedit data dari lagu
     *
     * @return \App\Song
     */
    public function edit($id) {
        $song = Song::where('id', $id)
                    ->first();
        $genres = Genre::All();
        return view('song_edit', compact('id', 'song', 'genres'));
    }

    /**
     * Mengupdate data dari lagu
     *
     * @return \App\Song
     */
    public function update(Request $request) {
        Song::where('id', $request->id)->update([
            'version' => $request->version,
            'description' => $request->description
        ]);
        return redirect()->back();
    }

    /**
     * Menghapus data lagu
     *
     * @return \App\Song
     */
    public function delete($id) {
        Song::where('id', $id)->delete();
        return redirect()->route('home');
    }
}
