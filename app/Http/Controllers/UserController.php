<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    public function getDanhSach() {
		$user = User::all();
		return view('admin.user.danhsach',['user'=>$user]);
	}
	
	public function getThem() {
		return view('admin.user.them');
	}

	public function postThem(Request $request) {
		$this->validate($request,
			[
				'name' => 'required|min:3',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:3|max:32',
				'passwordAgain' => 'required|same:password'
			],
			[
				'name.required' => 'Bạn chưa nhập tên người dùng', 
				'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự', 
				'email.required' => 'Bạn chưa nhập email', 
				'email.email' => 'Bạn chưa nhập đúng định dạng email', 
				'email.unique' => 'Email đã tồn tại', 
				'password.required' => 'Bạn chưa nhập mật khẩu', 
				'password.min' => 'Mật khẩu có ít nhất 3 ký tự',
				'password.max' => 'Mật khẩu có nhiều nhất nhất 32 ký tự',
				'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
				'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng'
			]
		);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->quyen = $request->quyen;
		if($request->hasFile('urlanh')) {
			$file = $request->file('urlanh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
				return redirect('admin/user/them')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
			}
			$name = $file->getClientOriginalName();
			$urlanh = str_random(4)."_".$name;
			while(file_exists("upload/user/".$urlanh)) {
				$urlanh = str_random(4)."_".$name;
			}
			$file->move("upload/user",$urlanh);
			$user->urlanh = $urlanh;
		}
		else {
			$user->urlanh = "";
		}
		$user->save();
		return redirect('admin/user/them')->with('thongbao','Thêm thành công');
	}

	public function getSua($id) {
		$user = User::find($id);
		return view('admin/user/sua',['user'=>$user]);
	}

	public function postSua(Request $request,$id) {
		$this->validate($request,
			[
				'name' => 'required|min:3'
				
			],
			[
				'name.required' => 'Bạn chưa nhập tên người dùng', 
				'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự'
			]
		);

		$user = User::find($id);
		$user->name = $request->ten;
		$user->quyen = $request->quyen;
		if($request->changePassword == "on") {
			$this->validate($request,
			[
				'password' => 'required|min:3|max:32',
				'passwordAgain' => 'required|same:password'
			],
			[
				'password.required' => 'Bạn chưa nhập mật khẩu', 
				'password.min' => 'Mật khẩu có ít nhất 3 ký tự',
				'password.max' => 'Mật khẩu có nhiều nhất nhất 32 ký tự',
				'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
				'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng'
			]
			);
			$user->password = bcrypt($request->password);

		}
		if($request->hasFile('urlanh')) {
			$file = $request->file('urlanh');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
				return redirect('admin/user/them')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
			}
			$name = $file->getClientOriginalName();
			$urlanh = str_random(4)."_".$name;
			while(file_exists("upload/user/".$urlanh)) {
				$urlanh = str_random(4)."_".$name;
			}
			$file->move("upload/user",$urlanh);
			$user->urlanh = $urlanh;
		}
		else {
			$user->urlanh = "";
		}

		$user->save();
		return redirect('admin/user/danhsach')->with('thongbao','Bạn đã sửa thành công');
	}

	public function getXoa($id){
		$user = User::find($id);
		$user->delete();
		return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công'); 
	}
}
