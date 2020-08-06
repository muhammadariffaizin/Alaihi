<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lyric;

class LyricController extends Controller
{
    /**
     * Membuat data versi lirik sholawat baru
     *
     * @return \App\Lyric
     */
    public function create(Request $request) {
        Lyric::create([
            'version' => $request->version,
            'song_id' => $request->id,
            'description' => $request->description
        ]);
        return redirect()->back();
    }
}
