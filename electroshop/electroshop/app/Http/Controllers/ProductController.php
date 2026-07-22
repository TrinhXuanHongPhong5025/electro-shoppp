<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
session_start();
class ProductController extends Controller
{
    public function AuthenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthenLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderBy('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderBy('color_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('size_product',$size_product)->with('color_product',$color_product);
    }
    public function all_product(){
        $this->AuthenLogin();
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')->orderBy('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthenLogin();
        $date = array();
        $date['product_name'] = $request->product_name;
        $date['product_status'] = $request->product_status;
        $date['product_price'] = $request->product_price;
        $date['product_desc'] = $request->product_desc;
        $date['product_content'] = $request->product_content;
        $date['product_desc'] = $request->product_desc;
        $date['category_id'] = $request->product_cate;
        $date['brand_id'] = $request->product_brand;
        $date['size_id'] = $request->product_size;
        $date['color_id'] = $request->product_color;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));//explode dùng để tách chuỗi tên tệp thành 1 mảng dựa trên dấu chấm, current dùng để lấy giá trị của phần tử đầu tiên cuả mảng
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy đuôi mở rộng vd như jpg,..
            $get_image->move('public/uploads/product',$new_image);
            $date['product_image'] = $new_image;
            DB::table('tbl_product')->insert($date);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }else{
            $date['product_image'] = '';//ngược lại nếu k chọn thì k cho thêm ảnh
            DB::table('tbl_product')->insert($date);
            Session::put('message','Thêm sản phẩm thất bại');
            return redirect::to('all-product');
        }
    }
    public function edit_product($product_id){
        $this->AuthenLogin();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderBy('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderBy('color_id','desc')->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('size_product',$size_product)->with('color_product',$color_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function delete_product($product_id){ //$product_id: Đây là tham số đầu vào của hàm. Trong quá trình gọi hàm, bạn sẽ cung cấp giá trị cho $product_id. Ví dụ, nếu bạn gọi hàm như sau delete_product(123), thì $product_id sẽ mang giá trị 123 trong phạm vi của hàm.(sẽ lấy cái id đó để xóa or sửa theo mục đích cá nhân)
        $this->AuthenLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect::to('all-product');
    }
    public function update_product(Request $request, $product_id){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        $date = array();
        $date['product_name'] = $request->product_name;//product_name là lấy ở cái cột database còn product_product_name là lấy ở cái name ở form
        $date['product_price'] = $request->product_price;
        $date['product_desc'] = $request->product_desc;
        $date['product_content'] = $request->product_content;
        $date['category_id'] = $request->product_cate;
        $date['brand_id'] = $request->product_brand;
        $date['size_id'] = $request->product_size;
        $date['color_id'] = $request->product_color;
        $date['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy đuôi mở rộng vd như jpg,..
            $get_image->move('public/uploads/product',$new_image);
            $date['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($date);
            Session::put('message','Cập nhật sản phẩm thành công');
            return redirect::to('all-product');
        }else{
            DB::table('tbl_product')->where('product_id',$product_id)->update($date);
            Session::put('message','Cập nhật sản phẩm thất bại');
            return redirect::to('all-product');//giúp điều hướng trang
        }
    }
    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderBy('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderBy('color_id','desc')->get();
        $details_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')->where('tbl_product.product_id',$product_id)->first();
        // dd($cate_product,$brand_product, $size_product, $color_product, $details_product);
        //làm sản phẩm liên quan ,sản phẩm gợi ý bằng cách lấy cái sp có category_id
        // foreach($details_product as $values){
        //     $category_id = $values->category_id;
        // }

        $related_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')->whereNotIn('tbl_product.product_id',[$product_id])->get();//dùng hàm whereNotIn để lấy những sản phẩm danh mục đó nhưng trừ id sản phẩm đã lấy ra trong giỏ hàng rồi k hiển thị ở phần Recommenede Product (sp gợi ý) nữa.  ->where('tbl_category_product.category_id',$category_id)
        return view('Product.show_details_product')->with('category',$cate_product)->with('brand',$brand_product)->with('size',$size_product)->with('color',$color_product)->with('details_product',$details_product)->with('related',$related_product); //->with('related',$related_product);

    }
}
