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
                                                        <li><a href="#GeneralAdDriversWantedModal" data-toggle="modal">Drivers Wanted Post</a></li>
                                                        <li><a href="#GeneralAdTaxiAddModal" data-toggle="modal">Taxi Add Post</a></li>
                                                        <li><a href="#GeneralAdWantToDriveModal" data-toggle="modal">Want to Drive Post</a></li>
                                                        <li><a href="#GeneralAdCPLSModal" data-toggle="modal">Car/Plate/Lease/Sale Post</a></li>
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
<div class="modal fade" id="GeneralAdDriversWantedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Drivers Wanted Post</h4>
            </div>
            <form class="form-horizontal" id="GeneralAdDriversWantedForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Looking for</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6"><input type="checkbox" name="looking_for_1" value="Driver"> Driver</label>
							<label class="btn btn-default col-md-6"><input type="checkbox" name="looking_for_2" value="Shift Share Partners"> Shift Share Partners</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type</label>
						<div id="add_dwp_type" class="btn-group col-md-6" data-toggle="buttons">
							<button type="button" class="active btn btn-default col-md-6" value="Taxi">Taxi</button>
							<button type="button" class="btn btn-default col-md-6" value="Hire Car">Hire Car</button>
							<input type="hidden" name="type" id="add_dwp_type_input" value="Taxi">
							<script>
								$("#add_dwp_type > .btn").click(function(){
									$("#add_dwp_type > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_dwp_type_input").val($(this).val());
								});
							</script>
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="state">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/states.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="area">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/areas.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="network">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/networks.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_1" value="Day"> Day
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_2" value="Night"> Night
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_3" value="Night Plate"> Night Plate
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Days</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_1" value="Monday"> Monday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_2" value="Tuesday"> Tuesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_3" value="Wednesday"> Wednesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_4" value="Thursday"> Thursday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_5" value="Friday"> Friday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_6" value="Saturday"> Saturday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="days_7" value="Sunday"> Sunday
							</label>
						</div>
                    </div>					
					<div class="form-group">
                        <label class="control-label col-md-3">Available vehicles</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_4" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_5"></textarea>
							</div>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="GeneralAdDriversWantedSubmit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Drivers Want Post Modal View End -->

