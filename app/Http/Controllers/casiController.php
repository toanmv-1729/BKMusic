<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singer;

class casiController extends Controller
{
    //
    public function getDanhSach() {
		$casi = Singer::all();
		return view('admin.casi.danhsach',['casi'=>$casi]);
	}
	
	public function getThem() {
		return view('admin.casi.them');
	}

	public function postThem(Request $request) {
		$this->validate(
			$request, 
			[
				'ten' => 'required|min:3|max:100|unique:singers,ten',
				'thongtin' => 'required'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên ca sĩ',
				'thongtin.required' => 'Bạn chưa nhập thông tin ca sĩ',
			 	'ten.min' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.unique' => 'Tên ca sĩ đã tồn tại',
			]
		);

		$casi = new Singer;
		$casi->ten = $request->ten;
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
		$casi = Singer::find($id);
		return view('admin.casi.sua',['casi' => $casi]);
	}

	public function postSua(Request $request,$id) {
		$casi = Singer::find($id);
		$this->validate(
			$request, 
			[
				'ten' => 'required|min:3|max:100|unique:singers,ten',
				'thongtin' => 'required'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên ca sĩ',
				'thongtin.required' => 'Bạn chưa nhập thông tin ca sĩ',
			 	'ten.min' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên ca sĩ phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.unique' => 'Tên ca sĩ đã tồn tại',
			]
		);

		$casi->ten = $request->ten;
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

		return redirect('admin/casi/danhsach') -> with('thongbao','Sửa thành công');
	}

	public function getXoa($id){
		$casi = Singer::find($id);
		$casi->delete();

		return redirect('admin/casi/danhsach')->with('thongbao','Bạn đã xóa thành công'); 
	}
}
