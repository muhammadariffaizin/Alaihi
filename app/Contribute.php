<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribute extends Model
{
    protected $fillable = [
        'song_id', 
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function song() {
        return $this->hasOne('App\Song');
    }
}
