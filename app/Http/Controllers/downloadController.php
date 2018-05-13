<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class downloadController extends Controller
{
    //
    public function downloadBaiHat($id, $file) {
    	$number = DB::update('UPDATE songs SET luotnghe = luotnghe + 1 WHERE id = '.$id);
    	$ext = array_reverse(explode('.',$file));
	    $file_path = public_path('upload/'.getUrlFileUpload($ext[0], 'nhacthuong/').$file);
	    return response()->download($file_path);
	}

	public function downloadBaiHatVip($id, $file) {
    	$number = DB::update('UPDATE songs SET luotnghe = luotnghe + 1 WHERE id = '.$id);
    	$ext = array_reverse(explode('.',$file));
	    $file_path = public_path('upload/'.getUrlFileUpload($ext[0], 'nhacvip/').$file);
	    return response()->download($file_path);
	}
}
