
<body class="login-body">
<script type="text/javascript">document.title = '<?php echo config_item("site_title");?>: Registration';</script>
<div class="container">

    <form id="registration" class="form-signin signup_form">
        <h2 class="form-signin-heading">
            <em>TaxiDeals</em>
        </h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <div class="form-group clearfix">
                    <div class="col-md-12"><p>Account information</p></div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6"><input name="first_name" type="text" class="form-control" placeholder="First Name" autofocus required maxlength="50"></div>
                    <div class="col-md-6"><input name="last_name" type="text" class="form-control" placeholder="Last Name" required maxlength="50"></div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6">
                        <input name="email_id" type="email" class="form-control" placeholder="Email" required maxlength="100">
                    </div>
                    <div class="col-md-6">
                        <input id="user_name" name="user_name" type="text" class="form-control" placeholder="User Name" required maxlength="50" min="6">
                        <span class="error length_error">User Name should be minimum 6 characters.</span>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6">
                        <input type="password" maxlength="20" required placeholder="Password" class="form-control" name="user_password" id="newPassword">
                    </div>
                    <div class="col-md-6 m-bot15">
                        <input type="password" maxlength="20" required placeholder="Re-type Password" class="form-control" id="confirmNewPassword">
                        <span class="error password_error" style="display: none;">These passwords don't match. Try again?</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="checkbox">
                    <input id="termsServiceAgreement" type="checkbox" value="agree this condition">I agree to TaxiDeals's <a href="<?php echo site_url('Support/termsAndConditionWeb')?>" target="_blank">Terms of Service</a> and <a href="<?php echo site_url('Support/privacyPolicyWeb')?>" target="_blank">Privacy Policy</a>
                </label>
                <span class="error agreement_error">Please agree with the Terms of Service and Privacy Policy.</span>
                <button id="signup_button" class="btn btn-lg btn-login btn-block" type="submit">Sign Up</button>
            </div>
            <div class="clearfix">
            </div>
            <div class="registration clearfix">
                Already have an account?
                <a href="login">
                    Login!
                </a>
            </div>
            <!--<div class="loaderBox registrationLoaderBox">-->
            <!--<div class="three-quarters">-->
            <!--Loading...-->
            <!--</div>-->
            <!--</div>-->
        </div>
    </form>
</div>