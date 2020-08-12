<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lyric;
use App\SubLyric;

class SubLyricController extends Controller
{
    /**
     * Menampilkan halaman detail lirik.
     *
     * @return \App\Song
     */
    public function index($id) {
        
        return view('admin.lyric_sub_add', compact('id'));
    }

    /**
     * Membuat data detail lirik dari salah satu versi
     *
     * @return \App\SubLyric
     */
    public function create(Request $request) {
        SubLyric::create([
            'lyric_id' => $request->id,
            'lyric_language' => $request->language,
            'lyric_content' => json_encode($request->lyric_content)
        ]);
        return redirect()->back();
    }

    /**
     * Mengedit data detail lirik dari salah satu versi
     *
     * @return \App\SubLyric
     */
    public function edit($id) {
        $sublyric = SubLyric::where('id', $id)
                    ->first();
        return view('admin.lyric_sub_edit', compact('id', 'sublyric'));
    }

    /**
     * Mengupdate data detail lirik dari salah satu versi
     *
     * @return \App\SubLyric
     */
    public function update(Request $request) {
        SubLyric::where('id', $request->id)->update([
            'lyric_language' => $request->language,
            'lyric_content' => json_encode($request->lyric_content)
        ]);
        return redirect()->back();
    }

    /**
     * Menghapus data detail lirik dari salah satu versi
     *
     * @return \App\SubLyric
     */
    public function delete($id) {
        SubLyric::where('id', $id)->delete();
        return redirect()->back();
    }
}
