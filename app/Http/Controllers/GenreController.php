<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
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
     * Membuat data lirik sholawat baru
     *
     * @return \App\Genre
     */
    public function create(Request $request) {
        Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    /**
     * Mengedit data dari salah satu genre
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id) {
        $genre = Genre::where('id', $id)
                    ->first();
        return view('admin.genre_edit', compact('id', 'genre'));
    }

    /**
     * Mengupdate data dari salah satu genre
     *
     * @return \App\Genre
     */
    public function update(Request $request) {
        Genre::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Genre '.$request->name.' berhasil diperbarui');
    }

    /**
     * Menghapus data dari salah satu versi
     *
     * @return \App\Genre
     */
    public function delete($id) {
        $name = Genre::where('id', $id)->first();
        Genre::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Genre '.$name->name.' berhasil dihapus');
    }
}
