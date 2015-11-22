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
                                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                        Add General Ad<i class="fa fa-plus"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" id="OptionDriverWantedModal">Drivers Wanted Post</a></li>
                                                        <li id="taxiAdLink"><a href="#" id="OptionTaxiAddModal">Taxi Add Post</a></li>
                                                        <li><a href="#" id="OptionWantToDriveModal">Want to Drive Post</a></li>
                                                        <li><a href="#" id="OptionCPLSModal">Car/Plate/Lease/Sale Post</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive"> 
								<table id="driverads_list" cellpadding="0" cellspacing="0" border="0" class="dynamic-table display table table-bordered">
									<thead>
									<tr>
										<th>Type</th>
										<th>Name</th>
										<th>Contact</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
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
                        <label class="control-label col-md-3">Name*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Looking for*</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default col-md-4"><input type="checkbox" name="looking_for_1" value="Driver"> Driver</label>
							<label class="btn btn-default col-md-4"><input type="checkbox" name="looking_for_2" value="Shift Share Partners"> Shift Share Partners</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type*</label>
						<div id="add_dwp_type" class="btn-group col-md-9" data-toggle="buttons">
							<label class="active btn btn-default col-md-4" name="Taxi">
								<input type="checkbox"> Taxi
							</label>
							<label class="btn btn-default col-md-4" name="Hire Car">
								<input type="checkbox"> Hire Car
							</label>
							<input type="hidden" name="type" id="add_dwp_type_input" value="Taxi">
							<script>
								$("#add_dwp_type > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_dwp_type_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State*</label>
						<div class="dropdown col-md-6">
							<select id="state" onchange="refreshArea('GeneralAdDriversWantedModal')" class="form-control" name="state">
							<?php
								$string = file_get_contents("application/files/states.json");
								$json = json_decode($string, true);

								foreach ($json as $states) {
									foreach($states as $state => $areas) {
										echo '<option>'.$state.'</option>';
									}
								}
							?>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area*</label>
						<div class="dropdown col-md-6">
							<select id="area"  onchange="refreshNetwork('GeneralAdDriversWantedModal')" class="form-control" name="area">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												echo '<option state="'.$state.'">'.$area.'</option>';
								
							?>	
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Available Network*</label>
						<div class="dropdown col-md-6">
							<select id="network" class="form-control" name="network">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												foreach($networks as $network) 
													echo '<option area="'.$area.'">'.$network.'</option>';
		
							?>	
							</select>
						</div>
						<label class="control-label col-md-1">
							Other:
						</label>
						<div class="col-md-2">
							<textarea rows="1" class="form-control" name="networkOther"></textarea>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Suburb/Postcode*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="postal_code">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift*</label>
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
                        <label class="control-label col-md-3">Days*</label>
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
                        <label class="control-label col-md-3">Available vehicles*</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_4" value="SUV"> SUV
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_5" value="Van"> Van
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_6" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_7"></textarea>
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
                	<h5 class="col-sm-10" style="color:#FF0000; font-weight:bold;" id="driversWantedError"></h5>
                    <button type="button" class="col-sm-2 btn btn-info" id="GeneralAdDriversWantedSubmit">Add</button>
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
                        <label class="control-label col-md-3">Name*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type*</label>
						<div id="add_tap_type" class="btn-group col-md-9" data-toggle="buttons">
							<label class="active btn btn-default col-md-4" name="Taxi">
								<input type="checkbox"> Taxi
							</label>
							<label class="btn btn-default col-md-4" name="Hire Car">
								<input type="checkbox"> Hire Car
							</label>
							<input type="hidden" name="type" id="add_tap_type_input" value="Taxi">
							<script>
								$("#add_tap_type > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_tap_type_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State*</label>
						<div class="dropdown col-md-6">
							<select id="state" onchange="refreshArea('GeneralAdTaxiAddModal')" class="form-control" name="state">
							<?php
								$string = file_get_contents("application/files/states.json");
								$json = json_decode($string, true);

								foreach ($json as $states) {
									foreach($states as $state => $areas) {
										echo '<option>'.$state.'</option>';
									}
								}
							?>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area*</label>
						<div class="dropdown col-md-6">
							<select id="area"  onchange="refreshNetwork('GeneralAdTaxiAddModal')" class="form-control" name="area">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												echo '<option state="'.$state.'">'.$area.'</option>';
								
							?>	
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network*</label>
						<div class="dropdown col-md-6">
							<select id="network" class="form-control" name="network">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												foreach($networks as $network) 
													echo '<option area="'.$area.'">'.$network.'</option>';
		
							?>	
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Suburb/Postcode*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="postal_code">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Taxi Plate</label>
                        <div class="col-md-6">
                            <input id="add_taxi_post_plate" type="text" class="form-control m-bot15" name="plate">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift Available*</label>
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
                        <label class="control-label col-md-3">Car Manufacturer*</label>
						<div class="dropdown col-md-6">
							<select onchange="refreshCars('GeneralAdTaxiAddModal')" class="form-control" name="car">
							<?php
								$string = file_get_contents("application/files/cars.json");
								$json = json_decode($string, true);


								foreach ($json as $cars) 
									foreach($cars as $car => $models) 
										echo '<option>'.$car.'</option>';
							?>
							</select>
						</div>
                    </div>
                    <div class="form-group">
						<label class="control-label col-md-3">Car Model*</label>
						<div class="col-md-6">
							<select class="form-control" name="model">
							<?php
								$string = file_get_contents("application/files/cars.json");
								$states = json_decode($string, true);

								foreach ($json as $cars)
									foreach($cars as $car => $models)
										foreach($models as $model)
											echo '<option car="'.$car.'">'.$model.'</option>';
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3">Year Manufactured*</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" name="year">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Fuel Type*</label>
						<div id="add_taxi_fuel_type" class="btn-group col-md-6" data-toggle="buttons">
							<label class="active btn btn-default col-md-3" name="LPG">
								<input type="checkbox"> LPG
							</label>
							<label class="btn btn-default col-md-3" name="Petrol">
								<input type="checkbox"> Petrol
							</label>
							<label class="btn btn-default col-md-3" name="Hybrid">
								<input type="checkbox"> Hybrid
							</label>
							<label class="btn btn-default col-md-3" name="Diesel">
								<input type="checkbox"> Diesel
							</label>
							<input type="hidden" name="fuel" id="add_taxi_fuel_input" value="LPG">
							<script>
								$("#add_taxi_fuel_type > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_taxi_fuel_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Kilometres travelled*</label>
						<div class="dropdown col-md-6">
							<select class="form-control" name="kilometers">
                                <option value="0-25k">0-25k</option>
                                <option value="25k-50k">25k-50k</option>
                                <option value="50k-100k">50k-100k</option>
                                <option value="100k-150k">100k-150k</option>
                                <option value="150k –200k">150k –200k</option>
                                <option value="200K-250K">200K-250K</option>
                                <option value="250k+">250k+</option>
                            </select>
						</div>
                    </div>			
					<div class="form-group">
                        <label class="control-label col-md-3">Vehicle type*</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_4" value="SUV"> SUV
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_5" value="Van"> Van
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_6" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_7"></textarea>
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
                        <label class="control-label col-md-3">Lease Rate/Term*</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" id="driver_shift_start" name="lease">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Upload car pic</label>
						<div class="btn-group col-md-6">
							<label class="btn btn-info" for="my-file-selector">
								<input id="my-file-selector" type="file" style="display:none;">
								Choose File
							</label>
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
               		 <h5 class="col-sm-10" style="color:#FF0000; font-weight:bold;" id="taxiAdError"></h5>
                    <button type="button" class="col-sm-2 btn btn-info" id="GeneralAdTaxiAddSubmit">Add</button>
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
                        <label class="control-label col-md-3">Name*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type*</label>
						<div id="add_wtdp_type" class="btn-group col-md-9" data-toggle="buttons">
							<label class="active btn btn-default col-md-4" name="Taxi">
								<input type="checkbox"> Taxi
							</label>
							<label class="btn btn-default col-md-4" name="Hire Car">
								<input type="checkbox"> Hire Car
							</label>
							<input type="hidden" name="type" id="add_wtdp_type_input" value="Taxi">
							<script>
								$("#add_wtdp_type > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_wtdp_type_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State*</label>
						<div class="dropdown col-md-6">
							<select id="state" onchange="refreshArea('GeneralAdWantToDriveModal')" class="form-control" name="state">
							<?php
								$string = file_get_contents("application/files/states.json");
								$json = json_decode($string, true);

								foreach ($json as $states) {
									foreach($states as $state => $areas) {
										echo '<option>'.$state.'</option>';
									}
								}
							?>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area*</label>
						<div class="dropdown col-md-6">
							<select id="area"  onchange="refreshNetwork('GeneralAdWantToDriveModal')" class="form-control" name="area">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												echo '<option state="'.$state.'">'.$area.'</option>';
								
							?>	
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network*</label>
						<div class="dropdown col-md-6">
							<select id="network" class="form-control" name="network">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												foreach($networks as $network) 
													echo '<option area="'.$area.'">'.$network.'</option>';
		
							?>	
							</select>
						</div>
						<label class="control-label col-md-1">
							Other:
						</label>
						<div class="col-md-2">
							<textarea rows="1" class="form-control" name="networkOther"></textarea>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Suburb/Postcode*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="postal_code">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Prefered Shift*</label>
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
                        <label class="control-label col-md-3">Days*</label>
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
                        <label class="control-label col-md-3">Prefered Vehicles*</label>
						<div class="btn-group col-md-9" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_1" value="Sedan"> Sedan
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_2" value="Wagon"> Wagon
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_3" value="Maxi"> Maxi
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_4" value="SUV"> SUV
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_5" value="Van"> Van
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="vehicles_6" value="Luxury/Executive"> Luxury/Executive
							</label>
							<label class="control-label col-md-1">
								Other:
							</label>
							<div class="col-md-3">
								<textarea rows="1" class="form-control" name="vehicles_7"></textarea>
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
						<label class="control-label col-md-1">
							Other:
						</label>
						<div class="col-md-2">
							<textarea rows="1" class="form-control" name="option_3"></textarea>
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
                	<h5 class="col-sm-10" style="color:#FF0000; font-weight:bold;" id="wantToDriveError"></h5>
                    <button type="button" class="col-sm-2 btn btn-info" id="GeneralAdWantToDriveSubmit">Add</button>
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
                        <label class="control-label col-md-3">Name*</label>
                        <div class="col-md-6">
                            <input id="sdsd" type="text" class="form-control m-bot15" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="contact">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Want To*</label>
						<div id="add_cpls_want_to" class="btn-group col-md-9" data-toggle="buttons">
							<label class="active btn btn-default col-md-3" name="Sell">
								<input type="checkbox"> Sell
							</label>
							<label class="btn btn-default col-md-3" name="Lease">
								<input type="checkbox"> Lease
							</label>
							<label class="btn btn-default col-md-3" name="Buy">
								<input type="checkbox"> Buy
							</label>
							<input type="hidden" name="want_to" id="add_cpls_want_to_input" value="Sell">
							<script>
								$("#add_cpls_want_to > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_cpls_want_to_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Item*</label>
						<div id="add_cpls_item" class="btn-group col-md-9" data-toggle="buttons">
							<label class="active btn btn-default col-md-3" name="Taxi">
								<input type="checkbox"> Taxi
							</label>
							<label class="btn btn-default col-md-3" name="Car">
								<input type="checkbox"> Car
							</label>
							<label class="btn btn-default col-md-3" name="Plate">
								<input type="checkbox"> Plate
							</label>
							<label class="btn btn-default col-md-3" name="Other">
								<input type="checkbox"> Other
							</label>
							<input type="hidden" name="item" id="add_cpls_item_input" value="Taxi">
							<script>
								$("#add_cpls_item > .btn").click(function(){
									if(!$(this).hasClass("active"))
										$(this).siblings().removeClass("active");
									else
										$(this).removeClass("active");
									
									/* Set input */
									$("#add_cpls_item_input").val($(this).attr('name'));
								});
							</script>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State*</label>
						<div class="dropdown col-md-6">
							<select onchange="refreshArea('GeneralAdCPLSModal')" class="form-control" name="state">
							<?php
								$string = file_get_contents("application/files/states.json");
								$json = json_decode($string, true);

								foreach ($json as $states) {
									foreach($states as $state => $areas) {
										echo '<option>'.$state.'</option>';
									}
								}
							?>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area*</label>
						<div class="dropdown col-md-6">
							<select onchange="refreshNetwork('GeneralAdCPLSModal')" class="form-control" name="area">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												echo '<option state="'.$state.'">'.$area.'</option>';
								
							?>	
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Taxi Network</label>
						<div class="dropdown col-md-6">
							<select id="network" class="form-control" name="network">
							<?php
								$string = file_get_contents("application/files/states.json");
								$states = json_decode($string, true);

								foreach ($json as $states) 
									foreach($states as $state => $areasArray) 
										foreach($areasArray as $areas) 
											foreach($areas as $area => $networks) 
												foreach($networks as $network) 
													echo '<option area="'.$area.'">'.$network.'</option>';
		
							?>	
							</select>
						</div>
						<label class="control-label col-md-1">
							Other:
						</label>
						<div class="col-md-2">
							<textarea rows="1" class="form-control" name="networkOther"></textarea>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Suburb/Postcode*</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" name="postal_code">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Manufacturer</label>
						<div class="dropdown col-md-6">
							<select onchange="refreshCars('GeneralAdCPLSModal')" class="form-control" name="car">
							<?php
								$string = file_get_contents("application/files/cars.json");
								$json = json_decode($string, true);


								foreach ($json as $cars) 
									foreach($cars as $car => $models) 
										echo '<option>'.$car.'</option>';
							?>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Model</label>
						<div class="col-md-6">
							<select class="form-control" name="model">
							<?php
								$string = file_get_contents("application/files/cars.json");
								$states = json_decode($string, true);

								foreach ($json as $cars) 
									foreach($cars as $car => $models) 
										foreach($models as $model) 
											echo '<option car="'.$car.'">'.$model.'</option>';
							?>	
							</select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="control-label col-md-3">Upload car pic</label>
						<div class="btn-group col-md-6">
							<label class="btn btn-info" for="my-file-selector">
								<input id="my-file-selector" type="file" style="display:none;">
								Choose File
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Price/Rate*</label>
						<div class="col-md-6">
							<input type="text" class="form-control m-bot15" name="priceRate">
						</div>
					</div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea rows="6" class="form-control" name="comment"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="display: block;">
                	<h5 class="col-sm-10" style="color:#FF0000; font-weight:bold;" id="cplsError"></h5>
                    <button type="button" class="col-sm-2 btn btn-info" id="GeneralAdCPLSSubmit">Add</button>
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
