<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Register Now</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form action="{{ route('user.saved') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Confirm Password" id="cpassword" name="password_confirmation">
                        </div>
                        <div class="form-group small">
                            <a href="#" class="forgot-link">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                    </form>
                    <div class="text-center small">Already have an account? <a href="{{ route('login') }}">Login Now</a></div>
			  	</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>

	</body>
</html>
