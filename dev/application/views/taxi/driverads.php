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
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input id="add_DWP_name" type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input id="add_DWP_number" type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Looking for</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Driver
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Shift Share Partners
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Taxi
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Hire Car
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose State
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose Arae
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose Network
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="garden" checked=""> Day
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="garden" checked=""> Night
							</label>
							<label class="btn btn-default col-md-4">
								<input type="checkbox" name="garden" checked=""> Night Plate
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Days</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Monday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Tuesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Wednesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Thursday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Friday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Saturday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Sunday
							</label>
						</div>
                    </div>					
					<div class="form-group">
                        <label class="control-label col-md-3">Available vehicles</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Sedan
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Wagon
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Maxi
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Luxury/Executive
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Other:Please specify
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
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-6">
                            <input id="add_DWP_name" type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-6">
                            <input id="add_DWP_number" type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Type</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Taxi
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Hire Car
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">State</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose State
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Area</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose Arae
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Network</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose Network
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Taxi Plate</label>
                        <div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" id="driver_shift_end" name="shift_end">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Shift Available</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Monday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Tuesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Wednesday 
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Thursday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Friday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Saturday
							</label>
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Sunday
							</label>
						</div>
                    </div>	
					
					<div class="form-group">
                        <div class="btn-group col-md-3" data-toggle="buttons">
							<label class="btn btn-info btn-xs">
								<input type="checkbox" name="garden" checked=""> Day Shift
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Night Shift
							</label>
						</div>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Monday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Tuesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Wednesday 
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Thursday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Friday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Saturday
							</label>
							<label class="btn btn-default btn-xs">
								<input type="checkbox" name="garden" checked=""> Sunday
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Car Manufacturer</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose Manufacturer
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Year Manufactured</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Fuel Type</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> LPG
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Petrol
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Kilometres travelled</label>
						<div class="dropdown col-md-6">
							<button class="form-control m-bot15 dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Choose km
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li ><a  href="#">HTML</a></li>
							</ul>
						</div>
                    </div>			
					<div class="form-group">
                        <label class="control-label col-md-3">Vehicle type</label>
						<div class="btn-group col-md-8" data-toggle="buttons">
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Sedan
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Wagon
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Maxi
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Luxury/Executive
							</label>
							<label class="btn btn-default btn-sm">
								<input type="checkbox" name="garden" checked=""> Other:Please specify
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Options included</label>
						<div class="btn-group col-md-6" data-toggle="buttons">
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Baby capsule
							</label>
							<label class="btn btn-default col-md-6">
								<input type="checkbox" name="garden" checked=""> Wheelchair accessible  
							</label>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3">Lease Rate/Term</label>
						<div class="col-md-6">
                            <input id="" type="text" class="form-control m-bot15" id="driver_shift_start" name="shift_start">
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
            <form class="form-horizontal"">
                <div class="modal-body">
                    <div class="form-group">
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td><label class="control-label">Name</label></td>
                                    <td><textarea id="nameArea" rows="1" class="form-control" name="name"></textarea></td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">ContactNumber</label></td>
                                    <td><textarea id="numberArea" rows="1" class="form-control" name="cntNumber"></textarea></td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Looking for</label></td>
                                    <td><div class="col-md-5 checkbox-button">
                                           <label class="centered">
                                              <input type="radio" name="vehicleradio" style="display: none;" id="taxiChb"><span>Taxi</span>
                                           </label>
                                        </div>
                                        <div class="col-md-5 checkbox-button">
                                           <label>
                                              <input type="radio" name="vehicleradio" style="display: none;" id="hireChb"><span>Hire Car</span>
                                           </label>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">State</label></td>
                                    <td>
                                        <select class="form-control" id="stateSel">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Area</label></td>
                                    <td>
                                        <select class="form-control" id="areaSel">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Network</label></td>
                                    <td>
                                        <select class="form-control" id="networkSel">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Preferred shift</label></td>
                                    <td><div class="col-md-3 checkbox-button">
                                           <label class="centered">
                                              <input type="checkbox" style="display: none;" id="dayChb"><span>Day</span>
                                           </label>
                                        </div>
                                        <div class="col-md-3 checkbox-button">
                                           <label>
                                              <input type="checkbox" style="display: none;" id="nightChb"><span>Night</span>
                                           </label>
                                        </div>
                                        <div class="col-md-4 checkbox-button">
                                           <label>
                                              <input type="checkbox" style="display: none;" id="nightPlateChb"><span>Night Plate</span>
                                           </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Days</label></td>
                                    <td><div class="checkbox-button">
                                           <label class="centered">
                                              <input type="checkbox" style="display: none;" id="mondayChb"><span>Monday</span>
                                           </label>
                                        </div>
                                        <div class="checkbox-button">
                                           <label>
                                              <input type="checkbox" style="display: none;" id="tuesdayChb"><span>Tuesday</span>
                                           </label>
                                        </div>
                                        <div class="checkbox-button col-sm-2">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="wednesdayChb"><span>Wednesday</span>
                                             </label>
                                        </div>
                                        <div class="checkbox-button col-sm-2">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="thursdayChb"><span>Thursday</span>
                                             </label>
                                        </div>
                                        <div class="checkbox-button">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="fridayChb"><span>Friday</span>
                                             </label>
                                        </div>
                                        <div class="checkbox-button col-sm-2">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="saturdayChb"><span>Saturday</span>
                                             </label>
                                        </div>
                                        <div class="checkbox-button">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="sundayChb"><span>Sunday</span>
                                             </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label" style="text-align: left;">Preferred vehicles</label></td>
                                    <td><div class="checkbox-button col-sm-2">
                                           <label class="centered">
                                              <input type="checkbox" style="display: none;" id="sedanChb"><span>Sedan</span>
                                           </label>
                                        </div>
                                        <div class="checkbox-button col-sm-2">
                                           <label>
                                              <input type="checkbox" style="display: none;" id="wagonChb"><span>Wagon</span>
                                           </label>
                                        </div>
                                        <div class="checkbox-button col-sm-2">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="maxiChb"><span>Maxi</span>
                                             </label>
                                        </div>
                                        <div class="checkbox-button col-sm-3">
                                             <label>
                                                <input type="checkbox" style="display: none;" id="luxuryChb"><span>Luxury/Executive</span>
                                             </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <textarea id="vehicleArea" rows="1" class="form-control" name="name"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Description</label></td>
                                    <td><textarea id="commentArea" rows="6" class="form-control" name="comment"></textarea></td>
                                </tr>
                            <tbody>
                        </table>
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
                    <div class="modal-body">
                        <div class="form-group">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td><label class="control-label">Name</label></td>
                                        <td><textarea id="nameArea" rows="1" class="form-control" name="name"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">ContactNumber</label></td>
                                        <td><textarea id="numberArea" rows="1" class="form-control" name="cntNumber"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Want to</label></td>
                                        <td><div class="col-md-3 checkbox-button">
                                               <label class="centered">
                                                  <input type="radio" name="wanttoradio" style="display: none;" id="sellChb"><span>Sell</span>
                                               </label>
                                            </div>
                                            <div class="col-md-3 checkbox-button">
                                               <label>
                                                  <input type="radio" name="wanttoradio" style="display: none;" id="leaseChb"><span>Lease</span>
                                               </label>
                                            </div>
                                            <div class="col-md-3 checkbox-button">
                                               <label>
                                                  <input type="radio" name="wanttoradio" style="display: none;" id="buyChb"><span>Buy</span>
                                               </label>
                                            </div></td>
                                    </tr>
                                        <tr>
                                            <td><label class="control-label">Item</label></td>
                                            <td><div class="checkbox-button">
                                                   <label class="centered">
                                                      <input type="radio" name="itemradio" style="display: none;" id="taxiChb"><span>Taxi</span>
                                                   </label>
                                                </div>
                                                <div class="checkbox-button">
                                                   <label>
                                                      <input type="radio" name="itemradio" style="display: none;" id="carChb"><span>Car</span>
                                                   </label>
                                                </div>
                                                <div class="checkbox-button">
                                                   <label>
                                                      <input type="radio" name="itemradio" style="display: none;" id="plateChb"><span>Plate</span>
                                                   </label>
                                                </div>
                                                <div class="checkbox-button">
                                                   <label>
                                                      <input type="radio" name="itemradio" style="display: none;" id="otherChb"><span>Other</span>
                                                   </label>
                                                </div></td>
                                        </tr>
                                    <tr>
                                        <td><label class="control-label">State</label></td>
                                        <td>
                                            <select class="form-control" id="stateSel">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Area</label></td>
                                        <td>
                                            <select class="form-control" id="areaSel">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Taxi Network</label></td>
                                        <td>
                                            <select class="form-control" id="networkSel">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Car manufacturer</label></td>
                                        <td>
                                            <select class="form-control" id="manufacturerSel">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Car Model</label></td>
                                        <td><textarea id="modelArea" rows="1" class="form-control" name="name"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label">Description</label></td>
                                        <td><textarea id="commentArea" rows="6" class="form-control" name="comment"></textarea></td>
                                    </tr>
                                <tbody>
                            </table>
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
