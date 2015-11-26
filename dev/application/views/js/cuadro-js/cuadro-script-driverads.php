<script>
var selectedDriverAdsID = 0;
var serverUrl ="http://localhost:8083/dev/scripts/";
var driverAdsObject = {
    allObjects: [],

	populateGeneralAdsList: function(){
		var type = this.allObjects['type'];
		if(type === 'driver'){
			$("#taxiAdLink").remove();
		}
        var allDriverAdsObjects = this.allObjects['array'];
        var totalDriverAds = allDriverAdsObjects.length;
        var driverAdsListString = '';

        for (var i = 0; i < totalDriverAds; i++) {
            var tr_class = "gradeA";//i % 2 == 0 ? "gradeA" : "gradeB";
            driverAdsListString += '<tr class="'+tr_class+'">';
			
			if( allDriverAdsObjects[i].add_type == 4 )
				driverAdsListString += '<td>Car/Plate/Lease/Sale</td>';
			else if( allDriverAdsObjects[i].add_type == 3 )
				driverAdsListString += '<td>Want To Drive</td>';
			else if( allDriverAdsObjects[i].add_type == 2 )
				driverAdsListString += '<td>Taxi Ad</td>';
			else if( allDriverAdsObjects[i].add_type == 1)
				driverAdsListString += '<td>Driver Wanted</td>';
			
            driverAdsListString += '<td>'+allDriverAdsObjects[i].name+'</td>';
            driverAdsListString += '<td>'+allDriverAdsObjects[i].contact+'</td>';
			driverAdsListString += '<td>'+$.datepicker.formatDate("D, d M yy", new Date((allDriverAdsObjects[i].date)))+'</td>';
				
			var deleteAction = allDriverAdsObjects[i].add_type;	
			
            driverAdsListString += '<td class="action_button">' +
                '<a data-toggle="modal" class="edit" title="" onclick="viewDriverAdsDetail('+allDriverAdsObjects[i].ID+','+deleteAction+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" title="" onclick="deleteDriverAdsDetail('+allDriverAdsObjects[i].ID+','+deleteAction+')" ><i class="ico-close"></i></a>' +
                '</td>';
            driverAdsListString += '</tr>';
        }

		//$('#driverads_list').dataTable().fnDestroy();
		
        $("#driverads_list tbody").html(driverAdsListString);

        $('#driverads_list').dataTable( {
            "aaSorting": [[ 1, "desc" ]]
        });
    },
    getDriverAdsDetailFromID: function (ID, type) {
        var driverAdsDetailArray = [];
        var allDriverAdsObjects = this.allObjects;
        var totalDriverAds = allDriverAdsObjects.array.length;
        for (var i = 0; i < totalDriverAds; i++) {
            if (ID == allDriverAdsObjects.array[i].ID && type == allDriverAdsObjects.array[i].add_type) {
                driverAdsDetailArray = allDriverAdsObjects.array[i];
                break;
            }
        }
        return driverAdsDetailArray;
    },
	setGeneralAdDriverWantedModal: function (driverAdsDetail){
        selectedDriverAdsID = driverAdsDetail.ID;
        $("#GeneralAdDriversWantedModal input[name=name]").val(driverAdsDetail.name);
		$("#GeneralAdDriversWantedModal input[name=contact]").val(driverAdsDetail.contact);
		
		if(driverAdsDetail.type == "Taxi") {
			$("#GeneralAdDriversWantedModal label[name=Taxi]").addClass("active");
			$("#add_dwp_type_input").val("Taxi");
		} else { 
			$("#GeneralAdDriversWantedModal label[name=Taxi]").removeClass("active");
		}	
		if(driverAdsDetail.type == "Hire Car") {
			$("#GeneralAdDriversWantedModal label[name='Hire Car']").addClass("active");
			$("#add_dwp_type_input").val("Hire Car");
		} else { 
			$("#GeneralAdDriversWantedModal label[name='Hire Car']").removeClass("active");
		}

		var lookingFor = driverAdsDetail.looking_for;
		if(lookingFor.indexOf("Driver") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=looking_for_1]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=looking_for_1]").prop('checked', true);
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=looking_for_1]").parents().removeClass("active");
		}
		if(lookingFor.indexOf("Shift Share Partners") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=looking_for_2]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=looking_for_2]").prop('checked', true);
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=looking_for_2]").parents().removeClass("active");
		}
		
		var shift = driverAdsDetail.shift;
		if(shift.indexOf("Day") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=shift_1]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=shift_1]").prop('checked', true);
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_1]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Plate") > -1) {
			shift = shift.replace("Night Plate", "");
			$("#GeneralAdDriversWantedModal label input[name=shift_3]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=shift_3]").prop('checked', true);
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_3]").parents().removeClass("active");
		}
		if(shift.indexOf("Night") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=shift_2]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=shift_2]").prop('checked', true);
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_2]").parents().removeClass("active");
		}

		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_1]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_1]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_2]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_2]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) { 
			$("#GeneralAdDriversWantedModal label input[name=days_3]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_3]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_4]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_4]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_5]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_5]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_6]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_6]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=days_7]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=days_7]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=days_7]").parents().removeClass("active");
			
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_1]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_1]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_2]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_2]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_3]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_3]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_3]").parents().removeClass("active");			
		if(vehicles.indexOf("SUV") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_4]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_4]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_4]").parents().removeClass("active");	
		if(vehicles.indexOf("Van") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_5]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_5]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_5]").parents().removeClass("active");	
		if(vehicles.indexOf("Luxury/Executive") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=vehicles_6]").parents().addClass("active");
			$("#GeneralAdDriversWantedModal label input[name=vehicles_6]").prop('checked', true);
		} else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_6]").parents().removeClass("active");	
			
		$("#GeneralAdDriversWantedModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		refreshArea('GeneralAdDriversWantedModal');
		
		$("#GeneralAdDriversWantedModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		refreshNetwork('GeneralAdDriversWantedModal');
		
		var dataarray=driverAdsDetail.network.split(",");
		$('#GeneralAdDriversWantedModal select[name=network] option').each(function () {
			$(this).removeAttr('selected');
				
			if($(this).attr('area') == driverAdsDetail.area) 
				if(dataarray.indexOf($(this).text()) != -1)
					$(this).attr('selected', 'selected');
		});
		
		$("#GeneralAdDriversWantedModal input[name=postal_code]").val(driverAdsDetail.postal_code);
		$("#GeneralAdDriversWantedModal input[name=comment]").val(driverAdsDetail.comment);
    },
	setGeneralAdTaxiAddModal: function (driverAdsDetail){
        selectedDriverAdsID = driverAdsDetail.ID;
        $("#GeneralAdTaxiAddModal input[name=name]").val(driverAdsDetail.name);
		$("#GeneralAdTaxiAddModal input[name=contact]").val(driverAdsDetail.contact);
		
		if(driverAdsDetail.type == "Taxi") {
			$("#GeneralAdTaxiAddModal label[name=Taxi]").addClass("active");
			$("#add_tap_type_input").val("Taxi");
		} else { 
			$("#GeneralAdTaxiAddModal label[name=Taxi]").removeClass("active");
		}	
		if(driverAdsDetail.type == "Hire Car") {
			$("#GeneralAdTaxiAddModal label[name='Hire Car']").addClass("active");
			$("#add_tap_type_input").val("Hire Car");
		} else { 
			$("#GeneralAdTaxiAddModal label[name='Hire Car']").removeClass("active");
		}
		
		if(driverAdsDetail.fuel == "LPG") {
			$("#GeneralAdTaxiAddModal label[name=LPG]").addClass("active");
			$("#add_taxi_fuel_type").val("LPG");
		} else { 
			$("#GeneralAdTaxiAddModal label[name=LPG]").removeClass("active");
		}	
		if(driverAdsDetail.fuel == "Petrol") {
			$("#GeneralAdTaxiAddModal label[name='Petrol']").addClass("active");
			$("#add_taxi_fuel_type").val("Petrol");
		} else { 
			$("#GeneralAdTaxiAddModal label[name='Petrol']").removeClass("active");
		}
		if(driverAdsDetail.fuel == "Hybrid") {
			$("#GeneralAdTaxiAddModal label[name='Hybrid']").addClass("active");
			$("#add_taxi_fuel_type").val("Hybrid");
		} else { 
			$("#GeneralAdTaxiAddModal label[name='Hybrid']").removeClass("active");
		}
		if(driverAdsDetail.fuel == "Diesel") {
			$("#GeneralAdTaxiAddModal label[name='Diesel']").addClass("active");
			$("#add_taxi_fuel_type").val("Diesel");
		} else { 
			$("#GeneralAdTaxiAddModal label[name='Diesel']").removeClass("active");
		}
		
		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_1]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_1]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_2]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_2]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) { 
			$("#GeneralAdTaxiAddModal label input[name=days_3]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_3]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_4]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_4]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_5]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_5]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_6]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_6]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=days_7]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=days_7]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=days_7]").parents().removeClass("active");
		
		var ndays = driverAdsDetail.ndays;
		if(ndays.indexOf("Monday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_1]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_1]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_1]").parents().removeClass("active");
			
		if(ndays.indexOf("Tuesday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_2]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_2]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_2]").parents().removeClass("active");
		
		if(ndays.indexOf("Wednesday") > -1) { 
			$("#GeneralAdTaxiAddModal label input[name=ndays_3]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_3]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_3]").parents().removeClass("active");
		
		if(ndays.indexOf("Thursday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_4]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_4]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_4]").parents().removeClass("active");
			
		if(ndays.indexOf("Friday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_5]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_5]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_5]").parents().removeClass("active");
			
		if(ndays.indexOf("Saturday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_6]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_6]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_6]").parents().removeClass("active");
			
		if(ndays.indexOf("Sunday") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=ndays_7]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=ndays_7]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_7]").parents().removeClass("active");
		
		var shift = driverAdsDetail.shift;
		if(shift.indexOf("Day Shift") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=dshift]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=nshift]").prop('checked', true);
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=dshift]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Shift") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=nshift]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=nshift]").prop('checked', true);
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=nshift]").parents().removeClass("active");
		}
		
		$("#GeneralAdTaxiAddModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=network] option").filter(function() { return $(this).text() == driverAdsDetail.network; }).prop('selected', true);
		
		$("#GeneralAdTaxiAddModal select[name=car] option").filter(function() { return $(this).text() == driverAdsDetail.car; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=kilometers] option").filter(function() { return $(this).text() == driverAdsDetail.kilometers; }).prop('selected', true);
		
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_1]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_1]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_2]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_2]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_3]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_3]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_3]").parents().removeClass("active");
		if(vehicles.indexOf("SUV") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_4]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_4]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_4]").parents().removeClass("active");
		if(vehicles.indexOf("Van") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_5]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_5]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_5]").parents().removeClass("active");		
		if(vehicles.indexOf("Luxury/Executive") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=vehicles_6]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=vehicles_6]").prop('checked', true);
		} else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_6]").parents().removeClass("active");	
		
		var options = driverAdsDetail.options;
		if(options.indexOf("Baby capsule") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=option_1]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=option_1]").prop('checked', true);
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=option_1]").parents().removeClass("active");
		}
		if(options.indexOf("Wheelchair accessible") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=option_2]").parents().addClass("active");
			$("#GeneralAdTaxiAddModal label input[name=option_2]").prop('checked', true);
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=option_2]").parents().removeClass("active");
		}
		
		$("#GeneralAdTaxiAddModal input[name=lease]").val(driverAdsDetail.lease);
		$("#GeneralAdTaxiAddModal input[name=year]").val(driverAdsDetail.year);
		$("#GeneralAdTaxiAddModal input[name=plate]").val(driverAdsDetail.plate);
		$("#GeneralAdTaxiAddModal input[name=postal_code]").val(driverAdsDetail.postal_code);
		$("#GeneralAdTaxiAddModal input[name=comment]").val(driverAdsDetail.comment);
    },
	setGeneralAdWantToDriveModal: function (driverAdsDetail){
        selectedDriverAdsID = driverAdsDetail.ID;
        $("#GeneralAdWantToDriveModal input[name=name]").val(driverAdsDetail.name);
		$("#GeneralAdWantToDriveModal input[name=contact]").val(driverAdsDetail.contact);
		
		if(driverAdsDetail.type == "Taxi") {
			$("#GeneralAdWantToDriveModal label[name=Taxi]").addClass("active");
			$("#add_wtdp_type_input").val("Taxi");
		} else { 
			$("#GeneralAdWantToDriveModal label[name=Taxi]").removeClass("active");
		}	
		if(driverAdsDetail.type == "Hire Car") {
			$("#GeneralAdWantToDriveModal label[name='Hire Car']").addClass("active");
			$("#add_wtdp_type_input").val("Hire Car");
		} else { 
			$("#GeneralAdWantToDriveModal label[name='Hire Car']").removeClass("active");
		}
		
		var shift = driverAdsDetail.shift;
		if(shift.indexOf("Day") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=shift_1]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=shift_1]").prop('checked', true);
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_1]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Plate") > -1) {
			shift = shift.replace("Night Plate", "");
			$("#GeneralAdWantToDriveModal label input[name=shift_3]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=shift_3]").prop('checked', true);
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_3]").parents().removeClass("active");
		}
		if(shift.indexOf("Night") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=shift_2]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=shift_2]").prop('checked', true);
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_2]").parents().removeClass("active");
		}

		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_1]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_1]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_2]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_2]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) { 
			$("#GeneralAdWantToDriveModal label input[name=days_3]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_3]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_4]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_4]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_5]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_5]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_6]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_6]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=days_7]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=days_7]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=days_7]").parents().removeClass("active");
			
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_1]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_1]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_2]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_2]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_3]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_3]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_3]").parents().removeClass("active");	
		if(vehicles.indexOf("SUV") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_4]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_4]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_4]").parents().removeClass("active");	
		if(vehicles.indexOf("Van") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_5]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_5]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_5]").parents().removeClass("active");			
		if(vehicles.indexOf("Luxury/Executive") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=vehicles_6]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=vehicles_6]").prop('checked', true);
		} else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_6]").parents().removeClass("active");
		
		var options = driverAdsDetail.options;
		if(options.indexOf("Baby capsule") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=option_1]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=option_1]").prop('checked', true);
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=option_1]").parents().removeClass("active");
		}
		if(options.indexOf("Wheelchair accessible") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=option_2]").parents().addClass("active");
			$("#GeneralAdWantToDriveModal label input[name=option_2]").prop('checked', true);
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=option_2]").parents().removeClass("active");
		}
		
		$("#GeneralAdWantToDriveModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		$("#GeneralAdWantToDriveModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		$("#GeneralAdWantToDriveModal select[name=network] option").filter(function() { return $(this).text() == driverAdsDetail.network; }).prop('selected', true);
		$("#GeneralAdWantToDriveModal input[name=postal_code]").val(driverAdsDetail.postal_code);
		$("#GeneralAdWantToDriveModal input[name=comment]").val(driverAdsDetail.comment);
    },
	setGeneralAdCPLSModal: function (driverAdsDetail){
        selectedDriverAdsID = driverAdsDetail.ID;
        $("#GeneralAdCPLSModal input[name=name]").val(driverAdsDetail.name);
		$("#GeneralAdCPLSModal input[name=contact]").val(driverAdsDetail.contact);

		if(driverAdsDetail.want_to == "Sell") {
			$("#GeneralAdCPLSModal label[name=Sell]").addClass("active");
			$("#add_cpls_want_to_input").val("Sell");
		} else { 
			$("#GeneralAdCPLSModal label[name=Sell]").removeClass("active");
		}	
		if(driverAdsDetail.want_to == "Lease") {
			$("#GeneralAdCPLSModal label[name=Lease]").addClass("active");
			$("#add_cpls_want_to_input").val("Lease");
		} else { 
			$("#GeneralAdCPLSModal label[name=Lease]").removeClass("active");
		}
		if(driverAdsDetail.want_to == "Buy") {
			$("#GeneralAdCPLSModal label[name=Buy]").addClass("active");
			$("#add_cpls_want_to_input").val("Buy");
		} else { 
			$("#GeneralAdCPLSModal label[name=Buy]").removeClass("active");
		}
		
		if(driverAdsDetail.item == "Taxi") {
			$("#GeneralAdCPLSModal label[name=Taxi]").addClass("active");
			$("#add_cpls_item_input").val("Taxi");
		} else { 
			$("#GeneralAdCPLSModal label[name=Taxi]").removeClass("active");
		}
		if(driverAdsDetail.item == "Car") {
			$("#GeneralAdCPLSModal label[name=Car]").addClass("active");
			$("#add_cpls_item_input").val("Car");
		} else { 
			$("#GeneralAdCPLSModal label[name=Car]").removeClass("active");
		}
		if(driverAdsDetail.item == "Plate") {
			$("#GeneralAdCPLSModal label[name=Plate]").addClass("active");
			$("#add_cpls_item_input").val("Plate");
		} else { 
			$("#GeneralAdCPLSModal label[name=Plate]").removeClass("active");
		}
		if(driverAdsDetail.item == "Other") {
			$("#GeneralAdCPLSModal label[name=Other]").addClass("active");
			$("#add_cpls_item_input").val("Other");
		} else { 
			$("#GeneralAdCPLSModal label[name=Other]").removeClass("active");
		}
		
		$("#GeneralAdCPLSModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		$("#GeneralAdCPLSModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		$("#GeneralAdCPLSModal select[name=network] option").filter(function() { return $(this).text() == driverAdsDetail.network; }).prop('selected', true);
		$("#GeneralAdCPLSModal select[name=car] option").filter(function() { return $(this).text() == driverAdsDetail.car; }).prop('selected', true);
		$("#GeneralAdCPLSModal select[name=model] option").filter(function() { return $(this).text() == driverAdsDetail.model; }).prop('selected', true);
		
		$("#GeneralAdCPLSModal input[name=postal_code]").val(driverAdsDetail.postal_code);
		$("#GeneralAdCPLSModal input[name=priceRate]").val(driverAdsDetail.pricerate);
		$("#GeneralAdCPLSModal input[name=comment]").val(driverAdsDetail.comment);
    },
}

