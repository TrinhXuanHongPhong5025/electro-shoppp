<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Responsive Web Template, Bootstrap, Registration">
    <title>Register Now</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Roboto', sans-serif;
        }
        .reg-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .reg-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-control {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }
        .terms {
            font-size: 14px;
            margin-bottom: 20px;
            color: #666;
        }
        .terms input {
            margin-right: 10px;
        }
        .login-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reg-container">
            <h2>Register Now</h2>
            <form action="{{URL::to('/add-account')}}" method="post">
                @csrf
                <input type="text" class="form-control" name="name" placeholder="Name" required>
                <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <div class="terms">
                    <input type="checkbox" required> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="login-link">
                Already Registered? <a href="{{URL::to('/admin')}}">Login</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
