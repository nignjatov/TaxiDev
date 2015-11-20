<body class="login-body">

<div class="container">

    <form id="userLogin" class="form-signin login_form">
        <h2 class="form-signin-heading"><em>TaxiDeals</em></h2>

        <div class="login-wrap">
            <div class="user-login-info">
                <div class="form-group">
                    <h4>Login to Your TaxiDeals Account</h4>
                </div>
                <input name="user_name" type="text" class="form-control" placeholder="Username or Email" autofocus
                       required>
                <input name="user_password" type="password" class="form-control" placeholder="Password" required>
            </div>
            <label class="checkbox">
                <input id="rememberMe" name="rememberMe" type="checkbox" value="remember-me">Remember me
					<span class="pull-right">
						<a data-toggle="modal" onclick="forgotPassword()">Forgot Password?</a>

					</span>
            </label>
            <button id="userSignIn" class="btn btn-lg btn-login btn-block" type="submit">Login</button>

            <div class="registration">
                Don't have an account yet?
                <a class="" href="<?php echo site_url('User/register')?>">
                    Create an account
                </a>
            </div>

            <div class="loaderBox userLoaderBox">
                <div class="three-quarters">
                    Loading...
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalForgotPassword" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password </h4>
                    </div>
                    <div class="modal-body">
                        <p>Password recivery mail is sent to e-mail address.</p>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </form>
</div>
<script>
    $(document).bind('keydown', function(e){
        if (e.which == 13){
            $('#userSignIn').trigger('click');
        }
    });

    document.title = '<?php echo config_item("site_title");?>: Log In';
</script>