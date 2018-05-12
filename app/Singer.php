<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    //
    protected $table = "singers";

    public function theloai() {
    	return $this->belongsTo('App\TheLoai','idtheloai','id');
    }

    public function baihat() {
    	return $this->hasMany('App\Song','idcasi','id');
    }
}
