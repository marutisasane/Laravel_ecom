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
                @include('include.message')

			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form method="post" id="login_details">
                        @csrf
				  		<div class="input-group mb-3">
							<input type="email" name="email" id="email" class="form-control" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>
                            <p></p>
				  		</div>
				  		<div class="input-group mb-3">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
                            <p></p>
				  		</div>
				  		<div class="row">
							<!-- <div class="col-8">
					  			<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
						  				Remember Me
									</label>
					  			</div>
							</div> -->
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  			<p class="mb-1 mt-3">
				  		<a href="{{ route('forgot-password') }}">I forgot my password</a>
					</p>
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
        <script>

            setTimeout(() => {
                $('.alert').fadeOut();
            }, 3000);

            $('#login_details').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($('#login_details')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.auth') }}",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == true)
                        {
                            console.log(response.status);
                            window.location.href="{{ route('dashboard') }}";

                        }
                        else
                        {
                            console.log(response);
                            window.location.reload();
                        }

                    },
                    error : function (xhr)
                    {
                        if (xhr.status == 422)
                        {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value)
                            {
                                $('#'+key).addClass("is-invalid")
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(value);
                            });
                        }

                        else if (xhr.status === 429) {
                             let res = JSON.parse(xhr.responseText);
                             console.warn("Too many attempts:", res.message);
                             alert(res.message);
                        }
                        else if(xhr.status === 401)
                        {
                            window.location.reload();
                        }


                    }
                });
            });
        </script>
	</body>
</html>
