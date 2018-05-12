<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    //
    protected $table = "songs";

    public function casi() {
    	return $this->belongsTo('App\Singer','idcasi','id');
    }
}
