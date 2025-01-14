<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="description" content="VTNN - KHAI MAI">
    <meta name="keywords" content="VTNN - KHAI MAI">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/client/Logo.jpg"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu</title>

    <!-- FontAwesome JS-->
    <script defer src="/admins/assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="/admins/assets/css/portal.css">

</head> 

<body class="app app-signup p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href=""><img class="logo-icon me-2" src="/admins/assets/images/logo.jpg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Đặt lại mật khẩu</h2>					
	
					<div class="auth-form-container text-start mx-auto">
						{{-- @include('admin.layouts.alert') --}}

						<form class="auth-form auth-signup-form" method="POST" action="{{ route('reset.password') }}">         
							@csrf
                            <input type="hidden" name="token" value="{{ $token }}">
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email" value="{{ $email ?? old('email') }}" placeholder="Email" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Mật khẩu</label>
								<input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Mật khẩu" required autocomplete="new-password">
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Xác nhận mật khẩu</label>
								<input id="signup-password" name="password_confirmation" type="password" class="form-control signup-password" placeholder="Xác nhận mật khẩu" required autocomplete="new-password">
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="RememberPassword" name="remember">
									<label class="form-check-label" for="RememberPassword">
									Nhớ mật khẩu
									</label>
								</div>
							</div><!--//extra-->
							
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Đặt lại mật khẩu</button>
							</div>
						</form><!--//auth-form-->
					</div><!--//auth-form-container-->	
			    </div><!--//auth-body-->
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask"></div>
		    
	    </div><!--//auth-background-col-->
    </div><!--//row-->
</body>
</html> 

