<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Lyric extends Model
{
    protected $fillable = [
        'lyric_id', 
        'lyric_content', 
        'lyric_language'
    ];

    public function lyric() {
        return $this->belongsTo('App\Lyric');
    }
}
