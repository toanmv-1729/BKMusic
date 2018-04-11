<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = "songs";
    protected $primaryKey = "idBaiHat";

    public function Singer(){
    	return $this->belongsTo("App\Singer", "idBaiHat", "idCaSi");
    }
}
