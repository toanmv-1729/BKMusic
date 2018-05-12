<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "theloai";

    public function casi() {
    	return $this->hasMany('App\Singer','idtheloai','id');
    }

    public function baihat() {
    	return $this->hasManyThrough('App\Song','App\Singer','idtheloai','idcasi','id');
    }
}
