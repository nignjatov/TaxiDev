<script>
var selectedDriverAdsID = 0;
var driverAdsObject = {
    allObjects: [],
    getDriverList: function (){
        var serverURL = "<?php echo site_url('Driver/getAllDriverDetail')?>";

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
            if (data.result.result.length > 0){
                for (var total = 0; total < data.result.result.length; total++) {
                    $("select#driver_id").append(
                        $('<option></option>').val(data.result.result[total].ID).html(data.result.result[total].license_plate_no)
                    );
                }
            }
        });
    },
    populateDriverAdsList: function(){
        var allDriverAdsObjects = this.allObjects;
        var totalDriverAds = allDriverAdsObjects.length;
        var driverAdsListString = '';
        for (var i = 0; i < totalDriverAds; i++) {
            var tr_class = i % 2 == 0 ? "gradeA" : "gradeB";
            driverAdsListString += '<tr class="'+tr_class+'">';
            driverAdsListString += '<td>'+allDriverAdsObjects[i].shift_start+'</td>';
            driverAdsListString += '<td>'+allDriverAdsObjects[i].shift_end+'</td>';
            driverAdsListString += '<td>'+allDriverAdsObjects[i].comment+'</td>';
            driverAdsListString += '<td class="action_button">' +
                '<a data-toggle="modal" class="edit" title="" onclick="viewDriverAdsDetail('+allDriverAdsObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" title="" onclick="deleteDriverAdsDetail('+allDriverAdsObjects[i].ID+')" ><i class="ico-close"></i></a>' +
                '</td>';
            driverAdsListString += '</tr>';
        }

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
    setDriverAdsObjectValue: function (driverAdsDetail){
        selectedDriverAdsID = driverAdsDetail.ID;
        $("#driver_shift_end").val(driverAdsDetail.shift_end);
        $("#driver_shift_start").val(driverAdsDetail.shift_start);
        $("#comment").val(driverAdsDetail.comment);
    },
    initDriverAdsPage: function() {

    }
}

function updateDriverAdsList () {
    var serverURL = "<?php echo site_url('Driverads/getAllDriverAdsDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateDriverAdsList', function(data){
//            $('#driverads_list').dataTable().fnClearTable();
            console.dir(data.result.result);
        driverAdsObject.allObjects = data.result.result;
        driverAdsObject.populateDriverAdsList();
        driverAdsObject.initDriverAdsPage();
    });
}

function viewDriverAdsDetail(driverAdsID){
    cuadroCommonMethods.resetModal("driverAdsDetailForm");
    var driverAdsDetail = driverAdsObject.getDriverAdsDetailFromID(driverAdsID);
    console.dir(driverAdsDetail);
    driverAdsObject.setDriverAdsObjectValue(driverAdsDetail);
    $("#driverAdsDetailModal h4.modal-title").html("Update Driver Ads Information");
    $("#driverads_submit_button").html("Update Driver Ads Information");
    $("#driverAdsDetailModal").modal('show');
}

function addNewDriverAds() {
    var serverURL = "<?php echo site_url('DriverAds/canAddMoreDriverAds')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', addNewDriverAds, function(data){
        if (data.error['code'] == 0) {
            cuadroCommonMethods.resetModal("driverAdsDetailForm");
            $("#driverAdsDetailModal h4.modal-title").html("Add New Driver Ads Information");
            $("#driverads_submit_button ").html("Add New Driver Ads Information");
            $("#driverAdsDetailModal").modal('show');
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        }
    });
}

function deleteDriverAdsDetail(driverAdsID){
    var serverURL = "<?php echo site_url('DriverAds/removeDriverAds?driverads_id=')?>" + driverAdsID;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Shift Start</th>' +
                '<th>Shift End</th>' +
                '<th>Comment</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateDriverAdsList();
        }
    });
}

$("#driverads_submit_button").click(function(e) {
    $("form#driverAdsDetailForm").submit();
});

$("form#driverAdsDetailForm").submit(function(e){
    console.log('form submit');
    $("#driverAdsDetailModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#driverads_submit_button").html() == "Add New Driver Ads Information" ? "<?php echo site_url('Driverads/addDriverAds')?>" : "<?php echo site_url('DriverAds/updateDriverAds?driverads_id=')?>" + selectedDriverAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Shift Start</th>' +
                '<th>Shift End</th>' +
                '<th>Comment</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateDriverAdsList();
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();
    });
    e.preventDefault(); //STOP default action
});

$("#driver_shift_start").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#driver_shift_end").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
updateDriverAdsList();

/* Driver Wanted Adds */
$("#driversWantedAdsFormSubmit").click(function(e) {
    $("form#driversWantedAdsForm").submit();
});

$("form#driversWantedAdsForm").submit(function(e){
    console.log('form submit');
    $("#driversWantedPostModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#driversWantedAdsFormSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('DriverWantedAds/addDriverAds?')?>" : "<?php echo site_url('DriverWantedAds/addDriverAds?')?>" + selectedDriverAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Shift Start</th>' +
                '<th>Shift End</th>' +
                '<th>Comment</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateDriverAdsList();
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
    var formURL = $("#GeneralAdTaxiAddSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdTaxiPostAds/addDriverAds?')?>" : "<?php echo site_url('GeneralAdTaxiPostAds/addDriverAds?')?>" + selectedDriverAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Shift Start</th>' +
                '<th>Shift End</th>' +
                '<th>Comment</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateDriverAdsList();
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
    var formURL = $("#GeneralAdWantToDriveSubmit").html() == "Add New Driver Ads Information" ? "<?php echo site_url('GeneralAdWantToDriveAds/addDriverAds?')?>" : "<?php echo site_url('GeneralAdWantToDriveAds/addDriverAds?')?>" + selectedDriverAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'driverAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#driverads_list_wrapper').remove();
            var temp = '<table id="driverads_list" cellpadding="0" cellspacing="0" border="0"' + 'class="dynamic-table display table table-bordered">' +
                '<thead><tr>' +
                '<th>Shift Start</th>' +
                '<th>Shift End</th>' +
                '<th>Comment</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateDriverAdsList();
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();
    });
    e.preventDefault(); //STOP default action
});
</script>