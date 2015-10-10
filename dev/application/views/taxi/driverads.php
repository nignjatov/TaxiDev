<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        General Ad List
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <div class="query_box row-fluid">
                                <div class="container-fluid">
                                    <div class="row m-bot20">
                                        <div class="form-group">
                                            <div class="col-md-offset-8 col-md-4">
                                                <div class="btn-group pull-right">
                                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"">
                                                        Add General Ad<i class="fa fa-plus"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#driversWantedPostModal" data-toggle="modal">Drivers Wanted Post</a></li>
                                                        <li><a href="#taxiAddPostModal" data-toggle="modal">Taxi Add Post</a></li>
                                                        <li><a href="#WantToDrivePostModal" data-toggle="modal">Want to Drive Post</a></li>
                                                        <li><a href="#CPLSPostModal" data-toggle="modal">Car/Plate/Lease/Sale Post</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="driverads_list" cellpadding="0" cellspacing="0" border="0" class="dynamic-table display table table-bordered">
                                <thead>
                                <tr>
                                    <th>Shift Start</th>
                                    <th>Shift End</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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

<!-- Drivers Want Post Modal View Start -->
<div class="modal fade" id="driversWantedPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Drivers Wanted Post</h4>
            </div>
            <form class="form-horizontal" id="driverAdsDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Start</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift End</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="driverads_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Drivers Want Post Modal View End -->

<!-- Taxi add post Modal View Start -->
<div class="modal fade" id="taxiAddPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Taxi post</h4>
            </div>
            <form class="form-horizontal" id="driverAdsDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Start</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift End</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="driverads_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Taxi add post  Modal View End -->

<!-- Want to drive post Modal View Start -->
<div class="modal fade" id="WantToDrivePostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Want to Drive post</h4>
            </div>
            <form class="form-horizontal" id="driverAdsDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Start</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift End</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="driverads_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Want to drive post Modal View End -->

<!-- CPLS Post Modal View Start -->
<div class="modal fade" id="CPLSPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Car/Plate/Lease/Sale post</h4>
            </div>
            <form class="form-horizontal" id="driverAdsDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Start</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift End</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="driverads_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CPLS Post Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Driver Wanted Ads\' List';
    $("#nav-accordion li a").removeClass("active");
    $("#driver_ad_menu a").addClass("active");
</script>
</html>