function updateGeneralAdsList () {
	var serverURL = "<?php echo site_url('Driverads/getAllDriverAdsDetail')?>";
	cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateDriverAdsList', function(data){
		if (data.error['code'] == 0) {
			driverAdsObject.allObjects = data.result.result;
			driverAdsObject.populateGeneralAdsList();
			//driverAdsObject.initDriverAdsPage();
		} else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        }
	});
}

function viewDriverAdsDetail(driverAdsID, type){
    cuadroCommonMethods.resetModal("driverAdsDetailForm");
    var driverAdsDetail = driverAdsObject.getDriverAdsDetailFromID(driverAdsID, type);
    console.dir(driverAdsDetail);
	
	if(driverAdsDetail.add_type == 4) {
		$("form#GeneralAdCPLSForm").trigger( "reset" );
		driverAdsObject.setGeneralAdCPLSModal(driverAdsDetail);
		$("#GeneralAdCPLSModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdCPLSSubmit").html("Update");
		$("#GeneralAdCPLSModal").modal('show');
	} else if(driverAdsDetail.add_type == 3) {
		$("form#GeneralAdWantToDriveForm").trigger( "reset" );
		driverAdsObject.setGeneralAdWantToDriveModal(driverAdsDetail);
		$("#GeneralAdWantToDriveModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdWantToDriveSubmit").html("Update");
		$("#GeneralAdWantToDriveModal").modal('show');
	} else if(driverAdsDetail.add_type == 2) {
		$("form#GeneralAdTaxiAddForm").trigger( "reset" );
		driverAdsObject.setGeneralAdTaxiAddModal(driverAdsDetail);
		$("#GeneralAdTaxiAddModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdTaxiAddSubmit").html("Update");
		$("#GeneralAdTaxiAddModal").modal('show');
	} else if(driverAdsDetail.add_type == 1) {
		$("form#GeneralAdDriversWantedForm").trigger( "reset" );
		driverAdsObject.setGeneralAdDriverWantedModal(driverAdsDetail);
		$("#GeneralAdDriversWantedModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdDriversWantedSubmit").html("Update");
		$("#GeneralAdDriversWantedModal").modal('show');
	}
}

