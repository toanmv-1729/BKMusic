<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Singer;

class baihatController extends Controller
{
    //
    public function getDanhSach() {
    	$baihat = Song::all();
		return view('admin.baihat.danhsach',['baihat'=>$baihat]);
	}
	
	public function getThem() {
		$baihat = Song::all();
		$casi = Singer::all();
		return view('admin.baihat.them',['baihat'=>$baihat, 'casi'=>$casi]);
	}

	public function postThem(Request $request) {
		// $this->validate($request,
		// 	[
		// 		'LoaiTin'=>'required',
		// 		'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
		// 		'TomTat'=>'required',
		// 		'NoiDung'=>'required'
		// 	],
		// 	[
		// 		'LoaiTin.required'=>'Bạn chưa chọn loại tin',
		// 		'TieuDe.required'=>'Bạn chưa chọn tiêu đề',
		// 		'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
		// 		'TieuDe.unique'=>'Tiêu đề đã tồn tại',
		// 		'TomTat.required'=>'Bạn chưa nhập tóm tắt',
		// 		'NoiDung.required'=>'Bạn chưa nhập nội dung'
		// 	]
		// );

		$baihat = new Song;
		$baihat->ten = $request->ten;
		// $baihat->TieuDeKhongDau = changeTitle($request->TieuDe);
		$baihat->idCaSi = 1;
		$baihat->theloai = 1;
		$baihat->lyrics = $request->lyrics;
		$baihat->karaoke = $request->karaoke;
		$baihat->luotnghe = 0;
		$baihat->luottai = 0;
		$baihat->sosao = 0;

		if($request->hasFile('thuong')) {
			$file1 = $request->file('thuong');
			$duoi1 = $file1->getClientOriginalExtension();
			if($duoi1 != 'mp3') {
				return redirect('admin/baihat/them')->with('loi','Chọn đuôi có file mp3');
			}
			$name1 = $file1->getClientOriginalName();
			$thuong = str_random(4)."_".$name1;
			while(file_exists("upload/baihat/nhacthuong".$thuong)) {
				$thuong = str_random(4)."_".$name1;
			}
			$file->move("upload/baihat/nhacthuong",$thuong);
			$baihat->urlthuong = $thuong;
		}
		else {
			$baihat->urlthuong = "";
		}

		if($request->hasFile('vip')) {
			$file2 = $request->file('vip');
			$duoi2 = $file2->getClientOriginalExtension();
			if($duoi2 != 'mp3') {
				return redirect('admin/baihat/them')->with('loi','Chọn đuôi có file mp3');
			}
			$name2 = $file2->getClientOriginalName();
			$vip = str_random(4)."_".$name2;
			while(file_exists("upload/baihat/nhacvip".$vip)) {
				$vip = str_random(4)."_".$name2;
			}
			$file->move("upload/baihat/nhacvip",$vip);
			$baihat->urlvip = $vip;
		}
		else {
			$baihat->urlvip = "";
		}

		if($request->hasFile('anh')) {
			$file = $request->file('anh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
				return redirect('admin/baihat/them')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
			}
			$name = $file->getClientOriginalName();
			$anh = str_random(4)."_".$name;
			while(file_exists("upload/baihat/images".$anh)) {
				$anh = str_random(4)."_".$name;
			}
			$file->move("upload/baihat/images",$anh);
			$baihat->urlanh = $anh;
		}
		else {
			$baihat->urlanh = "";
		}
		$baihat->save();

		return redirect('admin/baihat/them')->with('thongbao','Thêm thành công');
	}

	public function getSua($id) {
		$baihat = Song::all();
		$casi = Singer::all();
		$baihat = Song::find($id);
		return view('admin.baihat.sua',['casi'=>$casi,'baihat'=>$baihat]);
	}

	public function postSua(Request $request,$id) {
		
	}

	public function getXoa($id){
		
	}
}
