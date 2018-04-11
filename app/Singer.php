<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $table = "singers";
    protected $primaryKey = "idCaSi";

    public function Song(){
    	return $this->hasMany("App\Song", "idCaSi", "idBaiHat");
    }
}