<!-- Taxi add post Modal View Start -->
<div class="modal fade" id="GeneralAdTaxiAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Taxi post</h4>
            </div>
            <form class="form-horizontal" id="GeneralAdTaxiAddForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type</label>
						<div id="add_taxi_type" class="btn-group col-md-6" data-toggle="buttons">
							<button type="button" class="active btn btn-default col-md-6" value="Taxi">Taxi</button>
							<button type="button" class="btn btn-default col-md-6" value="Hire Car">Hire Car</button>
							<input type="hidden" name="type" id="add_taxi_input" value="Taxi">
							<script>
								$("#add_taxi_type > .btn").click(function(){
									$("#add_taxi_type > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_taxi_input").val($(this).val());
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="state">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/states.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="area">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/areas.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="network">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/networks.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Taxi Plate</label>
                        <div class="col-md-6">
                            <input id="add_taxi_post_plate" type="text" class="form-control m-bot15" name="plate">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift Available</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_1" value="Monday"> Monday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_2" value="Tuesday"> Tuesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_3" value="Wednesday"> Wednesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_4" value="Thursday"> Thursday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_5" value="Friday"> Friday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_6" value="Saturday"> Saturday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_7" value="Sunday"> Sunday
							</label>
						</div>
                    </div>	
					
					<div class="form-group">
                        <div class="btn-group col-md-3" data-toggle="buttons">
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="dshift" value="Day Shift"> Day Shift
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="nshift" value="Night Shift"> Night Shift
							</label>
						</div>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_1" value="Monday"> Monday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_2" value="Tuesday"> Tuesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_3" value="Wednesday"> Wednesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_4" value="Thursday"> Thursday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_5" value="Friday"> Friday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_6" value="Saturday"> Saturday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="ndays_7" value="Sunday"> Sunday
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Manufacturer</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="car">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/cars.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Year Manufactured</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" name="year">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Fuel Type</label>
						<div id="add_taxi_fuel_type" class="btn-group col-md-6">
							<button type="button" class="active btn btn-default col-md-6" value="LPG">LPG</button>
							<button type="button" class="btn btn-default col-md-6" value="Petrol">Petrol</button>
							<input type="hidden" name="fuel" id="add_taxi_fuel_input" value="LPG">
							<script>
								$("#add_taxi_fuel_type > .btn").click(function(){
									$("#add_taxi_fuel_type > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_taxi_fuel_input").val($(this).val());
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Kilometres travelled</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="kilometers">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
                            </select>
						</div>
                    </div>			
					<div class="form-group">
                        <label class="control-label col-md-3">Vehicle type</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_4" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_5"></textarea>
							</div>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Options included</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="option_1" value="Baby capsule"> Baby capsule
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="option_2" value="Wheelchair accessible"> Wheelchair accessible  
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Lease Rate/Term</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" id="driver_shift_start" name="lease">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">File upload</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="GeneralAdTaxiAddSubmit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Taxi add post  Modal View End -->

<!-- Want to drive post Modal View Start -->
<div class="modal fade" id="GeneralAdWantToDriveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Want to Drive post</h4>
            </div>
            <form class="form-horizontal" id="GeneralAdWantToDriveForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type</label>
						<div id="add_wtd_type" class="btn-group col-md-6" data-toggle="buttons">
							<button type="button" class="active btn btn-default col-md-6" value="Taxi">Taxi</button>
							<button type="button" class="btn btn-default col-md-6" value="Hire Car">Hire Car</button>
							<input type="hidden" name="type" id="add_wtd_input" value="Taxi">
							<script>
								$("#add_wtd_type > .btn").click(function(){
									$("#add_wtd_type > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_wtd_input").val($(this).val());
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="state">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/states.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="area">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/areas.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="network">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/networks.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Prefered Shift</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_1" value="Day"> Day
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_2" value="Night"> Night
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="shift_3" value="Night Plate"> Night Plate
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Days</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_1" value="Monday"> Monday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_2" value="Tuesday"> Tuesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_3" value="Wednesday"> Wednesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_4" value="Thursday"> Thursday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_5" value="Friday"> Friday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_6" value="Saturday"> Saturday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="days_7" value="Sunday"> Sunday
							</label>
						</div>
                    </div>					
					<div class="form-group">
                        <label class="control-label col-md-3">Prefered Vehicles</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="vehicles_4" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_5"></textarea>
							</div>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="GeneralAdWantToDriveSubmit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Want to drive post Modal View End -->

<!-- CPLS Post Modal View Start -->
<div class="modal fade" id="GeneralAdCPLSModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Car/Plate/Lease/Sale post</h4>
            </div>
            <form class="form-horizontal" id="GeneralAdCPLSForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Want To</label>
						<div id="add_cpls_want_to" class="btn-group col-md-6" data-toggle="buttons">
							<button type="button" class="active btn btn-default col-md-4" value="Sell">Sell</button>
							<button type="button" class="btn btn-default col-md-4" value="Lease">Lease</button>
							<button type="button" class="btn btn-default col-md-4" value="Buy">Buy</button>
							<input type="hidden" name="want_to" id="add_cpls_want_to_input" value="Sell">
							<script>
								$("#add_cpls_want_to > .btn").click(function(){
									$("#add_cpls_want_to > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_cpls_want_to_input").val($(this).val());
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Item</label>
						<div id="add_cpls_item" class="btn-group col-md-6" data-toggle="buttons">
							<button type="button" class="active btn btn-default col-md-3" value="Taxi">Taxi</button>
							<button type="button" class="btn btn-default col-md-3" value="Car">Car</button>
							<button type="button" class="btn btn-default col-md-3" value="Plate">Plate</button>
							<button type="button" class="btn btn-default col-md-3" value="Other">Other</button>
							<input type="hidden" name="item" id="add_cpls_item_input" value="Taxi">
							<script>
								$("#add_cpls_item > .btn").click(function(){
									$("#add_cpls_item > .btn").removeClass("active");
									$(this).addClass("active");
									
									/* Set input */
									$("#add_cpls_item_input").val($(this).val());
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="state">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/states.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="area">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/areas.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Taxi Network</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="network">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/networks.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Manufacturer</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="car">
								<?php
									$row = 1;
									if (($handle = fopen("application/files/cars.csv", "r")) !== FALSE) {
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
											$num = count($data);
											$row++;
											for ($c=0; $c < $num; $c++) {
												echo "<option>" . $data[$c] . "</option>\n";
											}
										}
										fclose($handle);
									}
								?>
                            </select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Model</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" name="model">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea id="comment" rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="GeneralAdCPLSSubmit">Add</button>
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
