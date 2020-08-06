<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name', 
        'description'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function song() {
        return $this->hasMany('App\Song');
    }
}
