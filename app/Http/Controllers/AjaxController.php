<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\Singer;
use App\Song;

class AjaxController extends Controller
{
    //
	public function getCaSi($idtheloai){
		$casi = Singer::where('idtheloai',$idtheloai)->get();
		foreach($casi as $cs){
			echo "<option value='".$cs->id."'>".$cs->ten."</option>";
		}
	}
}
