<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
    var UserEmail = '<?php echo $userInfo->email_id;?>';
    document.title = '<?php echo config_item("site_title");?>: Profile';
</script>

<section id="container">
<section id="main-content" class="profile_page">
<section class="wrapper">
<!-- page start-->
<div class="panel-body">
<div class="tab-content">
<div class="tab-pane active">
<div class="row">
<div class="col-md-12">

<section class="panel profile operator section-table">
<header class="panel-heading clearfix">
    <span>Profile</span>
</header>
<div class="panel-body slide_column">
<div class="panel">
<div class="col-md-4">
    <div class="profile_letf">
        <div class="user_info">
            <div class="avatar_wrap">
                <img class="initials"
                     src="http://ldserver-qa.azurewebsites.net/application/views/images/profile_pic_default.png" alt="">
            </div>
            <div class="member_info">
                <h1 class="user-name"><?php echo $userInfo->first_name . ' ' . $userInfo->last_name?></h1>
                <span class="user-email"><?php echo $userInfo->email_id?></span>
            </div>
        </div>
<!--        <div class="profile_footer">-->
<!--            <ul role="tablist">-->
<!--                <li class="active">-->
<!--                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</div>
<div class="col-md-8">
<div class="profile_right">
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="profile">

<div class="profile-item clearfix">
    <div class="label">Your Plan</div>
    <div class="col-md-12 data m-bot20">
        <div class="clearfix">
            <span><?php echo '<strong>'.$currentSubscriptionInfo['title'].'</strong> ('.$currentSubscriptionInfo['amount_html'].')';?></span>
        </div>
        <div class="clearfix">
            <a href="#package_all" data-toggle="modal" >Upgrade Plan</a>
        </div>
    </div>
</div>
    <form id="updateProfileInfo">
