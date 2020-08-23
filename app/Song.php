<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'name', 
        'name_alias', 
        'description', 
        'source', 
        'genre_id'
    ];

    public function genre() {
        return $this->belongsTo('App\Genre');
    }

    public function lyric() {
        return $this->hasMany('App\Lyric');
    }

    /**
     * Get the 
     *
     * @return bool
     */
    public function getGenre()
    {
        
        return $this;
    }
}