function deleteDriverAdsDetail(driverAdsID, type){
	var serverURL = "<?php echo site_url('DriverAds/removeDriverAds?driverads_id=')?>" + driverAdsID;
	if( type == 4 ){
		serverURL = "<?php echo site_url('GeneralAdsCPLS/removeDriverAds?driverads_id=')?>" + driverAdsID;
	} else if( type == 3 ){
		serverURL = "<?php echo site_url('GeneralAdsWantToDrive/removeDriverAds?driverads_id=')?>" + driverAdsID;
	} else if( type == 2 ){
		serverURL = "<?php echo site_url('GeneralAdsTaxiAds/removeDriverAds?driverads_id=')?>" + driverAdsID;
	}else if( type == 1){
		serverURL = "<?php echo site_url('GeneralAdsDriverWanted/removeDriverAds?driverads_id=')?>" + driverAdsID;
	}

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Type</th>' +
                '<th>Name</th>' +
                '<th>Contact</th>' +
				'<th>Date</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateGeneralAdsList();
        }
    });
}

/* Driver Wanted Adds */
$("#GeneralAdDriversWantedSubmit").click(function(e) {
	$('#GeneralAdDriversWantedModal [name=network_hidden]').val($('#GeneralAdDriversWantedModal [name=network]').val());
    $("form#GeneralAdDriversWantedForm").submit();
});

