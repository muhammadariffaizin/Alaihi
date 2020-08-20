<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id) {
        $songs = Song::where('id', $id)->first();
        $lyrics = Lyric::where('song_id', $id)->get();
        return view('admin.song_detail', compact('id', 'songs', 'lyrics'));
    }

    /**
     * Menampilkan halaman daftar lirik.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list() {
        $songs = Song::orderBy('created_at', 'DESC')->paginate(5);
        session()->put('url.intended', URL::current());
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
        $song = Song::create([
            'name' => $request->name,
            'name_alias' => $request->name_alias,
            'genre_id' => $request->genre,
            'description' => $request->description,
            'source' => $request->source
        ]);
        return redirect()->route('song.index', ['id' => $song->id]);
    }
        
    /**
     * Menampilkan popup data baru
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add() {
        $genres = Genre::All();
        return view('admin.song_add', compact('genres'));
    }

    /**
     * Mengedit data dari lagu
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
        return redirect()->back()->with('success', 'Data sholawat berhasil dibuat');
    }

    /**
     * Menghapus data lagu
     *
     * @return \App\Song
     */
    public function delete($id) {
        Song::where('id', $id)->delete();
        return redirect()->route('admin.home')->with('success', 'Data sholawat berhasil dihapus');
    }
}
