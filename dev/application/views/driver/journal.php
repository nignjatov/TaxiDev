<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Journal List
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
                                                           placeholder="Date form" id="journalStart">
                                                    <span class="input-group-addon">To</span>
                                                    <input type="text" class="form-control dpd2" name="to"
                                                           placeholder="Date to" id="journalEnd">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" onclick="searchJournal()">
                                                        <i class="fa fa-search"></i> Search
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewJournal()">
                                                        Add Journal<i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered tb_roster_paying" id="journal_list">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shift</th>
                                    <th>Taxi #</th>
                                    <th>Kilometer Driven</th>
                                    <th>Shift Rate</th>
                                    <th>Fuel Cost</th>
                                    <th>Other Cost</th>
                                    <th>Cash</th>
                                    <th>Eftpos Shift Total</th>
                                    <th>Docket</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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

<!-- Modal View Start -->
<div class="modal fade" id="journalDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Journal</h4>
            </div>
            <form class="form-horizontal" id="journalDetailForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Number</label>
                        <div class="col-md-6">
                            <input id="license_plate_no" name="license_plate_no" type="text" maxlength="30" class="form-control">
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
                            <select id="journal_shift" name="journal_shift" class="form-control form-control-inline input-medium">
                                <option selected value="Morning">Morning</option>
                                <option value="Evening">Evening</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kilometer Driven</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="kilometer_driven" name="kilometer_driven" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Rate</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="shift_rate" name="shift_rate" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fuel Cost</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="fuel_cost" name="fuel_cost" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Other Cost</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="other_cost" name="other_cost" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Cash Payment</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="cash_payment" name="cash_payment" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Eftpos Shift Total</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="eftpos_shift_total" name="eftpos_shift_total" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Docket</label>
                        <div class="col-md-6">
                            <div id="spinner3">
                                <div class="">
                                    <input id="docket" name="docket" type="number" maxlength="6" class="form-control" min="0">
                                </div>
                            </div>
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
                    <button type="button" class="btn btn-info" id="journal_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Journal History';
    $("#nav-accordion li a").removeClass("active");
    $("#journal_menu a").addClass("active");
</script>
</html>
