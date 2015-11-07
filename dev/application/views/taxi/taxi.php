<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Taxi List
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <div class="space15 m-bot20"></div>
                            <div class="query_box row-fluid">
                                <div class="container-fluid">
                                    <div class="row m-bot20">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" data-toggle="modal" onclick="addNewTaxi()">
                                                        Add taxi <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div id="taxi_list_container" class="table-responsive">
								<table id="taxi_list" cellpadding="0" cellspacing="0" border="0" 
                                   class="dynamic-table display table table-bordered tb_roster_paying">
									<thead>
									<tr>
										<th></th>
										<th>Taxi #</th>
										<th>Taxi Network</th>
										<th>Car type</th>
										<th>Car Style</th>
										<th>Fuel type</th>
										<th>Kilometres (Circle one)</th>
										<th>Insurance Due Date</th>
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

<!-- Modal View Start -->
<div class="modal fade" id="taxiDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Update Taxi Information</h4>
            </div>
            <form action="" class="form-horizontal" id="taxiDetailForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Number</label>
                        <div class="col-md-6">
                            <input class="form-control m-bot15" type="text" id="license_plate_no" name="license_plate_no" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">State</label>
                        <div class="dropdown col-md-6">
                            <select id="state" onchange="refreshArea('taxiDetailModal')" class="form-control" name="state">
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
                        <label class="control-label col-md-3">Area</label>
                        <div class="dropdown col-md-6">
                            <select id="area"  onchange="refreshNetwork('taxiDetailModal')" class="form-control" name="area">
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
                        <label class="control-label col-md-3">Suburb/Postcode</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="suburb" name="suburb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Taxi Network</label>
                        <div class="col-md-6">
                            <input id="taxi_network" name="taxi_network" type="text" maxlength="50" class="form-control m-bot15">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Car type</label>
                        <div class="col-md-6">
                            <input class="form-control m-bot15 car_type" id="car_type" name="car_type" required type="text" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Car Style</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15 car_style" id="car_style" name="car_style" required maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Car Manufacturer</label>
                        <div class="col-md-6">
                            <input type="text" maxlength="50" class="form-control m-bot15 car_manufacturer" id="car_manufacturer" name="car_manufacturer" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Year Manufactured</label>
                        <div class="col-md-6">
                            <input type="number" min="0" maxlength="4" class="form-control m-bot15" id="year_manufactured" name="year_manufactured">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fuel Type</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15 fuel_type" id="fuel_type" name="fuel_type" required maxlength="20">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kilometres (Circle one)</label>
                        <div class="col-md-6">
                            <select class="form-control m-bot15" id="kilometres" name="kilometres">
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
                        <label class="control-label col-md-3">Options included</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="options" name="options">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Plate Fee (AU$)</label>
                        <div class="col-md-6">
                            <input type="number" min="0" maxlength="50" class="form-control m-bot15" id="plate_fee" name="plate_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Network Fee (AU$)</label>
                        <div class="col-md-6">
                            <input type="number" min="0" maxlength="50" class="form-control m-bot15" id="network_fee" name="network_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Insurance Fee (AU$)</label>
                        <div class="col-md-6">
                            <input type="number" min="0" maxlength="50" class="form-control m-bot15" id="insurance_fee" name="insurance_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Car Finance (AU$)</label>
                        <div class="col-md-6">
                            <input type="number" min="0" maxlength="50" class="form-control m-bot15" id="car_finance_fee" name="car_finance_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Registration Due Date</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="registration_due_date" name="registration_due_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Insurance Due Date</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-bot15" id="insurance_due_date" name="insurance_due_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Comment</label>
                        <div class="col-md-6">
                            <textarea rows="6" class="form-control" id="comment" name="comment"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="display: block;">
                    <button type="button" class="btn btn-info" id="taxi_submit_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal View End -->
</body>
<script>
    document.title = '<?php echo config_item("site_title");?>: Taxi List';
    $("#nav-accordion li a").removeClass("active");
    $("#taxi_menu a").addClass("active");
    $("#operator_menu").addClass("active");
</script>
</html>
