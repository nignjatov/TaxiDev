<body class="choose-subscription-body">
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
    var UserEmail = '<?php echo $userInfo->email_id;?>';
    document.title = '<?php echo config_item("site_title");?>: Choose Subscription';
</script>
<div class="container">
    <div class="choose_subs_content">
        <h2 class="heading">
            <em>LifeData</em>
        </h2>
        <div class="modal-content">
            <div class="modal-body package">
                <p class="title">Choose Your Subscription Plan</p>
                <ul>
                    <?php
                    foreach ($allSubscriptionDetail AS $subscription){
                        $amount = $subscription["amount"] == 0 ? '<strong>Free</strong>' : '<strong>AU$ '.sprintf("%.2f",$subscription["amount"] / 100).'</strong>/month';
                        if (strcmp($recommendedSubscriptionID,$subscription["id"]) == 0) {
                            echo '<li class="plan active-plan no-bottom-border recommended_plan" id="subscription_'.$subscription["id"].'"><span class="col-md-4 text-1"><a class="popovers" data-html="true" data-container="#subscription_'.$subscription["id"].'" data-trigger="hover" data-placement="top" data-content="'.$subscription["detail"].'" data-original-title="'.$subscription["title"].'">'.$subscription["title"].'</a></span><span class="col-md-5 text-3">'.$amount.'<em class="discount_information" style="display: none;"></em></span><a onclick="buySubscription('.$subscription["id"].')" class="col-md-3 text-4">Subscribe</a><p class="rotate">recommended</p><span class="col-md-12 clearfix"><p class="free-text">'.$subscription["detail"].'</p> </span></li>';
                        } else {
                            echo '<li class="choose-plan" id="subscription_'.$subscription["id"].'"><span class="col-md-4 text-1"><a class="popovers" data-html="true" data-container="#subscription_'.$subscription["id"].'" data-trigger="hover" data-placement="top" data-content="'.$subscription["detail"].'" data-original-title="'.$subscription["title"].'">'.$subscription["title"].'</a></span><span class="col-md-5 text-3">'.$amount.'<em class="discount_information" style="display: none;"></em></span><a onclick="buySubscription('.$subscription["id"].')" class="col-md-3 text-4">Subscribe</a><span class="col-md-12 clearfix"><p class="free-text">'.$subscription["detail"].'</p> </span></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
            </div>
            <div class="registration clearfix">
                <a href="<?php echo site_url('User/logout')?>">
                    Log Out
                </a>
            </div>
        </div>

    </div>

</div>