<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use DB có nghĩa là sử dụng database
use DB;
use Session;
use Illuminate\Support\Facades\Redirect; //Redirect sẽ trả về 1 cái trang nào đó
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();
class CheckoutController extends Controller
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
    public function login_checkout(){
        return view('checkout.login_checkout');
    }
    public function checkout(){
        return view('checkout.show_checkout');
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        Session::put('customer_id',$result->customer_id);
        if($result){
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function payment(){
        return view('checkout.payment');
    }
    public function order_place(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Dang cho xu ly';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Dang cho xu ly';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insertGetId($order_d_data);
        }
        if($data['payment_method'] == 1){
            echo 'Thanh toán thẻ ATM';
        }elseif($data['payment_method'] == 2){
            Cart::destroy();
            return view('checkout.handcash');
        }else{
            echo 'Thẻ ghi nợ';
        }
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }
    public function manager_order(){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        $all_order = DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manager_order')->with('all_order',$all_order);//lấy $all_product biến bên trên liên kết đến DB gán vào biến all_product
        return view('admin_layout')->with('admin.manager_order',$manager_order);
    }
    public function view_order($orderId){
        $this->AuthenLogin();//có login thì ng dùng mới có id để vào(chưa đăng nhập chưa thể vào)
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>';
        $manager_order_by = view('admin.view_order')->with('order_by_id',$order_by_id);//lấy $all_product biến bên trên liên kết đến DB gán vào biến all_product
        return view('admin_layout')->with('admin.view_order',$manager_order_by);

    }
    public function delete_order($order_id){
        DB::table('tbl_order_details')->where('order_id',$order_id)->delete();
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return redirect::to('manager-order');
    }
}
