<?php
/**
 * Created By: Amalesh Debnath
 * Date: 7/12/14
 * Time: 2:19 PM
 */
?>
<!-- Confirmation Modal Start -->
<div class="modal fade confirmation_modal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <span class="alert-icon"><i class="fa fa-question"></i></span>
                    <div class="confirmationMessage notification-info">
                        You are about to delete this <span id="delete_item"></span>, Are you sure?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                <button data-dismiss="modal" id="confirmDelete" class="btn btn-danger" type="button">Yes i am sure</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Modal End -->
<!-- Loader Modal Start -->
<div class="modal fade" id="loaderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="loaderBox">
                    <div class="three-quarters">
                        Loading...
                    </div>
                    <span>Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Loader Modal End -->
<!-- No Data Message Start -->
<div id="no_data_message" class="warning_message light modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header error">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">
                <div class="content">
                    <i class="fa fa-warning"></i>
                    <p>
                        <label>Sorry, but there is no data yet. Please try again later.</label>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- No Data Message End -->
<!-- Subscription Update Needed Modal Start -->
<div class="modal fade " id="subscriptionUpdateNeeded" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscription Update Needed</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <span class="alert-icon"><i class="fa fa-question"></i></span>
                    <div class="error_msg confirmationMessage notification-info">
                        You need to update your current subscription to do this action.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Ok</button>
                <button data-dismiss="modal" class="btn btn-info upgradeSubscription" type="button">Upgrade Subscription</button>
            </div>
        </div>
    </div>
</div>
<!-- Widget Delete Confirmation Modal End -->
<!-- Subscription Update Success Modal Start -->
<div class="modal fade" id="stripeUpdateSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Your subscription has been successfully updated. </h4>
            </div>
            <div class="modal-body">
                <h4>Thank you for purchasing a <?php echo config_item('site_title');?> <span class="note"></span> subscription.</h4>
                <h4>We want to support you in your efforts and value feedback. Please do not hesitate to reach out to us, whatever the need.</h4>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-info" type="button" onclick="successfullyBuy()">
                    Take me to Dashboard
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Subscription Update Success Modal End -->

<!-- Subscription Buy Success Modal Start -->
<div class="modal fade" id="stripeBuySuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Welcome to <?php echo config_item('site_title');?></h4>
            </div>
            <div class="modal-body">
                <h4>Thank you for purchasing a <?php echo config_item('site_title');?> <span class="note"></span> subscription.</h4>
                <h4>We want to support you in your efforts and value feedback. Please do not hesitate to reach out to us, whatever the need.</h4>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-info" type="button" onclick="successfullyBuy()">
                    Take me to Dashboard
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Subscription Buy Success Modal End -->
<!-- Subscription Buy Success Modal Start -->
<div class="modal fade" id="stripeBuySuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                        onclick="successfullyBuy()">&times;</button>
                <h4 class="modal-title">Payment Success</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button" onclick="successfullyBuy()">Ok
                </button>
            </div>
        </div>
    </div>
</div>