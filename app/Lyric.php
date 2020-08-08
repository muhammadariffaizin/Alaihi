<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lyric extends Model
{
    protected $fillable = [
        'version',
        'song_id', 
        'description'
    ];

    public function song() {
        return $this->belongsTo('App\Song');
    }

    public function sublyric() {
        return $this->hasMany('App\SubLyric');
    }
}
