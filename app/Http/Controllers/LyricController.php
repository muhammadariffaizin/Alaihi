<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lyric;
use App\SubLyric;

class LyricController extends Controller
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
        return redirect()->back()->with('success', 'Lirik versi '.$request->version.' berhasil dibuat');
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
        $name = Lyric::where('id', $id)->first();
        Lyric::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Lirik versi '.$name->name.' berhasil dihapus');
    }

    /**
     * Menggandakan data dari salah satu versi
     *
     * @return \App\Lyric
     */
    public function duplicate($id) {
        $copy = Lyric::where('id', $id)->first();
        Lyric::create([
            'version' => $copy->version.' - salinan',
            'song_id' => $copy->song_id,
            'description' => $copy->description
        ]);
        $paste = Lyric::where('version', $copy->version.' - salinan')->first();
        $copy_sub = SubLyric::where('lyric_id', $id)->get();
        for($i = 0; $i < $copy_sub->count(); $i++) {
            SubLyric::create([
                'lyric_id' => $paste->id,
                'lyric_language' => $copy_sub[$i]->lyric_language,
                'lyric_content' => $copy_sub[$i]->lyric_content,
            ]);
        }
        return redirect()->back()->with('success', 'Lirik versi '.$copy->version.' berhasil digandakan');
    }
}
