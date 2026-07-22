<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/logincheckout.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==">
<!--===============================================================================================-->
</head>
<body class="animsition" style="opacity: 1;">
    <div class="cotn_principal">
        <div class="cont_centrar">

          <div class="cont_login">
        <div class="cont_info_log_sign_up">
              <div class="col_md_login">
        <div class="cont_ba_opcitiy">

                <h2>LOGIN</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <button class="btn_login" onclick="change_to_login()">LOGIN</button>
          </div>
          </div>
        <div class="col_md_sign_up">
        <div class="cont_ba_opcitiy">
          <h2>SIGN UP</h2>


          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

          <button class="btn_sign_up" onclick="change_to_sign_up()">SIGN UP</button>
        </div>
          </div>
               </div>


            <div class="cont_back_info">
               <div class="cont_img_back_grey">
               <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
               </div>

            </div>
        <div class="cont_forms" >
            <div class="cont_img_back_">
               <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
            </div>

            <div class="cont_form_login">
                <a style="margin-left: -295px;" href="#" onclick="hidden_login_and_sign_up()" ><i class="fa-thin fa-x"></i></a>
                <h2>LOGIN</h2>
                <form action="{{URL::to('/login-customer')}}" method="post">
                    @csrf
                    <input type="text" name="email_account" placeholder="Email" />
                    <input type="password" name="password_account" placeholder="Password" />
                    <button type="submit" class="btn_login" onclick="change_to_login()">LOGIN</button>
                </form>
            </div>

           <div class="cont_form_sign_up">
                <a style="margin-left: -295px;" href="#" onclick="hidden_login_and_sign_up()"><i class="fa-thin fa-x"></i></a>
                <h2>SIGN UP</h2>
                <form action="{{URL::to('/add-customer')}}" method="post">
                    @csrf
                    <input type="text" name="customer_name" placeholder="Name" />
                    <input type="text" name="customer_email" placeholder="Email" />
                    <input type="password" name="customer_password" placeholder="Password" />
                    <input type="phone" name="customer_phone" placeholder="Phone" />
                    <button type="submit" class="btn_sign_up" onclick="change_to_sign_up()">SIGN UP</button>
                </form>
            </div>

            </div>

          </div>
         </div>
        </div>

<script>
/* ------------------------------------ Click on login and Sign Up to  changue and view the effect
---------------------------------------
*/

const time_to_show_login = 400;
const time_to_hidden_login = 200;

function change_to_login() {
document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";
document.querySelector('.cont_form_login').style.display = "block";
document.querySelector('.cont_form_sign_up').style.opacity = "0";

setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },time_to_show_login);

setTimeout(function(){
document.querySelector('.cont_form_sign_up').style.display = "none";
},time_to_hidden_login);
  }

  const time_to_show_sign_up = 100;
  const time_to_hidden_sign_up = 400;

function change_to_sign_up(at) {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
  document.querySelector('.cont_form_sign_up').style.display = "block";
document.querySelector('.cont_form_login').style.opacity = "0";

setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
},time_to_show_sign_up);

setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
},time_to_hidden_sign_up);


}

const time_to_hidden_all = 500;

function hidden_login_and_sign_up() {

document.querySelector('.cont_forms').className = "cont_forms";
document.querySelector('.cont_form_sign_up').style.opacity = "0";
document.querySelector('.cont_form_login').style.opacity = "0";

setTimeout(function(){
document.querySelector('.cont_form_sign_up').style.display = "none";
document.querySelector('.cont_form_login').style.display = "none";
},time_to_hidden_all);

  }

</script>
</body>
</html>
