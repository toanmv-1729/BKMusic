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
		$song = Song::all();
		view() -> share('theloai',$theloai);
		// view() -> share('song',$song);

  //       if(Auth::check()) {
  //           view()->share('nguoidung',Auth::user());
  //       }
	}

    function trangchu() {
    	return view('pages.trangchu');
    }
}
