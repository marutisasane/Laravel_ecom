<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background-color: #2563eb;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 25px;
            line-height: 1.6;
        }

        .content h2 {
            color: #2563eb;
        }

        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: #fff !important;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 15px;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="text-center text-upper"> Password Reset</h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="update_password">
                            <div class="form-group">
                                <label for="old_password"> Current Password</label>
                                <input type="text" id="old_password" name="old_password" class="form-control" placeholder="Current Password">
                            </div>

                            <div class="form-group">
                                <label for="password"> New Password</label>
                                <input type="text" id="password" name="password" class="form-control" placeholder="Current Password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="text" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Current Password">
                            </div>

                            <div class="form-group mt-4">
                                <button id="update_password" class="btn btn-primary btn-block"> Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