$("form#GeneralAdDriversWantedForm").submit(function(e){
    console.log('form submit');
    var postData = $(this).serializeArray();

    var name="", contact="",looking_for = "",type ="",state="",area="",network="",postal="",shift="",days="",vehicles="";
    var missing = "";
    for( var i = 0; i < postData.length;i++){
        console.log(postData[i]);
        if(postData[i].name == "name"){
            name = postData[i].value;
        } else if(postData[i].name == "contact"){
            contact = postData[i].value;
        } else if(postData[i].name.indexOf("looking_") > -1){
            if(postData[i].value.length > 0 ){
                looking_for += postData[i].value + ",";
            }
        } else if(postData[i].name.indexOf("type") > -1){
            if(postData[i].value.length > 0 ){
                type += postData[i].value + ",";
            }
        } else if (postData[i].name == "state"){
            state = postData[i].value;
        } else if (postData[i].name == "area"){
            area = postData[i].value;
        } else if (postData[i].name == "network_hidden"){
            network += postData[i].value + ",";
        } else if (postData[i].name == "networkOther"){
            network += postData[i].value + ",";
        } else if (postData[i].name == "postal_code"){
            postal = postData[i].value;
        } else if (postData[i].name.indexOf("shift") > -1){
            if(postData[i].value.length > 0 ){
                shift += postData[i].value + ",";
            }
        }  else if (postData[i].name.indexOf("days") > -1){
            if(postData[i].value.length > 0 ){
                days += postData[i].value + ",";
            }
        }   else if (postData[i].name.indexOf("vehicles") > -1){
            if(postData[i].value.length > 0 ){
                vehicles += postData[i].value + ",";
            }
        }
    }

    if(name.length == 0){
        missing += "Name,";
    }
    if(contact.length == 0){
        missing += "Contact,";
    }
    if(looking_for.length == 0){
        missing += "Looking for,";
    }
    if(type.length == 0){
        missing += "Type,";
    }
    if(state.length == 0){
        missing += "State,";
    }
    if(area.length == 0){
        missing += "Area,";
    }
    if(network.length == 0){
        missing += "Network,";
    }
    if(postal.length == 0){
        missing += "Postcode,";
    }
    if(shift.length == 0){
        missing += "Shift,";
    }
    if(days.length == 0){
        missing += "Days,";
    }
    if(vehicles.length == 0){
        missing += "Vehicles";
    }
    if(missing.length >0 && missing[missing.length-1] == ","){
        missing=missing.substring(0,missing.length-1);
    }

    if( missing.length == 0){
            $("#GeneralAdDriversWantedModal").modal('hide');
            $(document).ready(function() {
                        $('#driversWantedError').text(function(i, oldText) {
                            return "";
                        });
                    });
            var formURL = $("#GeneralAdDriversWantedSubmit").html() == "Add" ? "<?php echo site_url('GeneralAdsDriverWanted/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsDriverWanted/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

            cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
                if (data.error['code'] == 0) {
                    $('#driverads_list_wrapper').remove();
                    var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                        '<thead><tr>' +
                        '<th>Type</th>' +
                        '<th>Name</th>' +
                        '<th>Contact</th>' +
                        '<th>Date</th>' +
                        '<th>Action</th>' +
                        '</tr></thead><tbody></tbody></table>';
                    $(".adv-table").append(temp);
                    updateGeneralAdsList();
                } else if (data.error['code'] == 208) {
                    cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
                } else {
        //                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
                }
//            $(".registrationLoaderBox").hide();
        });
    } else {
        $(document).ready(function() {
            $('#driversWantedError').text(function(i, oldText) {
                return "Missing required fields: "+ missing+" !!!";
            });
        });
    }
    e.preventDefault(); //STOP default action
});