<div class="operator_info">
    <div class="profile-item clearfix">
        <div class="label">Account Info</div>
        <div class="field">
            <div class="text-field clearfix m-bot15">
                <div class="col-md-12"><p><?php echo ucfirst($userInfo->user_type)?> Name</p></div>
                <div class="col-md-6">
                    <input type="text" id="pFirstName" name="first_name" class="form-control" placeholder="First Name"
                           autofocus="" maxlength="60" value="<?php echo $userInfo->first_name?>">
                </div>
                <div class="col-md-6 ">
                    <input type="text" id="pLastName" name="last_name" class="form-control" placeholder="Last Name"
                           maxlength="60" value="<?php echo $userInfo->last_name?>">
                </div>
            </div>
            <div class="text-field clearfix m-bot15">
                <div class="col-md-12"><p>Email</p></div>
                <div class="col-md-12">
                    <input type="text" name="email_id" placeholder="Email ID" class="form-control" maxlength="100" value="<?php echo isset($userInfo->email_id) ? $userInfo->email_id : ''?>" required>
                </div>
            </div>
            <?php
            if (strcmp($userInfo->user_type, 'operator') == 0) {
            ?>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>Operator Number</p></div>
                    <div class="col-md-12">
                        <input type="text" name="operator_number" placeholder="Operator Number" class="form-control" maxlength="100" value="<?php echo isset($operatorInfo->operator_number) ? $operatorInfo->operator_number : ''?>"
                               required>
                    </div>
                </div>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>ABN number</p></div>
                    <div class="col-md-12">
                        <input type="text" name="abn_number" placeholder="ABN number" class="form-control" maxlength="100" value="<?php echo isset($operatorInfo->abn_number) ? $operatorInfo->abn_number : ''?>"
                               required>
                    </div>
                </div>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>Number of Taxi operates</p></div>
                    <div class="col-md-12">
                        <input type="number" name="number_of_taxi_operates" placeholder="Number of Taxi operates" class="form-control" value="<?php echo isset($operatorInfo->number_of_taxi_operates) ? $operatorInfo->number_of_taxi_operates : ''?>" required max="99999" min="0">
                    </div>
                </div>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>Contact Name</p></div>
                    <div class="col-md-12">
                        <input type="text" name="contact_name" placeholder="Contact Name" class="form-control" maxlength="100" value="<?php echo isset($operatorInfo->contact_name) ? $operatorInfo->contact_name : ''?>" required>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>Authority Card Number</p></div>
                    <div class="col-md-12">
                        <input type="text" name="authority_card_number" placeholder="Authority Card Number" class="form-control" maxlength="100" value="<?php echo isset($driverInfo->authority_card_number) ? $driverInfo->authority_card_number : ''?>" required>
                    </div>
                </div>
                <div class="text-field clearfix m-bot15">
                    <div class="col-md-12"><p>Authority Card Acquired in</p></div>
                    <div class="col-md-12">
                        <input type="number" name="authority_card_acquired_in" placeholder="Authority Card Acquired in" class="form-control" min="1900" max="2100" value="<?php echo isset($driverInfo->authority_card_acquired_in) ? $driverInfo->authority_card_acquired_in : '1970'?>"
                               required>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="text-field clearfix m-bot15">
                <div class="col-md-12"><p>Contact Number</p></div>
                <div class="col-md-6">
                    <input type="text" name="mobile_1" placeholder="Mobile 1" class="form-control" maxlength="100" value="<?php echo isset($userInfo->mobile_1) ? $userInfo->mobile_1 : ''?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="mobile_2" placeholder="Mobile 2" class="form-control" maxlength="100" value="<?php echo isset($userInfo->mobile_2) ? $userInfo->mobile_2 : ''?>">
                </div>
            </div>
            <div class="text-field clearfix m-bot15">
                <div class="col-md-6">
                    <input type="tel" name="phone" placeholder="Phone" class="form-control" maxlength="100" value="<?php echo isset($userInfo->phone) ? $userInfo->phone : ''?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="fax" placeholder="Fax" class="form-control" maxlength="100" value="<?php echo isset($userInfo->fax) ? $userInfo->fax : ''?>">
                </div>
            </div>
            <div id="profileChangePass">
                <div class="text-field clearfix">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#profileChangePass"
                       href="#profileShowPass">Change Password</a>
                </div>
                <div id="profileShowPass" class="collapse">
                    <div class="text-field clearfix m-bot15">
                        <div class="col-md-12"><p>Change Password</p></div>
                        <div class="col-md-12">
                            <input type="password" id="pCurrentPassword" name="currentPassword" placeholder="Old Password"
                                   class="form-control" maxlength="20">
                            <span class="error empty_current_password_error">Please enter your old password.</span>
                        </div>
                    </div>
                    <div class="text-field clearfix m-bot15">
                        <div class="col-md-12">
                            <input type="password" id="pUserPassword" name="UserPassword" placeholder="New password"
                                   class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="text-field clearfix m-bot15">
                        <div class="col-md-12">
                            <input type="password" id="pConfirmUserPassword" placeholder="Confirm new password"
                                   class="form-control m-bot15" maxlength="50">
                            <span class="error confirm_password_error">New password and confirm password fields do not match or are empty. Try again.</span>
                            <span class="error empty_password_error">Password should not be empty.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-item clearfix">
        <div class="label m-bot15">Contact address</div>
        <div class="field">
            <div class="text-field clearfix m-bot15">
                <div class="col-md-12"><p>State</p></div>
                <div class="col-md-12">
                    <input type="text" name="state" placeholder="State" class="form-control" maxlength="20" value="<?php echo isset($userInfo->state) ? $userInfo->state : ''?>">
                </div>
            </div>
            <div class="text-field clearfix m-bot15">
                <div class="col-md-12"><p>Street Detail</p></div>
                <div class="col-md-6">
                    <input type="text" name="street_name" placeholder="Street Name" class="form-control" maxlength="100" value="<?php echo isset($userInfo->street_name) ? $userInfo->street_name : ''?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="street_number" placeholder="Street Number" class="form-control" maxlength="100" value="<?php echo isset($userInfo->street_number) ? $userInfo->street_number : ''?>" required>
                </div>
            </div>
            <div class="text-field clearfix m-bot15">
                <div class="col-md-6">
                    <input type="text" name="suburb" placeholder="Suburb" class="form-control" maxlength="100" value="<?php echo isset($userInfo->suburb) ? $userInfo->suburb : ''?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="postcode" placeholder="Post Code" class="form-control" maxlength="100" value="<?php echo isset($userInfo->postcode) ? $userInfo->postcode : ''?>">
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="profile_footer">
            <button type="submit" class="btn">Save &amp; Update</button>
        </div>
    </form>


</div>
<div role="tabpanel" class="tab-pane" id="activity">
    Activity
</div>
<div role="tabpanel" class="tab-pane" id="notifications">
    Notifications
</div>
</div>
</div>
</div>

</div>
</div>
</section>
</div>
</div>
</div>
</div>
</div>
<!-- page end-->
</section>
</section>
<!--main content end-->
<!--right sidebar start-->

<!--right sidebar end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<!-- Package Modal Start -->
<div class="modal fade user_profile" id="package_all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Way to go! You're ready for an upgrade!</h4>
            </div>
            <div class="modal-body package">
                <p class="title">You current plan is <?php echo '<strong>'.$currentSubscriptionInfo['title'].'</strong> ('.$currentSubscriptionInfo['amount_html'].')';?></p>
                <div class="free-subscription-border">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <?php
                                foreach ($allSubscriptionDetail AS $subscription){
                                    if($subscription["amount"] == 0){
                                        if($subscription["id"] == 7){
                                            echo '<th class="col-md-6 free-subscription-header-operator"><strong>Free subscription</strong></th>';
                                        } else {
                                            echo '<th class="col-md-6 free-subscription-header-driver"><strong>Free subscription</strong></th>';
                                        }
                                    }
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] == 0){
                                            echo '<td><h3 class="free-subscription-details">'.$subscription["title"].'</h3></td>';
                                        }
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] == 0){
                                            echo '<td><h4 class="free-subscription-details">'.$subscription["detail"].'</h4></td>';
                                        }
                                    }
                                    ?>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                            <?php
                                foreach ($allSubscriptionDetail AS $subscription){
                                    if($subscription["amount"] > 0){
                                        $amount = $subscription["amount"] == 0 ? '<strong>Free</strong>' : '<strong>AU$ '.sprintf("%.2f",$subscription["amount"] / 100).'</strong>/month';
                                        if (strcmp($recommendedSubscriptionID,$subscription["id"]) != 0) {
                                            if(strcmp($currentSubscriptionInfo['id'], $subscription["id"]) != 0){
                                                echo '<th class="normal-subscription-header">'.$amount.'</th>';
                                            } else {
                                                echo '<th class="current-subscription-header"><div>CURRENT</div>'.$amount.'</th>';
                                            }
                                        } else {
                                            if(strcmp($currentSubscriptionInfo['id'], $subscription["id"]) != 0){
                                                echo '<th class="recommended-subscription-header"><div>RECOMMENDED</div>'.$amount.'</th>';
                                            } else {
                                                echo '<th class="current-subscription-header"><div>CURRENT</div>'.$amount.'</th>';
                                            }
                                        }
                                    }
                                }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] > 0){
                                            echo '<td class="normal-subscription-title">'.$subscription["title"].'</td>';
                                        }
                                    }
                                ?>
                            <tr>
                            <tr>
                                <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] > 0){
                                            echo '<td>'.$subscription["detail"].'</td>';
                                        }
                                    }
                                ?>
                            <tr>
                            <tr>
                                <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] > 0){
                                            echo '<td class="trial_commercial">30 Days Free Trial!</td>';
                                        }
                                    }
                                ?>
                            <tr>
                            <tr>
                                <?php
                                    foreach ($allSubscriptionDetail AS $subscription){
                                        if($subscription["amount"] > 0){
                                            if(strcmp($currentSubscriptionInfo['id'], $subscription["id"]) != 0){
                                                echo '<td><div class="centered"><button class="btn btn-default btn_recommendend_subscription" onclick="buySubscription('.$subscription["id"].')">Subscribe</button></div></td>';
                                            } else {
                                                echo '<td></td>';
                                            }
                                        }
                                    }
                                ?>
                            <tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- Package Modal End -->
</body>
</html>