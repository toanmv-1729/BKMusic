<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Singer;
use App\Song;
use App\TheLoai;
use App\User;
use App\Comments;
use DB;
use Laravel\Scout\Searchable;
use App\Http\Controllers\Controller;

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

    function casi($id) {
    	$casi = Singer::find($id);
    	$baihat = Song::where('idcasi',$id)->paginate(1);
    	return view('pages.casi',['casi'=>$casi,'baihat'=>$baihat]);
    }

    function baihat($id) {
        if(Auth::check()){
          $user_id = Auth::user()->id;
        }else{
          $user_id = 0;
        }
        $baihat = Song::find($id);
        $comments = Comments::where('music_id', $id)->get();

        return view('pages.baihat',['baihat'=>$baihat, 'comments' => $comments, 'music_id' => $id, 'user_id' => $user_id]);
    }

    function dsbaihat($id) {
    	$theloai = TheLoai::find($id)->get();
    	$casi = Singer::where('idtheloai',$id)->paginate(6);
    	return view('pages.dsbaihat',['theloai'=>$theloai,'casi'=>$casi]);
    }

    function getDangNhap() {
        return view('pages.dangnhap');
    }

    function postDangNhap(Request $request) {
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu có ít nhất 3 ký tự',
                'password.max' => 'Mật khẩu có nhiều nhất nhất 32 ký tự'  
            ]
        );


        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            return redirect('/trangchu');
        }
        else {
            return redirect('/dangnhap')->with('thongbao','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    function getDangXuat() {
        Auth::logout();
        return redirect('/trangchu');
    }

    function getNguoiDung() {
        $user = Auth::user();
        if(Auth::check())
            return view('pages.nguoidung',['user'=>$user]);
        else
            return redirect('dangnhap')->with('thongbao','Bạn chưa Đăng Nhập!');
    }

    function postNguoiDung(Request $request) {
        $this->validate($request,
            [
                'name' => 'required|min:3'
                
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng', 
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự'
            ]
        );

        $user = Auth::user();
        $user->name = $request->name;
        
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
                return redirect('nguoidung')->with('loi','Chọn đuôi có file jpg,png hoặc jpeg');
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
            $user->urlanh = "defaultuser.png";
        }

        $user->save();
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');
    }

    function getDangKy() {
        return view('pages.dangky');
    }

    function postDangKy(Request $request) {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'password2' => 'required|same:password'
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
                'password2.required' => 'Bạn chưa nhập lại mật khẩu',
                'password2.same' => 'Mật khẩu nhập lại chưa đúng'
            ]
        );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->urlanh = 'defaultuser.png';
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/dangky')->with('thongbao','Đăng ký thành công');
    }

    function timkiem(Request $request) {
        $tukhoa = $request->tukhoa;
        $baihat = Song::where('ten','like',"%$tukhoa%")->orWhere('urlthuong','like',"%$tukhoa%")->orWhere('lyrics','like',"%$tukhoa%")->take(30)->paginate(5)->appends(['tukhoa' => $tukhoa]);
        return view('pages.timkiem',['baihat'=>$baihat,'tukhoa'=>$tukhoa]);
    }
}
