<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class downloadVipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();
            if ($user->quyen == 2)
                return $next($request);
            else return redirect()->back()->with('thongbao','Tài khoản Vip mới có thể Download');
        }
        else
            return redirect('/dangnhap')->with('thongbao','Bạn phải đăng nhập với tài khoản Vip mới có thể tải');
    }
}
