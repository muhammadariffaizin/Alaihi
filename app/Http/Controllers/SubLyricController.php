<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lyric;
use App\Sub_Lyric;

class SubLyricController extends Controller
{
    /**
     * Menampilkan halaman detail lirik.
     *
     * @return \App\Song
     */
    public function index($id) {
        
        return view('lyric_add', compact('id'));
    }

    /**
     * Membuat data detail lirik dari setiap versi
     *
     * @return \App\Sub_Lyric
     */
    public function create(Request $request) {
        Sub_Lyric::create([
            'lyric_id' => $request->id,
            'lyric_language' => $request->language,
            'lyric_content' => $request->lyric_content
        ]);
        return redirect()->back();
    }
}