/* Taxi Adds */
$("#GeneralAdTaxiAddSubmit").click(function(e) {
    $("form#GeneralAdTaxiAddForm").submit();
});

$("form#GeneralAdTaxiAddForm").submit(function(e){
    console.log('form submit');

    var postData = $(this).serializeArray();

    var name="", contact="",type ="",state="",area="",network="",postal="",shift="",days="",ndays="",car="",model="",year="",fuel="",kilometers="",vehicles="",lease="";
    var missing = "";
    for( var i = 0; i < postData.length;i++){
        console.log(postData[i]);
        if(postData[i].name == "name"){
            name = postData[i].value;
        } else if(postData[i].name == "contact"){
            contact = postData[i].value;
        } else if(postData[i].name.indexOf("type") > -1){
            if(postData[i].value.length > 0 ){
                type += postData[i].value + ",";
            }
        } else if (postData[i].name == "state"){
            state = postData[i].value;
        } else if (postData[i].name == "area"){
            area = postData[i].value;
        } else if (postData[i].name == "network"){
            network += postData[i].value + ",";
        } else if (postData[i].name == "postal_code"){
            postal = postData[i].value;
        } else if (postData[i].name == "plate"){
            plate = postData[i].value;
        } else if (postData[i].name.indexOf("shift") > -1){
            if(postData[i].value.length > 0 ){
                shift += postData[i].value + ",";
            }
        } else if (postData[i].name.indexOf("ndays") > -1){
            if(postData[i].value.length > 0 ){
                ndays += postData[i].value + ",";
            }
        } else if (postData[i].name.indexOf("days") > -1){
            if(postData[i].value.length > 0 ){
                days += postData[i].value + ",";
            }
        } else if (postData[i].name == "car"){
            car = postData[i].value;
        } else if (postData[i].name == "model"){
		    model = postData[i].value;
	    } else if (postData[i].name == "year"){
            year = postData[i].value;
        } else if (postData[i].name == "fuel"){
            fuel = postData[i].value;
        } else if (postData[i].name == "kilometers"){
            kilometers = postData[i].value;
        }
        else if (postData[i].name.indexOf("vehicles") > -1){
            if(postData[i].value.length > 0 ){
                vehicles += postData[i].value + ",";
            }
        } else if (postData[i].name == "lease"){
            lease = postData[i].value;
        }
    }

    if(name.length == 0){
        missing += "Name,";
    }
    if(contact.length == 0){
        missing += "Contact,";
    }
    if(type.length == 0){
        missing += "Type,";
    }
    if(state.length == 0){
        missing += "State,";
    }
    if(area.length == 0){
        missing += "Area,";
    }
    if(network.length == 0){
        missing += "Network,";
    }
    if(postal.length == 0){
        missing += "Postcode,";
    }
    if(shift.length == 0){
        missing += "Shift,";
    }
    if(days.length == 0){
        missing += "Day shift days,";
    }
    if(ndays.length == 0){
        missing += "Night shift days,";
    }
    if(car.length == 0){
        missing += "Car,";
    }
	if(model.length == 0){
		missing += "Car model,";
	}
    if(year.length == 0){
        missing += "Year,";
    }
    if(fuel.length == 0){
        missing += "Fuel,";
    }
    if(kilometers.length == 0){
        missing += "Kilometers,";
    }
    if(vehicles.length == 0){
        missing += "Vehicles,";
    }
    if(lease.length == 0){
        missing += "Lease";
    }
    if(missing.length >0 && missing[missing.length-1] == ","){
        missing=missing.substring(0,missing.length-1);
    }

    if( missing.length == 0){

        $("#GeneralAdTaxiAddModal").modal('hide');
        $(document).ready(function() {
                    $('#taxiAdError').text(function(i, oldText) {
                        return "";
                    });
                });

        var formURL = $("#GeneralAdTaxiAddSubmit").html() == "Add" ? "<?php echo site_url('GeneralAdsTaxiAds/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsTaxiAds/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
            if (data.error['code'] == 0) {
                $('#driverads_list_wrapper').remove();
                var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                    '<thead><tr>' +
                    '<th>Type</th>' +
                    '<th>Name</th>' +
                    '<th>Contact</th>' +
                    '<th>Date</th>' +
                    '<th>Action</th>' +
                    '</tr></thead><tbody></tbody></table>';
                $(".adv-table").append(temp);
                updateGeneralAdsList();
            } else if (data.error['code'] == 208) {
                cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
            } else {
    //                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
    //            $(".registrationLoaderBox").hide();
        }); } else {
          $(document).ready(function() {
              $('#taxiAdError').text(function(i, oldText) {
                  return "Missing required fields: "+ missing+" !!!";
              });
          });
      }
    e.preventDefault(); //STOP default action
});

