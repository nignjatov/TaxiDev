<body class="choose-subscription-body">
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
    var UserEmail = '<?php echo $userInfo->email_id;?>';
</script>
<div class="container">
    <div class="choose_subs_content" style="margin-top: 90px;">
        <div class="modal-content">
            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title">We're sorry, this feature is not available with your current plan</h4>
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
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Update Subscription';
</script>
<!-- Subscription Buy Success Modal End -->
