<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Roster & Paying List
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
                                                           value="Date form" id="rosterStart">
                                                    <span class="input-group-addon">To</span>
                                                    <input type="text" class="form-control dpd2" name="to"
                                                           value="Date to" id="rosterEnd">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-default" onclick="searchRoster()">
                                                        <i class="fa fa-search"></i> Search
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewRoster()">
                                                        Add Roster & Paying<i class="fa fa-plus"></i>
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
                                   id="roster_list">
									<thead>
									<tr>
										<th></th>
										<th>Taxi #</th>
										<th>Date</th>
										<th>Shift</th>
										<th>Driver Name</th>
										<th>Paid</th>
										<th>Amount Paid</th>
										<th>Balance</th>
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
<div class="modal fade" id="rosterDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Update Roster & Paying</h4>
            </div>
            <form method="POST" class="form-horizontal" id="rosterDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Number</label>
                        <div class="col-md-6">
                            <select class="form-control m-bot15" id="taxi_id" name="taxi_id">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date</label>
                        <div class="col-md-6">
                            <input id="paying_date" name="paying_date" type="text" value="" size="16" class="form-control form-control-inline input-medium default-date-picker">
                            <span class="help-block">Select date</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label>
                                    <input type="radio" id="shift_morning" name="shift"
                                           checked="checked" value="Morning">Morning</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="Evening" id="shift_evening" name="shift">Evening</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Leased</label>
                        <div class="col-md-6  m-bot15">
                            <div class="radio">
                                <label>
                                    <input type="radio" id="is_leased_yes" name="is_leased"
                                           checked="checked" value="1">Yes</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" id="is_leased_no" name="is_leased" value="0">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Driver Name</label>

                        <div class="col-md-6">
                            <input type="text" maxlength="50" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="driver_name" id="driver_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Paid</label>

                        <div class="col-md-6  m-bot15">
                            <div class="radio">
                                <label>
                                    <input type="radio" id="is_paid_yes" name="is_paid"
                                           checked="checked" value="1">Yes</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" id="is_paid_no" name="is_paid" value="0">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Amount Paid (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="amount_paid" id="amount_paid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">MF (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="mf_amount" id="mf_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">M7 (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="m7_amount" id="m7_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Cash (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="cash_amount" id="cash_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fine/Toll (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="fine_toll_amount" id="fine_toll_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Expenses (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="expenses" id="expenses">
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
                    <button type="button" class="btn btn-info" id="roster_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Roster & Paying';
    $("#nav-accordion li a").removeClass("active");
    $("#roster_menu a").addClass("active");
</script>
</html>
