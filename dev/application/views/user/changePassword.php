<body class="login-body">

<div class="container">
    <form id="changePassword" class="form-signin login_form">
        <h2 class="form-signin-heading"><em>TaxiDeals</em></h2>

        <div class="login-wrap">
            <div class="user-login-info">
                <div class="form-group">
                    <h4>Change Password To Your TaxiDeals Account</h4>
                </div>
                <input name="cp_user_password" type="password" class="form-control" placeholder="Password" required>
				<input name="cp_user_password_confirm" type="password" class="form-control" placeholder="Confirm Password" required>
				<input name="cp_user_password_tag" class="hidden" value="<?php echo $tag;  ?>">
            </div>
            <button id="changePasswordSubmit" class="btn btn-lg btn-login btn-block" type="submit">Change</button>

            <div class="loaderBox userLoaderBox">
                <div class="three-quarters">
                    Loading...
                </div>
            </div>

        </div>
    </form>
</div>
<script>
    $(document).bind('keydown', function(e){
        if (e.which == 13){
            $('#changePasswordSubmit').trigger('click');
        }
    });

    document.title = '<?php echo config_item("site_title");?>: Change Password';
</script>