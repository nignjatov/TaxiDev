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
					
                        <div class="row">	
							<div class="col-md-2">
								Select a taxi 
								<select id="filterTaxi" class="form-control" onchange="filterTaxi()">
									<option value=''>All</option>
								</select>
							</div>
							<div class="col-md-2">	
								Select a week 
								<select id="filterWeek" class="form-control" onchange="filterWeek()">
									<option from="" to="">None</option>
									<?php
									/* fiscal year from july 1 to june 30 */
									function getStartAndEndDate($week, $year, $fromOrTo){
										$time = strtotime("1 July $year", time());
										$day = date('w', $time);
										$time += ((7*$week)+1-$day)*24*3600;
										$return_from = date($time);
										$time += 6*24*3600;
										$return_to = date($time);
										
										if($fromOrTo == 1)
											return $return_from;
										else
											return $return_to;
									}
									
									$currentYear = date("Y");
									if (date('n') < 7) // if before July
										$currentYear = $currentYear - 1;
									
									for ($i=1;$i<=52;$i++)
										echo '<option from="'.getStartAndEndDate($i,$currentYear,1).'" to="'.getStartAndEndDate($i,$currentYear,2).'">' . $i .'</option>';
									?>
								</select>
							</div>
						</div>
						
						</br>
	
						<div class="row">	
							<div class="col-md-4">	
								<div class="input-group input-large">
									<input type="text" class="form-control" placeholder="Date from" id="filterDateFrom" >
									<span class="input-group-addon">To</span>
									<input type="text" class="form-control" placeholder="Date to" id="filterDateTo">
								</div>
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<div class="btn-group pull-right">
                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewRoster()">
										Add Roster & Paying<i class="fa fa-plus"></i>
                                    </a>
								</div>										
							</div>
						</div>
	
						</br>
	
						<div class="row">
							<div class="col-md-6">
								Number of rows:
								<select class="form-control" style="width: auto;" id="previewTableRowNumber" onchange="setRowsNumer();">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
								</select>
							</div>
							
							<div class="col-md-6">
								<label>	</label>
								<input type="text" class="form-control" placeholder="Search" id="filterGeneral" onkeyup="filterSearch()">										
							</div>
						</div>
	
						</br>
	
						<div class="row">	
							<div class="col-md-12 table-responsive">
								<table id="previewTable" class="table table-bordered" style="background-color:white;">
							        <thead>
										<tr>
											<th></th>
											<th>Taxi # <span class="fa fa-sort" onclick="sort('taxi_id', 1)"></span></th>
											<th>Date <span class="fa fa-sort" onclick="sort('paying_date', 2)"></span></th>
											<th>Shift <span class="fa fa-sort" onclick="sort('shift', 3)"></span></th>
											<th>Leased <span class="fa fa-sort" onclick="sort('is_leased', 4)"></span></th>
											<th>Driver Name <span class="fa fa-sort" onclick="sort('driver_name', 5)"></span></th>
											<th>Paid <span class="fa fa-sort" onclick="sort('is_paid', 6)"></span></th>
											<th>Amount Paid 
											  <a href="#" data-toggle="tooltipAmount" title="Total amount paid by driver. The total amount is Cash, Eftpos Shift total and Other Dockets combined."><i class="fa fa-question-circle"></i></a>
											  <span class="fa fa-sort" onclick="sort('amount_paid', 7)">
											</th>
											<th>Balance 
											  <a href="#" data-toggle="tooltipBalance" title="Balance confirms cash, eftpos and other dockets paid by driver is equal to amount paid. Therefore, balance should be zero. If no cash,eftpos,docket entries are made the balance should be equal to amount paid."><i class="fa fa-question-circle"></i></a>
											</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div> 
						</div>	
						<div class="row">
							<div class="col-md-6" id="previewTableFooter1">
							</div>
							<div class="col-md-6" id="previewTableFooter2">
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
                            <input id="paying_date" name="paying_date" type="text" value="" size="16" class="form-control form-control-inline input-medium default-date-picker" required>
                            <span class="help-block">Select date</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label><input type="radio" id="shift_morning" name="shift" onclick="$('#shift_morning').val('Morning')">Morning</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="shift_evening" name="shift" onclick="$('#shift_evening').val('Evening')">Evening</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Leased</label>
                        <div class="col-md-6  m-bot15">
                            <div class="radio">
                                <label><input type="radio" id="is_leased_yes" name="is_leased" onclick="$('#is_leased_yes').val(1)">Yes</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="is_leased_no" name="is_leased" onclick="$('#is_leased_no').val(0)">No</label>
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
                                <label><input type="radio" id="is_paid_yes" name="is_paid" onclick="$('#is_paid_yes').val(1)">Yes</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" id="is_paid_no" name="is_paid" onclick="$('#is_paid_no').val(0)">No</label>
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
                        <label class="control-label col-md-3">Eftpos dockets (AU$)</label>

                        <div class="col-md-6">
                            <input type="number" min="0" max="999999" data-bv-notempty-message="" required
                                   class="form-control m-bot15" name="mf_amount" id="mf_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Other dockets (AU$)</label>

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
					<div id="rosterDetailModalAlert" class="alert alert-danger hidden" role="alert"><p class="text-center"></p></div>
                    <button type="button" class="btn btn-info" id="roster_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Roster & Paying';
    $("#nav-accordion li a").removeClass("active");
    $("#roster_menu a").addClass("active");
</script>
</html>

