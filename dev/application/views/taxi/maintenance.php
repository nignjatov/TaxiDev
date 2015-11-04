<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Maintenance List
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <div class="query_box row-fluid">
                                <div class="container-fluid">
                                    <div class="row m-bot20">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <div class="input-group input-large" data-date="13/07/2013"
                                                     data-date-format="mm/dd/yyyy">
                                                    <input type="text" class="form-control dpd1" name="from"
                                                           placeholder="Date form" id="maintenanceStart">
                                                    <span class="input-group-addon">To</span>
                                                    <input type="text" class="form-control dpd2" name="to"
                                                           placeholder="Date to" id="maintenanceEnd">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" onclick="searchMaintenance()">
                                                        <i class="fa fa-search"></i> Search
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewMaintenance()">
                                                        Add Maintenance<i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="table-responsive">
								<table cellpadding="0" cellspacing="0" border="0"
									class="display table table-bordered tb_roster_paying"
									id="maintenance_list">
									<thead>
									<tr>
										<th></th>
										<th>Taxi #</th>
										<th>Maintenance Task</th>
										<th>Status</th>
										<th>Date</th>
										<th>Parts Required</th>
										<th>Parts Available</th>
										<th>Total Cost AU$</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody></tbody>
								</table>
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
<div class="modal fade" id="maintenanceDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Maintenance</h4>
            </div>
            <form class="form-horizontal" id="maintenanceDetailForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Number</label>
                        <div class="col-md-6">
                            <select class="form-control m-bot15" id="taxi_id" name="taxi_id">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Maintenance Task</label>
                        <div class="col-md-6  m-bot15">
                            <textarea rows="6" class="form-control" id="maintenance_task" name="maintenance_task"></textarea>
                        </div>
                    </div>
                    <div class="form-group m-bot20">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label><input type="radio" id="is_scheduled_yes" name="is_scheduled" value="1">Scheduled</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="is_scheduled_no" name="is_scheduled" value="0">Unscheduled</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date</label>
                        <div class="col-md-6">
                            <input id="maintenance_date" name="maintenance_date" type="text" value="" size="16" class="form-control form-control-inline input-medium default-date-picker">
                            <span class="help-block">Select date</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Time Required (Hour)</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="time_required" name="time_required" type="number" maxlength="2" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Parts Required</label>

                        <div class="col-md-6">
                            <textarea id="parts_required" name="parts_required" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Parts Available</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label><input type="radio" id="parts_available_yes" name="parts_available">Yes</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="parts_available_no" name="parts_available">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Parts Cost (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" id="parts_cost" name="parts_cost" maxlength="6" min="0" class="form-control m-bot15">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Repair Cost (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" id="repair_cost" name="repair_cost" maxlength="6" min="0" class="form-control m-bot15">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>

                        <div class="col-md-6">
                            <textarea id="comment" name="comment" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="maintenance_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Maintenance History';
    $("#nav-accordion li a").removeClass("active");
    $("#maintenance_menu a").addClass("active");
</script>
</html>
