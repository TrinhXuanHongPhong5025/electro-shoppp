<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
session_start();
class BrandProduct extends Controller
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

    public function add_brand_product(){
        $this->AuthenLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthenLogin();
        $date = array();
        $date['brand_name'] = $request->brand_product_name;//brand_name là lấy ở cái cột database còn brand_product_name là lấy ở cái name ở form
        $date['brand_desc'] = $request->brand_product_desc;
        $date['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($date);
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        DB::table('tbl_brand')->Where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt được thương hiệu sản phẩm thành công');
        return redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        DB::table('tbl_brand')->Where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Không kích hoạt được thương hiệu sản phẩm thành công');
        return redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthenLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthenLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthenLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return redirect::to('all-brand-product');
    }
    //End function admin
    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();//dùng để lối tên gọi trong database với tên trên fontend
        return view('Brand.show_brand_home')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
