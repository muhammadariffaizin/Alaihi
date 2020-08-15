<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;

class SearchController extends Controller
{
    /**
     * Menampilkan halaman detail lirik.
     *
     * @return \App\Song
     */
    public function search(Request $request) {
        $find = $request->search;
        $songs = Song::where('name', 'like', '%'.$find.'%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
        return view('admin.song_list', compact('songs'));
    }
}
