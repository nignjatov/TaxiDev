<script>
    var StripeHandler;
    var SubscriptionDetail = [];
    $(window).on('popstate', function() {
        StripeHandler.close();
    });
    $('.popovers').popover();
    var registrationObject = {
        formValidation: function () {
            $('.password_error').hide();
            $('.agreement_error').hide();
            if ($('#newPassword').val() != $('#confirmNewPassword').val()){
                $('.password_error').show();
                return false;
            }

            if (!$('#termsServiceAgreement').prop('checked')){
                $('.agreement_error').show();
                return false;
            }

            return true;
        },
        getSubscriptionDetail: function (){
            var formURL = '<?php echo site_url("Subscription/getAllSubscriptionDetail")?>';
            cuadroServerAPI.getServerData('GET', formURL, 'JSONp', arguments.callee.name, function(data){
                if (data) SubscriptionDetail = data;
            });
        },
        getSubscriptionDetailFromID: function(subscriptionID){
            var detail = [];
            for (var i = 0; i < SubscriptionDetail.length; i++)  {
                if (SubscriptionDetail[i].id == subscriptionID) {
                    detail = SubscriptionDetail[i];
                    break;
                }
            }

            return detail;
        }
    }

    registrationObject.getSubscriptionDetail();

    var userProfileObject = {
        validateProfileUpdateInfo: function (){
            if ($("#profileShowPass").hasClass("in")) {
                if ($("#pCurrentPassword").val() == ""){
                    $('.empty_current_password_error').show();
                    return false;
                }
                if ($("#pUserPassword").val() == "") {
                    $('.empty_password_error').show();
                    return false;
                }
                if ($("#pUserPassword").val() != $("#pConfirmUserPassword").val()) {
                    $('.confirm_password_error').show();
                    return false;
                }
            }

            return true;
        }
    }

    $("form#registration").submit(function(e){
        var validForm = registrationObject.formValidation();
        console.log(validForm);

        if (!validForm) return false;
//        if ($("#loaderModal").css("display") != "block") cuadroCommonMethods.showModalView('loaderModal');

        var postData = $(this).serializeArray();
        var formURL = "<?php echo site_url('User/createUser')?>";

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'registrationSubmit', function(data){
            console.dir(data);
			
			/*if (data.error['code'] == 0) {
                var success_msg = 'You have successfully registered.';
                cuadroCommonMethods.showGeneralPopUp('Success!!!', success_msg, true);
                <?php echo 'top.location=\''.site_url('User/login').'\';';?>
            } else */if (data.error['code'] == 209) {
				var success_msg = 'You have successfully registered.';
                cuadroCommonMethods.showGeneralPopUp('Success!!!', success_msg + "\n" + data.error['description'], false);
            } else {
                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
//            $(".registrationLoaderBox").hide();
        });
        e.preventDefault(); //STOP default action
    });

	$("#changePasswordSubmit").click(function(){
		if($("#changePasswordForm input[name=cp_user_password]").val() == '')
			cuadroCommonMethods.showGeneralPopUp('Warning!!!', 'Password is empty! ', false);
		else if($("#changePasswordForm input[name=cp_user_password]").val() != $("#changePasswordForm input[name=cp_user_password_confirm]").val())
			cuadroCommonMethods.showGeneralPopUp('Warning!!!', 'Password and Confirm Password are not th same! ', false);
		else {
			var serverURL ='/dev/index.php/User/resetPassword?pass='+ $('#changePasswordForm input[name=cp_user_password]').val() + "&tag='" + $("#changePasswordForm input[name=cp_user_password_tag]").val()+"'";
			cuadroServerAPI.getServerData('GET', serverURL, '', arguments.callee.name, function(data){
				if(data)
					cuadroCommonMethods.showGeneralPopUp('Success!!!', 'Password is successfuly changed! Please Login. ', false);
				else	
					cuadroCommonMethods.showGeneralPopUp('Error!!!', 'Password change failed. ', false);
			});
		}
	});
	
    $("form#userLogin").submit(function(e){
        var postData = $(this).serializeArray();
        var formURL = "<?php echo site_url('User/userLogin')?>";

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'loginSubmit', function(data){
            console.dir(data);
			
            if (data.error['code'] == 0) {
                var success_msg = 'You have successfully registered.';
                cuadroCommonMethods.showGeneralPopUp('Success!!!', success_msg, true);
                <?php echo 'top.location=\''.site_url('Dashboard/viewDashboard').'\';';?>
            } else if (data.error['code'] == 209) {
                cuadroCommonMethods.showGeneralPopUp('Warning!!!', data.error['description'], false);
            } else {
                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
//            $(".registrationLoaderBox").hide();
        });

        e.preventDefault(); //STOP default action
    });

    $("form#updateProfileInfo").submit(function(e){
        var validForm = userProfileObject.validateProfileUpdateInfo();
        if (!validForm) return false;

        var changePasswordString = "";
        if ($("#profileShowPass").hasClass("in")) {
            changePasswordString = "?userPassword=" + $("#pUserPassword").val() + "&currentPassword=" + $("#pCurrentPassword").val();
        } else {
            $("#pCurrentPassword").val("");
        }

        var postData = $(this).serializeArray();
        var formURL = "<?php echo site_url('User/updateProfile')?>" + changePasswordString;

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'updateProfileInfo', function(data){
            console.dir(data);
            if (data.result.result) {
                $(".clientName").html($("#pFirstName").val() + " " + $("#pLastName").val());
            } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
//            $(".registrationLoaderBox").hide();
        });
        e.preventDefault(); //STOP default action
    });

    function upgradeSubscription(subscriptionID){
        var planTitle = SubscriptionDetail[subscriptionID-1].title;
        StripeHandler = StripeCheckout.configure({
            key: '<?php echo config_item('stripe_publishable'); ?>',
            image: '<?php echo base_url()?>application/views/img/stripe_logo.png',
            token: function(token) {
                SubscriptionToken = token.id;
                $("#package_all").modal('hide');
//                if ($("#loaderModal").css("display") != "block") cuadroCommonMethods.showModalView('loaderModal');
                var formURL = '<?php echo site_url('Subscription/upgradeSubscription')?>?plan='+SubscriptionDetail[subscriptionID-1].stripe_id+'&coupon=&stripeToken='+SubscriptionToken;

                cuadroServerAPI.getServerData('GET', formURL, '', arguments.callee.name, function(data){
                    if (data == 'success') {
                        cuadroCommonMethods.resetModal('stripeUpdateSuccess');
                        $("#stripeUpdateSuccess .note").html('[' + planTitle + ']');
                        cuadroCommonMethods.showModalView("stripeUpdateSuccess");
                    }
                });
            }
        });
        // Open Checkout with further options
//        console.log(SubscriptionDetail[subscriptionID-1]);
        StripeHandler.open({
            name: "<?php echo config_item('site_title')?>",
            description: "Charge for upgrade to " + SubscriptionDetail[subscriptionID-1].SubscriptionTitle,
            amount: SubscriptionDetail[subscriptionID-1].Amount,
            panelLabel: "Upgrade Now",
            email: UserEmail,
            closed : function(){

            }
        });
    }

    function buySubscription(subscriptionID){
        var discount = 0;
        var planTitle = SubscriptionDetail[subscriptionID-1].title;
        var amount = SubscriptionDetail[subscriptionID-1].amount;
        if(amount > 0){
            StripeHandler = StripeCheckout.configure({

                key: '<?php echo config_item('stripe_publishable'); ?>',
                image: '<?php echo base_url()?>application/views/img/stripe_logo.png',
                token: function(token) {
                    SubscriptionToken = token.id;
                    var formURL = '<?php echo site_url('Subscription/buySubscription')?>?plan='+SubscriptionDetail[subscriptionID-1].stripe_id+'&coupon=&stripeToken='+SubscriptionToken;

                    cuadroServerAPI.getServerData('GET', formURL, '', arguments.callee.name, function(data){
                        if (data == 'success') {
                            /* BUG resetModal does not work. */
                            //cuadroCommonMethods.resetModal('stripeBuySuccess');
                            $("#stripeBuySuccess .note").html('[' + planTitle + ']');
                            cuadroCommonMethods.showModalView("stripeBuySuccess");
                            <?php echo 'top.location=\''.site_url('Dashboard/viewDashboard').'\';';?>
                        }
                    });
                }
            });
            StripeHandler.open({

                name: "<?php echo config_item('site_title')?>",
                description: "One year subscription fee for " + SubscriptionDetail[subscriptionID-1].title,
                amount: SubscriptionDetail[subscriptionID-1].amount,
                panelLabel: "Buy Now",
                email: UserEmail,
                closed : function(){
                }
            });
        } else {
            var formURL = '<?php echo site_url('Subscription/buyFreeSubscription')?>?plan='+SubscriptionDetail[subscriptionID-1].stripe_id;
                cuadroServerAPI.getServerData('GET', formURL, '', arguments.callee.name, function(data){
                    if (data == 'success') {

                        $("#stripeBuySuccess .note").html('[' + planTitle + ']');
                        cuadroCommonMethods.showModalView("stripeBuySuccess");
                        <?php echo 'top.location=\''.site_url('Dashboard/viewDashboard').'\';';?>
                    }
                });
        }
    }

    function successfullyBuy(){
        <?php echo 'top.location=\''.site_url('Dashboard/viewDashboard').'\';';?>
    }

    function forgotPassword(){
        var serverURL ='/dev/index.php/User/forgotPassword?user='+ $("#userLogin input[name=user_name]").val();
		cuadroServerAPI.getServerData('GET', serverURL, '', arguments.callee.name, function(data){
			if(data == 'success') {
				cuadroCommonMethods.showGeneralPopUp('Forgot Password!', 'Password recivery mail is sent to your e-mail address.', false);
			} else {
				cuadroCommonMethods.showGeneralPopUp('Error!!!', 'Not existing username', false);
			}
		});
    }

    /*$('button#forgotPasswordButton').click(function(e){
        $('#modalForgotPassword').modal('hide');
        if ($("#loaderModal").css("display") != "block") cuadroCommonMethods.showModalView('loaderModal');
        var UserEmail = $('#UserEmail').val();
        var res = UserEmail.split("@");
        var serverURL = '<?php echo site_url("User/forgotPassword")?>'+'/'+res[0]+'/'+res[1];

        cuadroServerAPI.getServerData('GET', serverURL, '', arguments.callee.name, function(data){
            if (data == 'invalid email') {
                showGeneralPopUp('Error!!!','<?php echo config_item('invalid_email_error_msg');?>', false);
            } else if (data == 1) {
                var success_msg = 'A mail has been send to your email address for recovering password.';
                showGeneralPopUp('Success!!!', success_msg, true);
            } else {
                showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
            }
        });

        e.preventDefault(); //STOP default action
    });*/
</script>
</body>
</html>
