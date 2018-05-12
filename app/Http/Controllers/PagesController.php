<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Singer;
use App\Song;
use App\TheLoai;
use App\User;

class PagesController extends Controller
{
    function __construct() {
		$theloai = TheLoai::all();
		$casi = Singer::all();
		$baihat = Song::all();
		view() -> share('theloai',$theloai);
		view() -> share('casi',$casi);
		view() -> share('baihat',$baihat);

  //       if(Auth::check()) {
  //           view()->share('nguoidung',Auth::user());
  //       }
	}

    function trangchu() {
    	return view('pages.trangchu');
    }

    function baihat($id) {
        $baihat = Song::find($id);
        
        return view('pages.baihat',['baihat'=>$baihat]);
    }
}
