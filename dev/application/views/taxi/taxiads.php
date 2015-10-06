<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Taxi Ad List
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <div class="query_box row-fluid">
                                <div class="container-fluid">
                                    <div class="row m-bot20">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewTaxiAds()">
                                                        Add Taxi Ads <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--right sidebar start-->

<!--right sidebar end-->

</section>

<!-- Modal View Start -->
<div class="modal fade" id="taxiAdsDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Taxi Ad</h4>
            </div>
            <form class="form-horizontal" id="taxiAdsDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Number</label>
                        <div class="col-md-6">
                            <select class="form-control m-bot15" id="taxi_id" name="taxi_id"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Days</label>
                        <div class="col-md-6">
                            <input type="number" maxlength="50" class="form-control m-bot15" id="days" name="days">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Start</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift End</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="shift_end" name="shift_end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Lease Rate</label>
                        <div class="col-md-6">
                            <input type="number" maxlength="50" class="form-control m-bot15" id="lease_rate" name="lease_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea rows="6" class="form-control" name="comment" id="comment"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="taxiads_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Taxi Ads\' List';
    $("#nav-accordion li a").removeClass("active");
    $("#taxi_ad_menu a").addClass("active");
    $("#operator_menu").addClass("active");
</script>
</html>
