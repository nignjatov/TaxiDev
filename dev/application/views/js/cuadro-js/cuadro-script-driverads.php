<script>
var selectedDriverAdsID = 0;
var serverUrl ="http://localhost:8083/dev/scripts/";
var driverAdsObject = {
    allObjects: [],

	populateGeneralAdsList: function(){
        var allDriverAdsObjects = this.allObjects;
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
			driverAdsListString += '<td>'+allDriverAdsObjects[i].date+'</td>';
				
			var deleteAction = allDriverAdsObjects[i].add_type;	
			
            driverAdsListString += '<td class="action_button">' +
                '<a data-toggle="modal" class="edit" title="" onclick="viewDriverAdsDetail('+allDriverAdsObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" title="" onclick="deleteDriverAdsDetail('+allDriverAdsObjects[i].ID+','+deleteAction+')" ><i class="ico-close"></i></a>' +
                '</td>';
            driverAdsListString += '</tr>';
        }

		$('#driverads_list').dataTable().fnDestroy();
		
        $("#driverads_list tbody").html(driverAdsListString);

        $('#driverads_list').dataTable( {
            "aaSorting": [[ 1, "desc" ]]
        });
    },
    getDriverAdsDetailFromID: function (ID) {
        var driverAdsDetailArray = [];
        var allDriverAdsObjects = this.allObjects;
        var totalDriverAds = allDriverAdsObjects.length;
        for (var i = 0; i < totalDriverAds; i++) {
            if (ID == allDriverAdsObjects[i].ID) {
                driverAdsDetailArray = allDriverAdsObjects[i];
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
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=looking_for_1]").parents().removeClass("active");
		}
		if(lookingFor.indexOf("Shift Share Partners") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=looking_for_2]").parents().addClass("active");
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=looking_for_2]").parents().removeClass("active");
		}
		
		var shift = driverAdsDetail.shift;
		if(shift.indexOf("Day") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=shift_1]").parents().addClass("active");
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_1]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Plate") > -1) {
			shift.replace("Night Plate", "");
			$("#GeneralAdDriversWantedModal label input[name=shift_3]").parents().addClass("active");
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_3]").parents().removeClass("active");
		}
		if(shift.indexOf("Night") > -1) {
			$("#GeneralAdDriversWantedModal label input[name=shift_2]").parents().addClass("active");
		} else { 
			$("#GeneralAdDriversWantedModal label input[name=shift_2]").parents().removeClass("active");
		}

		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_1]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_2]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_3]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_4]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_5]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_6]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=days_7]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=days_7]").parents().removeClass("active");
			
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_1]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_2]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_3]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_3]").parents().removeClass("active");			
		if(vehicles.indexOf("Luxury/Executive") > -1) 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_4]").parents().addClass("active");
		else 
			$("#GeneralAdDriversWantedModal label input[name=vehicles_4]").parents().removeClass("active");	
			
		$("#GeneralAdDriversWantedModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		$("#GeneralAdDriversWantedModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		$("#GeneralAdDriversWantedModal select[name=network] option").filter(function() { return $(this).text() == driverAdsDetail.network; }).prop('selected', true);
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
		
		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_1]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_2]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_3]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_4]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_5]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_6]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=days_7]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=days_7]").parents().removeClass("active");
		
		var ndays = driverAdsDetail.ndays;
		if(ndays.indexOf("Monday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_1]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_1]").parents().removeClass("active");
			
		if(ndays.indexOf("Tuesday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_2]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_2]").parents().removeClass("active");
		
		if(ndays.indexOf("Wednesday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_3]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_3]").parents().removeClass("active");
		
		if(ndays.indexOf("Thursday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_4]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_4]").parents().removeClass("active");
			
		if(ndays.indexOf("Friday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_5]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_5]").parents().removeClass("active");
			
		if(ndays.indexOf("Saturday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_6]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_6]").parents().removeClass("active");
			
		if(ndays.indexOf("Sunday") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=ndays_7]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=ndays_7]").parents().removeClass("active");
		
		var shift = driverAdsDetail.shift;
		if(shift.indexOf("Day Shift") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=dshift]").parents().addClass("active");
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=dshift]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Shift") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=nshift]").parents().addClass("active");
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=nshift]").parents().removeClass("active");
		}
		
		$("#GeneralAdTaxiAddModal select[name=state] option").filter(function() { return $(this).text() == driverAdsDetail.state; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=area] option").filter(function() { return $(this).text() == driverAdsDetail.area; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=network] option").filter(function() { return $(this).text() == driverAdsDetail.network; }).prop('selected', true);
		
		$("#GeneralAdTaxiAddModal select[name=car] option").filter(function() { return $(this).text() == driverAdsDetail.car; }).prop('selected', true);
		$("#GeneralAdTaxiAddModal select[name=kilometers] option").filter(function() { return $(this).text() == driverAdsDetail.kilometers; }).prop('selected', true);
		
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_1]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_2]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_3]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_3]").parents().removeClass("active");			
		if(vehicles.indexOf("Luxury/Executive") > -1) 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_4]").parents().addClass("active");
		else 
			$("#GeneralAdTaxiAddModal label input[name=vehicles_4]").parents().removeClass("active");	
		
		var options = driverAdsDetail.options;
		if(options.indexOf("Baby capsule") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=option_1]").parents().addClass("active");
		} else { 
			$("#GeneralAdTaxiAddModal label input[name=option_1]").parents().removeClass("active");
		}
		if(options.indexOf("Wheelchair accessible") > -1) {
			$("#GeneralAdTaxiAddModal label input[name=option_2]").parents().addClass("active");
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
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_1]").parents().removeClass("active");
		}
		if(shift.indexOf("Night Plate") > -1) {
			shift.replace("Night Plate", "");
			$("#GeneralAdWantToDriveModal label input[name=shift_3]").parents().addClass("active");
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_3]").parents().removeClass("active");
		}
		if(shift.indexOf("Night") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=shift_2]").parents().addClass("active");
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=shift_2]").parents().removeClass("active");
		}

		var days = driverAdsDetail.days;
		if(days.indexOf("Monday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_1]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_1]").parents().removeClass("active");
			
		if(days.indexOf("Tuesday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_2]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_2]").parents().removeClass("active");
		
		if(days.indexOf("Wednesday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_3]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_3]").parents().removeClass("active");
		
		if(days.indexOf("Thursday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_4]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_4]").parents().removeClass("active");
			
		if(days.indexOf("Friday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_5]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_5]").parents().removeClass("active");
			
		if(days.indexOf("Saturday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_6]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_6]").parents().removeClass("active");
			
		if(days.indexOf("Sunday") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=days_7]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=days_7]").parents().removeClass("active");
			
		var vehicles = driverAdsDetail.vehicles;
		if(vehicles.indexOf("Sedan") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_1]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_1]").parents().removeClass("active");
		if(vehicles.indexOf("Wagon") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_2]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_2]").parents().removeClass("active");
		if(vehicles.indexOf("Maxi") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_3]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_3]").parents().removeClass("active");			
		if(vehicles.indexOf("Luxury/Executive") > -1) 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_4]").parents().addClass("active");
		else 
			$("#GeneralAdWantToDriveModal label input[name=vehicles_4]").parents().removeClass("active");
		
		var options = driverAdsDetail.options;
		if(options.indexOf("Baby capsule") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=option_1]").parents().addClass("active");
		} else { 
			$("#GeneralAdWantToDriveModal label input[name=option_1]").parents().removeClass("active");
		}
		if(options.indexOf("Wheelchair accessible") > -1) {
			$("#GeneralAdWantToDriveModal label input[name=option_2]").parents().addClass("active");
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

function viewDriverAdsDetail(driverAdsID){
    cuadroCommonMethods.resetModal("driverAdsDetailForm");
    var driverAdsDetail = driverAdsObject.getDriverAdsDetailFromID(driverAdsID);
    console.dir(driverAdsDetail);
	
	if(driverAdsDetail.add_type == 4) {
		driverAdsObject.setGeneralAdCPLSModal(driverAdsDetail);
		$("form#GeneralAdCPLSForm").trigger( "reset" );
		$("#GeneralAdCPLSModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdCPLSSubmit").html("Update Driver Ads Information");
		$("#GeneralAdCPLSModal").modal('show');
	} else if(driverAdsDetail.add_type == 3) {
		driverAdsObject.setGeneralAdWantToDriveModal(driverAdsDetail);
		$("form#GeneralAdWantToDriveForm").trigger( "reset" );
		$("#GeneralAdWantToDriveModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdWantToDriveSubmit").html("Update Driver Ads Information");
		$("#GeneralAdWantToDriveModal").modal('show');
	} else if(driverAdsDetail.add_type == 2) {
		driverAdsObject.setGeneralAdTaxiAddModal(driverAdsDetail);
		$("form#GeneralAdTaxiAddForm").trigger( "reset" );
		$("#GeneralAdTaxiAddModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdTaxiAddSubmit").html("Update Driver Ads Information");
		$("#GeneralAdTaxiAddModal").modal('show');
	} else if(driverAdsDetail.add_type == 1) {
		driverAdsObject.setGeneralAdDriverWantedModal(driverAdsDetail);
		$("form#GeneralAdDriversWantedForm").trigger( "reset" );
		$("#GeneralAdDriversWantedModal h4.modal-title").html("Update Driver Ads Information");
		$("#GeneralAdDriversWantedSubmit").html("Update Driver Ads Information");
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
    $("form#GeneralAdDriversWantedForm").submit();
});

$("form#GeneralAdDriversWantedForm").submit(function(e){
    console.log('form submit');
    $("#GeneralAdDriversWantedModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#GeneralAdDriversWantedSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdsDriverWanted/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsDriverWanted/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

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
    e.preventDefault(); //STOP default action
});

/* Taxi Adds */
$("#GeneralAdTaxiAddSubmit").click(function(e) {
    $("form#GeneralAdTaxiAddForm").submit();
});

$("form#GeneralAdTaxiAddForm").submit(function(e){
    console.log('form submit');
    $("#GeneralAdTaxiAddModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#GeneralAdTaxiAddSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdsTaxiAds/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsTaxiAds/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

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
    e.preventDefault(); //STOP default action
});

/* Want to drive Adds */
$("#GeneralAdWantToDriveSubmit").click(function(e) {
    $("form#GeneralAdWantToDriveForm").submit();
});

$("form#GeneralAdWantToDriveForm").submit(function(e){
    console.log('form submit');
    $("#GeneralAdWantToDriveModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#GeneralAdWantToDriveSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdsWantToDrive/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsWantToDrive/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

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
    e.preventDefault(); //STOP default action
});

/* Car/Plate/Lease/Sale Adds */
$("#GeneralAdCPLSSubmit").click(function(e) {
    $("form#GeneralAdCPLSForm").submit();
});

$("form#GeneralAdCPLSForm").submit(function(e){
    console.log('form submit');
    $("#GeneralAdCPLSModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#GeneralAdCPLSSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdsCPLS/addDriverAds?')?>" : "<?php echo site_url('GeneralAdsCPLS/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

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
    e.preventDefault(); //STOP default action
});

$("#OptionDriverWantedModal").click(function(e){
	// CONSIDER CHECK!
	//var serverURL = "<?php echo site_url('DriverAds/canAddMoreDriverAds')?>";
	
	$("form#GeneralAdDriversWantedForm").trigger( "reset" );
	$("#GeneralAdDriversWantedModal h4.modal-title").html("Add New Driver Ads Information");
	$("#GeneralAdDriversWantedSubmit").html("Add New Driver Ads Information");
	$("#GeneralAdDriversWantedModal").modal('show');
});
$("#OptionTaxiAddModal").click(function(e){
	$("form#GeneralAdTaxiAddForm").trigger( "reset" );
	$("#GeneralAdTaxiAddModal h4.modal-title").html("Add New Driver Ads Information");
	$("#GeneralAdTaxiAddSubmit").html("Add New Driver Ads Information");
	$("#GeneralAdTaxiAddModal").modal('show');
});
$("#OptionWantToDriveModal").click(function(e){
	$("form#GeneralAdWantToDriveForm").trigger( "reset" );
	$("#GeneralAdWantToDriveModal h4.modal-title").html("Add New Driver Ads Information");
	$("#GeneralAdWantToDriveSubmit").html("Add New Driver Ads Information");
	$("#GeneralAdWantToDriveModal").modal('show');
});
$("#OptionCPLSModal").click(function(e){
	$("form#GeneralAdCPLSForm").trigger( "reset" );
	$("#GeneralAdCPLSModal h4.modal-title").html("Add New Driver Ads Information");
	$("#GeneralAdCPLSSubmit").html("Add New Driver Ads Information");
	$("#GeneralAdCPLSModal").modal('show');
});

updateGeneralAdsList();

</script>