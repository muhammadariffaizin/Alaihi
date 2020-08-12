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
    
    /**
     * Mengedit data dari salah satu versi
     *
     * @return \App\Lyric
     */
    public function edit($id) {
        $lyric = Lyric::where('id', $id)
                    ->first();
        return view('admin.lyric_edit', compact('id', 'lyric'));
    }

    /**
     * Mengupdate data dari salah satu versi
     *
     * @return \App\Lyric
     */
    public function update(Request $request) {
        Lyric::where('id', $request->id)->update([
            'version' => $request->version,
            'description' => $request->description
        ]);
        return redirect()->back();
    }

    /**
     * Menghapus data dari salah satu versi
     *
     * @return \App\Lyric
     */
    public function delete($id) {
        Lyric::where('id', $id)->delete();
        return redirect()->back();
    }
}
