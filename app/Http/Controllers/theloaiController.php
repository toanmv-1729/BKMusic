<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class theloaiController extends Controller
{
    public function getDanhSach() {
		$theloai = TheLoai::all();
		return view('admin.theloai.danhsach',['theloai'=>$theloai]);
	}
	
	public function getThem() {
		return view('admin.theloai.them');
	}

	public function postThem(Request $request) {
		$this->validate(
			$request, 
			[
				'ten' => 'required|min:3|max:100|unique:theloai,ten'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên thể loại',
			 	'ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.unique' => 'Tên thể loại đã tồn tại',
			]
		);

		$theloai = new TheLoai;
		$theloai->ten = $request->ten;
		$theloai->tenkhongdau = changeTitle($request->ten);
		$theloai->save();

		return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
	}

	public function getSua($id) {
		$theloai = TheLoai::find($id);
		return view('admin.theloai.sua',['theloai' => $theloai]);
	}

	public function postSua(Request $request,$id) {
		$theloai = TheLoai::find($id);
		//Check lỗi
		$this->validate($request,
			[
				'ten' => 'required|unique:theloai,ten|min:3|max:100'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên thể loại',
				'ten.unique' => 'Tên thể loại đã tồn tại',
				'ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
			 	'ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
			]
		);

		//Sửa
		$theloai->ten = $request->ten;
		$theloai->tenkhongdau = changeTitle($request->ten);
		$theloai->save();

		return redirect('admin/theloai/sua/'.$id) -> with('thongbao','Sửa thành công');
	}

	public function getXoa($id){
		$theloai = TheLoai::find($id);
		$theloai->delete();

		return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công'); 
	}
}
