<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singer;
use App\TheLoai;

class casiController extends Controller
{
    //
    public function getDanhSach() {
		$casi = Singer::all();
		return view('admin.casi.danhsach',['casi'=>$casi]);
	}
	
	public function getThem() {
		$theloai = TheLoai::all();
		return view('admin.casi.them',['theloai'=>$theloai]);
	}

	public function postThem(Request $request) {
		$this->validate(
			$request, 
			[
				'ten' => 'required|min:3|max:100|unique:singers,ten',
				'thongtin' => 'required',
				'theloai'=>'required',
			],
			[
				'ten.required' => 'Bạn chưa nhập tên ca sĩ',
				'thongtin.required' => 'Bạn chưa nhập thông tin ca sĩ',
				'theloai.required'=>'Bạn chưa chọn thể loại nhạc',
			 	'ten.min' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.unique' => 'Tên ca sĩ đã tồn tại',
			]
		);

		$casi = new Singer;
		$casi->ten = $request->ten;
		$casi->idtheloai = $request->theloai;
		$casi->thongtin = $request->thongtin;

		if($request->hasFile('urlanh')) {
			$file = $request->file('urlanh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
				return redirect('admin/casi/them')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
			}
			$name = $file->getClientOriginalName();
			$urlanh = str_random(4)."_".$name;
			while(file_exists("upload/casi/".$urlanh)) {
				$urlanh = str_random(4)."_".$name;
			}
			$file->move("upload/casi",$urlanh);
			$casi->urlanh = $urlanh;
		}
		else {
			$casi->urlanh = "";
		}

		$casi->save();

		return redirect('admin/casi/them')->with('thongbao','Thêm thành công');
	}

	public function getSua($id) {
		$theloai = TheLoai::all();
		$casi = Singer::find($id);
		return view('admin.casi.sua',['theloai'=>$theloai, 'casi' => $casi]);
	}

	public function postSua(Request $request,$id) {
		$casi = Singer::find($id);
		$this->validate(
			$request, 
			[
				'ten' => 'required|min:3|max:100',
				'thongtin' => 'required',
				'theloai'=>'required',
			],
			[
				'ten.required' => 'Bạn chưa nhập tên ca sĩ',
				'thongtin.required' => 'Bạn chưa nhập thông tin ca sĩ',
				'theloai.required'=>'Bạn chưa chọn thể loại nhạc',
			 	'ten.min' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	
			]
		);

		$casi->ten = $request->ten;
		$casi->thongtin = $request->thongtin;
		$casi->idtheloai = $request->theloai;
		if($request->hasFile('urlanh')) {
			$file = $request->file('urlanh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
				return redirect('admin/casi/them')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
			}
			$name = $file->getClientOriginalName();
			$urlanh = str_random(4)."_".$name;
			while(file_exists("upload/casi/".$urlanh)) {
				$urlanh = str_random(4)."_".$name;
			}
			$file->move("upload/casi",$urlanh);
			$casi->urlanh = $urlanh;
		}
		else {
			$casi->urlanh = "";
		}

		$casi->save();

		return redirect('admin/casi/danhsach') -> with('thongbao','Sửa thành công');
	}

	public function getXoa($id){
		$casi = Singer::find($id);
		$casi->delete();

		return redirect('admin/casi/danhsach')->with('thongbao','Bạn đã xóa thành công'); 
	}
}
