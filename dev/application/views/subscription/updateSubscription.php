<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
    var UserEmail = '<?php echo $userInfo->email_id;?>';
    document.title = '<?php echo config_item("site_title");?>: Profile';
</script>

<section id="container">
    <div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Way to go! You're ready for an upgrade!</h4>
                </div>
                <div class="modal-body package">
                    <p class="title">You current plan is <?php echo '<strong>'.$currentSubscriptionInfo['title'].'</strong> ('.$currentSubscriptionInfo['amount_html'].')';?></p>
                    <ul>
                        <?php
                        $can_subscribe = false;
                        foreach ($allSubscriptionDetail AS $subscription){
                            $recommended_plan = strcmp($recommendedSubscriptionID,$subscription["id"]) == 0 ? "plan active-plan no-bottom-border recommended_plan" : "choose-plan";
                            $current_plan = strcmp($currentSubscriptionInfo['id'], $subscription["id"]) == 0 ? " plan my_plan" : " choose-plan";

                            if ($can_subscribe == false) {
                                $can_subscribe = strcmp($currentSubscriptionInfo['id'], $subscription["id"]) == 0 ? true : false;
                            }

                            $tag = strcmp($currentSubscriptionInfo['id'], $subscription["id"]) == 0 ? '<p class="rotate">current</p>' : '';
                            $tag = strcmp($recommendedSubscriptionID,$subscription["id"]) == 0 && $tag == '' ? '<p class="rotate">recommended</p>' : $tag;

                            $subscribe_button = $can_subscribe && strcmp($currentSubscriptionInfo['id'], $subscription["id"]) != 0 ? '<a onclick="upgradeSubscription('.$subscription["id"].')" class="col-md-3 text-4">Subscribe</a>' : '';

                            $amount = $subscription["amount"] == 0 ? '<strong>Free</strong>' : '<strong>AU$ '.sprintf("%.2f",$subscription["amount"] / 100).'</strong>/month';

                            echo '<li class="'.$recommended_plan.$current_plan.'" id="subscription_'.$subscription["id"].'"><span class="col-md-4 text-1"><a class="popovers" data-html="true" data-container="#subscription_'.$subscription["id"].'" data-trigger="hover" data-placement="top" data-content="'.$subscription["detail"].'" data-original-title="'.$subscription["title"].'">'.$subscription["title"].'</a></span><span class="col-md-5 text-3">'.$amount.'<em class="discount_information" style="display: none;"></em></span>'.$subscribe_button.$tag.'<span class="col-md-12 clearfix"><p class="free-text">'.$subscription["detail"].'</p> </span></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>