/* Want to drive Adds */
$("#GeneralAdWantToDriveSubmit").click(function(e) {
    $("form#GeneralAdWantToDriveForm").submit();
});

$("form#GeneralAdWantToDriveForm").submit(function(e){
    console.log('form submit');

    var postData = $(this).serializeArray();

    var name="", contact="",type ="",state="",area="",network="",postal="",shift="",days="",vehicles="";
    var missing = "";
    for( var i = 0; i < postData.length;i++){
        console.log(postData[i]);
        if(postData[i].name == "name"){
            name = postData[i].value;
        } else if(postData[i].name == "contact"){
            contact = postData[i].value;
        } else if(postData[i].name.indexOf("type") > -1){
            if(postData[i].value.length > 0 ){
                type += postData[i].value + ",";
            }
        } else if (postData[i].name == "state"){
            state = postData[i].value;
        } else if (postData[i].name == "area"){
            area = postData[i].value;
        } else if (postData[i].name == "network"){
            network += postData[i].value + ",";
        } else if (postData[i].name == "postal_code"){
            postal = postData[i].value;
        } else if (postData[i].name.indexOf("shift") > -1){
            if(postData[i].value.length > 0 ){
                shift += postData[i].value + ",";
            }
        } else if (postData[i].name.indexOf("days") > -1){
            if(postData[i].value.length > 0 ){
                days += postData[i].value + ",";
            }
        }
        else if (postData[i].name.indexOf("vehicles") > -1){
            if(postData[i].value.length > 0 ){
                vehicles += postData[i].value + ",";
            }
        }
    }
    if(name.length == 0){
        missing += "Name,";
    }
    if(contact.length == 0){
        missing += "Contact,";
    }
    if(type.length == 0){
        missing += "Type,";
    }
    if(state.length == 0){
        missing += "State,";
    }
    if(area.length == 0){
        missing += "Area,";
    }
    if(network.length == 0){
        missing += "Network,";
    }
    if(postal.length == 0){
        missing += "Postcode,";
    }
    if(shift.length == 0){
        missing += "Shift,";
    }
    if(days.length == 0){
        missing += "Days,";
    }
    if(vehicles.length == 0){
        missing += "Vehicles,";
    }
    if(missing.length >0 && missing[missing.length-1] == ","){
        missing=missing.substring(0,missing.length-1);
    }

    if( missing.length == 0){
        $("#GeneralAdWantToDriveModal").modal('hide');
        $(document).ready(function() {
                      $('#wantToDriveError').text(function(i, oldText) {
                          return "";
                      });
                  });
        var formURL = $("#GeneralAdWantToDriveSubmit").html() == "Add" ? "<?php echo site_url('GeneralAdsWantToDrive/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsWantToDrive/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
            if (data.error['code'] == 0) {
                $('#driverads_list_wrapper').remove();
                var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                    '<thead><tr>' +
                    '<th>Type</th>' +
                    '<th>Name</th>' +
                    '<th>Contact</th>' +
                    '<th>Date</th>' +
                    '<th>Action</th>' +
                    '</tr></thead><tbody></tbody></table>';
                $(".adv-table").append(temp);
                updateGeneralAdsList();
            } else if (data.error['code'] == 208) {
                cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
            } else {
        //                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
        //            $(".registrationLoaderBox").hide();
        });
    } else {
          $(document).ready(function() {
              $('#wantToDriveError').text(function(i, oldText) {
                  return "Missing required fields: "+ missing+" !!!";
              });
          });
    }
    e.preventDefault(); //STOP default action
});

