<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
session_start();
class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthenLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthenLogin();
        $date = array();
        $date ['category_name'] = $request->category_product_name;
        $date ['category_desc'] = $request->category_product_desc;
        $date ['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($date);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        DB::table('tbl_category_product')->Where('category_id', $category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt được danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        DB::table('tbl_category_product')->Where('category_id', $category_product_id)->update(['category_status'=>0]);
        Session::put('message','Không kích hoạt được danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthenLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthenLogin();
        $date = array();
        $date['category_name'] = $request->category_product_name;
        $date['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($date);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthenLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();//dùng để lối tên gọi trong database với tên trên fontend
        // $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->get();
        return view('Category.show_category_home')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);//->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
    }
}
