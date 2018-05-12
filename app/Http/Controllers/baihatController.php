<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Singer;
use App\TheLoai;

class baihatController extends Controller
{
    //
    public function getDanhSach() {
    	$baihat = Song::orderBy('id','DESC')->get();
		return view('admin.baihat.danhsach',['baihat'=>$baihat]);
	}
	
	public function getThem() {
		$theloai = TheLoai::all();
		$casi = Singer::all();
		return view('admin.baihat.them',['theloai'=>$theloai, 'casi'=>$casi]);
	}

	public function postThem(Request $request) {
		$this->validate($request,
			[
				'casi'=>'required',
				'ten'=>'required|min:3|unique:songs,ten',
				'lyrics'=>'required',
				'karaoke'=>'required'
			],
			[
				'casi.required'=>'Bạn chưa chọn ca sĩ',
				'ten.required'=>'Bạn chưa chọn tiêu đề',
				'ten.min'=>'Tên bài hát phải có ít nhất 3 ký tự',
				'ten.unique'=>'Tên bài hát đã tồn tại',
				'lyrics.required'=>'Bạn chưa nhập lời bài hát',
				'karaoke.required'=>'Bạn chưa nhập karaoke'
			]
		);

		$baihat = new Song;
		$baihat->ten = $request->ten;
		// $baihat->TieuDeKhongDau = changeTitle($request->TieuDe);
		$baihat->idcasi = $request->casi;
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
			$file1->move("upload/baihat/nhacthuong",$thuong);
			$baihat->urlthuong = $thuong;
		}
		else {
			$baihat->urlthuong = "";
		}

		if($request->hasFile('vip')) {
			$file2 = $request->file('vip');
			$duoi2 = $file2->getClientOriginalExtension();
			if($duoi2 != 'mp3' && $duoi2 != 'flac') {
				return redirect('admin/baihat/them')->with('loi','Chọn đuôi có file mp3 hoặc flag');
			}
			$name2 = $file2->getClientOriginalName();
			$vip = str_random(4)."_".$name2;
			while(file_exists("upload/baihat/nhacvip".$vip)) {
				$vip = str_random(4)."_".$name2;
			}
			$file2->move("upload/baihat/nhacvip",$vip);
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
		$theloai = TheLoai::all();
		$baihat = Song::all();
		$casi = Singer::all();
		$baihat = Song::find($id);
		return view('admin.baihat.sua',['theloai'=>$theloai, 'casi'=>$casi,'baihat'=>$baihat]);
	}

	public function postSua(Request $request,$id) {
		$baihat = Song::find($id);
		$this->validate($request,
			[
				'casi'=>'required',
				'ten'=>'required|min:3',
				'lyrics'=>'required',
				'karaoke'=>'required'
			],
			[
				'casi.required'=>'Bạn chưa chọn ca sĩ',
				'ten.required'=>'Bạn chưa chọn tiêu đề',
				'ten.min'=>'Tên bài hát phải có ít nhất 3 ký tự',
				'lyrics.required'=>'Bạn chưa nhập lời bài hát',
				'karaoke.required'=>'Bạn chưa nhập karaoke'
			]
		);

		
		$baihat->ten = $request->ten;
		// $baihat->TieuDeKhongDau = changeTitle($request->TieuDe);
		$baihat->idcasi = $request->casi;
		$baihat->lyrics = $request->lyrics;
		$baihat->karaoke = $request->karaoke;

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
			$file1->move("upload/baihat/nhacthuong",$thuong);
			$baihat->urlthuong = $thuong;
		}
		else {
			$baihat->urlthuong = "";
		}

		if($request->hasFile('vip')) {
			$file2 = $request->file('vip');
			$duoi2 = $file2->getClientOriginalExtension();
			if($duoi2 != 'mp3' && $duoi2 != 'flac') {
				return redirect('admin/baihat/them')->with('loi','Chọn đuôi có file mp3 hoặc flag');
			}
			$name2 = $file2->getClientOriginalName();
			$vip = str_random(4)."_".$name2;
			while(file_exists("upload/baihat/nhacvip".$vip)) {
				$vip = str_random(4)."_".$name2;
			}
			$file2->move("upload/baihat/nhacvip",$vip);
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

		return redirect('admin/baihat/sua/'.$id)->with('thongbao','Sửa thành công');
	}

	public function getXoa($id){
		$baihat = Song::find($id);
		$baihat->delete();

		return redirect('admin/baihat/danhsach')->with('thongbao','Xóa thành công');
	}
}
