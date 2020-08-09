<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
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
}