/* Car/Plate/Lease/Sale Adds */
$("#GeneralAdCPLSSubmit").click(function(e) {
    $("form#GeneralAdCPLSForm").submit();
});

$("form#GeneralAdCPLSForm").submit(function(e){
    console.log('form submit');

    var postData = $(this).serializeArray();

	/* get file to upload data */
	var fileToUploadName = "";
	var fileToUpload = $('#CPLSFileSelector')[0].files[0];
	fileToUploadName = (new Date).getTime() + fileToUpload.name;

    var name="", contact="",want_to ="",item="",state="",area="",postal="",price="";
    var missing = "";
    for( var i = 0; i < postData.length;i++){
        console.log(postData[i]);
        if(postData[i].name == "name"){
            name = postData[i].value;
        } else if(postData[i].name == "contact"){
            contact = postData[i].value;
        } else if(postData[i].name.indexOf("want_to") > -1){
            if(postData[i].value.length > 0 ){
                want_to += postData[i].value + ",";
            }
        }else if (postData[i].name == "item"){
            item = postData[i].value;
        } else if (postData[i].name == "state"){
            state = postData[i].value;
        } else if (postData[i].name == "area"){
            area = postData[i].value;
        }else if (postData[i].name == "postal_code"){
            postal = postData[i].value;
        } else if (postData[i].name == "priceRate"){
            if(postData[i].value.length > 0 ){
                price += postData[i].value + ",";
            }
        } else if (postData[i].name == "file_hidden"){
            postData[i].value = fileToUploadName;
        }
    }
	
    if(name.length == 0){
        missing += "Name,";
    }
    if(contact.length == 0){
        missing += "Contact,";
    }
    if(want_to.length == 0){
        missing += "Want to,";
    }
    if(item.length == 0){
        missing += "Item,";
    }
    if(state.length == 0){
        missing += "State,";
    }
    if(area.length == 0){
        missing += "Area,";
    }
    if(postal.length == 0){
        missing += "Postcode,";
    }
    if(price.length == 0){
        missing += "Price";
    }
    if(missing.length >0 && missing[missing.length-1] == ","){
        missing=missing.substring(0,missing.length-1);
    }

    if( missing.length == 0){

    $("#GeneralAdCPLSModal").modal('hide');

    $(document).ready(function() {
                  $('#cplsError').text(function(i, oldText) {
                      return "";
                  });
              });
    var formURL = $("#GeneralAdCPLSSubmit").html() == "Add" ? "<?php echo site_url('GeneralAdsCPLS/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsCPLS/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
			/* upload selected file */
			if(fileToUploadName != "") {
				var reader = new FileReader();
				reader.readAsDataURL(fileToUpload);
				reader.onload = function(event) {
					var result = event.target.result;
					$.post('/dev/index.php/GeneralAdsCPLS/uploadFile', { data: result, name: fileToUploadName }, function() {});
				};
			}
			
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Type</th>' +
                '<th>Name</th>' +
                '<th>Contact</th>' +
				'<th>Date</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateGeneralAdsList();
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();
    });
	
    } else {
          $(document).ready(function() {
              $('#cplsError').text(function(i, oldText) {
                  return "Missing required fields: "+ missing+" !!!";
              });
          });
    }
    e.preventDefault(); //STOP default action
});

