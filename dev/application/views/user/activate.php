
<body class="login-body">
<script type="text/javascript">document.title = '<?php echo config_item("site_title");?>: Activation';</script>
<div class="container">
    <form id="Activation" class="form-signin signup_form">
        <h2 class="form-signin-heading">
            <em>TaxiDeals</em>
        </h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <div class="form-group clearfix">
                    <div class="col-md-12"><p>Account information</p></div>
                </div>
				<?php 
					if($status == true)
						echo '<span>You have successfuly activated your account. Please <a href="login">Login!</a></span>';
					else	
						echo '<span>Activation failed! Go to <a href="login">Login!</a></span>';				
				?>
            </div>
        </div>
    </form>
</div>