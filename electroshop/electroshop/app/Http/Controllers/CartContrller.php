<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();
class CartContrller extends Controller
{
    public function show_cart(){
        return view('Cart.show_cart');
    }
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_infor = DB::table('tbl_product')->where('product_id',$productId)->first();
        echo '<pre>';
        print_r($product_infor);
        echo '</pre>';
        $data['id'] = $product_infor->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->product_name;
        $data['price'] = $product_infor->product_price;
        $data['weight'] = $product_infor->product_price;
        $data['options']['image'] = $product_infor->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            return redirect()->back()->with('message','Xóa hết thành công');
        }
    }
}
