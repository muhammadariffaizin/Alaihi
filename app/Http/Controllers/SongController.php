<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Lyric;
use App\Genre;

class SongController extends Controller
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
     * Menampilkan halaman detail lirik.
     *
     * @return \App\Song
     */
    public function index($id) {
        $songs = Song::where('id', $id)->first();
        $lyrics = Lyric::where('song_id', $id)->get();
        return view('admin.song_detail', compact('id', 'songs', 'lyrics'));
    }

    /**
     * Menampilkan halaman daftar lirik.
     *
     * @return \App\Song
     */
    public function list() {
        $songs = Song::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.song_list', compact('songs'));
    }

    /**
     * Membuat data lirik sholawat baru
     *
     * @return \App\Song
     */
    public function create(Request $request) {
        $check = Song::where('name', $request->name)->count();
        if($check > 0) {
            return redirect()->back()->with('error', 'Gagal menambahkan data sholawat! Data sudah tersedia');
        }
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
        return view('admin.song_edit', compact('id', 'song', 'genres'));
    }

    /**
     * Mengupdate data dari lagu
     *
     * @return \App\Song
     */
    public function update(Request $request) {
        Song::where('id', $request->id)->update([
            'name' => $request->name,
            'name_alias' => $request->name_alias,
            'genre_id' => $request->genre,
            'description' => $request->description,
            'source' => $request->source
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
        return redirect()->route('admin.home');
    }
}
