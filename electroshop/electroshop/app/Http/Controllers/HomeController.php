<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
session_start();
class HomeController extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $product_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(10)->get();//desc có nghĩa là tăng dần,limit(4)là cho 4 sản phẩm thôi
        return view('home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('product_by_id',$product_by_id);
    }
    public function store(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('store')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $search_product = $search_product = DB::table('tbl_product')
        ->where('product_name', 'like', '%' . $keywords . '%')
        ->orWhere('product_price', '=', $keywords)
        ->get();
        return view('Product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }

}
