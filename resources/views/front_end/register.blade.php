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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
                @include('include.message')

			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Register Now</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form  method="post" id="registrationForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" id="name" name="name">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" id="email" name="email">
                            <p></p>
                        </div>

                        <div class="form-group">
                            <input type="hidden"  id="code" name="code">
                            <input type="text" class="form-control"  placeholder="Phone" value="{{ old('phone') }}" id="phone" name="phone">
                            <p class="error" style="text-danger"></p>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Password" value="{{ old('password') }}" id="password" name="password">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                            <p></p>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script>
            //for country code mobile

            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "IN",
                separateDialCode: true,
                utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            $(document).ready(function(){
                $('#code').val('+'+phoneInput.s.dialCode);
                //for end country code mobile
                const errorMap = [":- Invalid phone number", ":- Invalid country code", ":- Phone Number is Too short", ":- Phone Number is Too long", ":- Invalid phone number"];
                $('#phone').keyup(function(){

                    $('#code').val('+'+phoneInput.s.dialCode);

                });

                $('.iti__flag-container').click(function(){
                    $('#code').val('+'+phoneInput.s.dialCode);
                });
            });

            setTimeout(() => {
                            $('.alert').fadeOut();
                        }, 4000);

            $('#registrationForm').submit(function (e) {
                 e.preventDefault(); //
                let formData = new FormData($('#registrationForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.saved') }}",
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
                            $('#registrationForm')[0].reset();
                            window.location.href="{{ route('user.login') }}";

                        }
                        else
                        {
                            //  window.location.reload();
                        }
                    },
                    error: function (xhr)
                    {
                        if (xhr.status == 422)
                        {
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').removeClass('invalid-feedback').html('');
                            // $('.invalid-feedback').remove();

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value)
                            {
                                $('#' + key)
                                .addClass('is-invalid')
                                .after('<p class="invalid-feedback ">' + value + '</p>');

                                // $('#'+key).addClass('is-invalid')
                                //       .siblings('p')
                                //       .addClass('invalid-feedback')
                                //       .html(value);
                            });


                        }
                    }
                });
            });




        </script>
	</body>
</html>
