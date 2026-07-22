<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
session_start();
class AdminController extends Controller
{
     //bảo mật đường dẫn URL chưa đăng nhập login thì chưa cho vào Admin bằng hàm AuthenLogin
     public function AuthenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;  //->admin_email; cái này có nghĩa là lấy admin_email trong form của admin_login.blade.php
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();//first() có nghĩa là lấy giới hạn chỉ là 1 user thôi
        // return view('admin.dashboard');
        if($result){
            Session::put('admin_name',$result->admin_name); //lấy admin_name từ biến $result mà biến $result lấy từ database
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');// có nghĩa là sẽ trả về trang dashboard
        }else{
            //bắt yêu cầu nhập lại ở trang login
            Session::put('message','Mật khẩu hoặc tài khoản của bạn bị sai.Vui lòng kiểm tra lại!!!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthenLogin();//khi có đăng nhập rồi mới có logout
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
