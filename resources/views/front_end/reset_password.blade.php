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
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
                @include('include.message')

			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Reset Password</a>
			  	</div>
			  	<div class="card-body">
					<form method="post" id="rest_password_email">
                        @csrf
				  		<div class="input-group mb-3">
                            <input type="hidden" name="id" value="{{ $user->id }}">
							<input type="text" name="password" id="password" class="form-control" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
                            <p></p>
				  		</div>

                        <div class="input-group mb-3">
							<input type="text" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
                            <p></p>
				  		</div>

				  		<div class="row">
							<div class="input-group mb-3">
					  			<button type="submit" class="btn btn-primary btn-block">Send Mail</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
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

            $('#rest_password_email').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($('#rest_password_email')[0]);
                $.ajax({
                    method: "POST",
                    url: "{{ route('reset-password') }}",
                    data: formData,
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == true)
                        {
                            console.log(response);
                            window.location.href="{{ route('user.login') }}";

                        }
                        else
                        {
                            console.log(response);
                            // window.location.reload();
                        }

                    },
                    error : function (xhr)
                    {
                        if (xhr.status == 422)
                        {
                            let errors = xhr.responseJSON.errors;
                            console.log(errors);
                            $.each(errors, function (key, value)
                            {
                                $('#'+key).addClass("is-invalid")
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(value);
                            });
                        }
                    }
                });
            });
        </script>
	</body>
</html>