/*
* Add new ad callbacks
*/
$("#OptionDriverWantedModal").click(function(e){
	// CONSIDER CHECK!
	//var serverURL = "<?php echo site_url('DriverAds/canAddMoreDriverAds')?>";
	
	$("#GeneralAdDriversWantedForm input").parents().removeClass("active");
	$("#GeneralAdDriversWantedForm label input").prop('checked', false);
	
	$("#add_dwp_type label[name=Taxi]").addClass("active");
	$("#add_dwp_type_input").val('Taxi');
	
	$("form#GeneralAdDriversWantedForm").trigger( "reset" );
	
	$("#GeneralAdDriversWantedModal select[name=state] option").filter(function() { return $(this).text() == 'NSW'; }).prop('selected', true);
	refreshArea('GeneralAdDriversWantedModal');
	
	$("#GeneralAdDriversWantedModal h4.modal-title").html("Add New Drivers Wanted Ad");
	$("#GeneralAdDriversWantedSubmit").html("Add");
	$("#GeneralAdDriversWantedModal").modal('show');
});
$("#OptionTaxiAddModal").click(function(e){
	$("#GeneralAdTaxiAddForm input").parents().removeClass("active");
	$("#GeneralAdTaxiAddForm label input").prop('checked', false);
	
	$("#add_tap_type label[name=Taxi]").addClass("active");
	$("#add_tap_type_input").val('Taxi');
	$("#add_taxi_fuel_type label[name=LPG]").addClass("active");
	$("#add_taxi_fuel_input").val('LPG');
	
	$("form#GeneralAdTaxiAddForm").trigger( "reset" );
	
	$("#GeneralAdTaxiAddModal select[name=state] option").filter(function() { return $(this).text() == 'NSW'; }).prop('selected', true);
	refreshArea('GeneralAdTaxiAddModal');
	
	$("#GeneralAdTaxiAddModal h4.modal-title").html("Add New Taxi Ad");
	$("#GeneralAdTaxiAddSubmit").html("Add");
	$("#GeneralAdTaxiAddModal").modal('show');
});
$("#OptionWantToDriveModal").click(function(e){
	$("#GeneralAdWantToDriveForm input").parents().removeClass("active");
	$("#GeneralAdWantToDriveForm label input").prop('checked', false);
	
	$("#add_wtdp_type label[name=Taxi]").addClass("active");
	$("#add_wtdp_type_input").val('Taxi');
	
	$("form#GeneralAdWantToDriveForm").trigger( "reset" );
	
	$("#GeneralAdWantToDriveModal select[name=state] option").filter(function() { return $(this).text() == 'NSW'; }).prop('selected', true);
	refreshArea('GeneralAdWantToDriveModal');
	
	$("#GeneralAdWantToDriveModal h4.modal-title").html("Add New Want To Drive Ad");
	$("#GeneralAdWantToDriveSubmit").html("Add");
	$("#GeneralAdWantToDriveModal").modal('show');
});
$("#OptionCPLSModal").click(function(e){
	$("#GeneralAdCPLSForm input").parents().removeClass("active");
	$("#GeneralAdCPLSForm label input").prop('checked', false);
	
	$("#add_cpls_want_to label[name=Sell]").addClass("active");
	$("#add_cpls_want_to_input").val('Sell');
	$("#add_cpls_item label[name=Taxi]").addClass("active");
	$("#add_cpls_item_input").val('Taxi');

	$("form#GeneralAdCPLSForm").trigger( "reset" );
	
	$("#GeneralAdCPLSModal select[name=state] option").filter(function() { return $(this).text() == 'NSW'; }).prop('selected', true);
	refreshArea('GeneralAdCPLSModal');
	
	$("#GeneralAdCPLSModal select[name=car] option").filter(function() { return $(this).text() == 'Toyota'; }).prop('selected', true);
	refreshCars('GeneralAdCPLSModal');
	
	$("#GeneralAdCPLSModal h4.modal-title").html("Add New Car/Plate Lease/Sale Ad");
	$("#GeneralAdCPLSSubmit").html("Add");
	$("#GeneralAdCPLSModal").modal('show');
});

/* Connected selects handles */
function refreshArea(modal){
	var setSelected=false;
	$("#" + modal + " [name='area'] option").each(function(){
		if ($(this).attr('state') != $("#" + modal + " [name='state']").find('option:selected').text()) {
			$(this).addClass("hidden");
		} else {
			if(!setSelected) {
				$(this).attr("selected", "selected");
				setSelected=true;
			}
			$(this).removeClass("hidden");
			refreshNetwork(modal);
		}
	});
}

function refreshNetwork(modal){
	$("#" + modal + " [name='network'] option").each(function () {
		$(this).removeAttr('selected');
	});

	var setSelected=false;
	$("#" + modal + " [name='network'] option").each(function(){
		if ($(this).attr('area') != $("#" + modal + " [name='area']").find('option:selected').text()) {
			$(this).addClass("hidden");
		} else {
			if(!setSelected) {
				$(this).attr("selected", "selected");
				setSelected=true;
			}
			$(this).removeClass("hidden");
		}
	});
}

function refreshCars(modal){
	var setSelected=false;
	$("#" + modal + " [name='model'] option").each(function(){
		if ($(this).attr('car') != $("#" + modal + " [name='car']").find('option:selected').text()) {
			$(this).addClass("hidden");
		} else {
			if(!setSelected) {
				$(this).attr("selected", "selected");
				setSelected=true;
			}
			$(this).removeClass("hidden");
		}
	});
}	

/* main */
updateGeneralAdsList();

</script>