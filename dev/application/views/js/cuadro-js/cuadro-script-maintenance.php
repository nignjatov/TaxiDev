<script>
var selectedMaintenanceID = 0;
var maintenanceObject = {
    allObjects: [],
    getTaxiList: function (){
        var serverURL = "<?php echo site_url('Taxi/getAllTaxiDetail')?>";

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
            if (data.result.result.length > 0){
                for (var total = 0; total < data.result.result.length; total++) {
                    $("select#taxi_id").append(
                        $('<option></option>').val(data.result.result[total].ID).html(data.result.result[total].license_plate_no)
                    );
                }
            }
        });
    },
    populateMaintenanceList: function(){
        var allMaintenanceObjects = this.allObjects;
        var totalMaintenance = allMaintenanceObjects.length;
        var maintenanceListString = '';
        for (var i = 0; i < totalMaintenance; i++) {
            var status = parseInt(allMaintenanceObjects[i].is_scheduled) ? 'Scheduled' : 'Unscheduled';
            var parts_available = parseInt(allMaintenanceObjects[i].parts_available) ? 'Yes' : 'No';
            var total_cost = parseInt(allMaintenanceObjects[i].parts_cost) + parseInt(allMaintenanceObjects[i].repair_cost);
            maintenanceListString += '<tr class="gradeA">';
            maintenanceListString += '<td>'+allMaintenanceObjects[i].license_plate_no+'<span style="display: none">td_item_id'+allMaintenanceObjects[i].ID+'td_item_id</span> </td>';
            maintenanceListString += '<td>'+allMaintenanceObjects[i].maintenance_task+'</td>';
            maintenanceListString += '<td>'+status+'</td>';
            maintenanceListString += '<td>'+allMaintenanceObjects[i].maintenance_date+'</td>';
            maintenanceListString += '<td>'+allMaintenanceObjects[i].parts_required+'</td>';
            maintenanceListString += '<td>'+parts_available+'</td>';
            maintenanceListString += '<td>'+total_cost+'</td>';
            maintenanceListString += '<td class="action_button">' +
                '<a data-toggle="modal" class="edit" title="" onclick="viewMaintenanceDetail('+allMaintenanceObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" title="" onclick="deleteMaintenanceDetail('+allMaintenanceObjects[i].ID+')" ><i class="ico-close"></i></a>' +
                '</td>';
            maintenanceListString += '</tr>';
        }

        $("#maintenance_list tbody").html(maintenanceListString);
    },
    getMaintenanceDetailFromID: function (ID) {
        var maintenanceDetailArray = [];
        var allMaintenanceObjects = this.allObjects;
        var totalMaintenance = allMaintenanceObjects.length;
        for (var i = 0; i < totalMaintenance; i++) {
            if (ID == allMaintenanceObjects[i].ID) {
                maintenanceDetailArray = allMaintenanceObjects[i];
                break;
            }
        }

        return maintenanceDetailArray;
    },
    getMaintenanceDetailFromLicense: function (license_plate_no) {
        var maintenanceDetailArray = [];
        var allMaintenanceObjects = this.allObjects;
        var totalMaintenance = allMaintenanceObjects.length;
        for (var i = 0; i < totalMaintenance; i++) {
            if (license_plate_no == allMaintenanceObjects[i].license_plate_no) {
                maintenanceDetailArray = allMaintenanceObjects[i];
                break;
            }
        }

        return maintenanceDetailArray;
    },
    setMaintenanceObjectValue: function (maintenanceDetail){
        selectedMaintenanceID = maintenanceDetail.ID;
        $("#taxi_id").val(maintenanceDetail.taxi_id);
        $("#maintenance_task").val(maintenanceDetail.maintenance_task);
        $("#is_scheduled").val(maintenanceDetail.is_scheduled);
        if (parseInt(maintenanceDetail.is_scheduled)) {
            $('#is_scheduled_yes').prop("checked", true);
        } else {
            $('#is_scheduled_no').prop("checked", true);
        }

        $("#time_required").val(maintenanceDetail.time_required);
        $("#parts_required").val(maintenanceDetail.parts_required);
        if (parseInt(maintenanceDetail.parts_available)) {
            $("#parts_available_yes").prop("checked", true);
        } else {
            $("#parts_available_no").prop("checked", true);
        }

        $("#parts_cost").val(maintenanceDetail.parts_cost);
        $("#repair_cost").val(maintenanceDetail.repair_cost);
        $("#maintenance_date").val(maintenanceDetail.maintenance_date);
        $("#comment").val(maintenanceDetail.comment);
    },
    fnFormatDetails:function ( oTable, nTr ) {
        var aData = oTable.fnGetData( nTr );
        var item_id = cuadroCommonMethods.getItemID(aData[1]);
        var aData = this.getMaintenanceDetailFromID(item_id);

        var status = aData.is_scheduled ? 'Scheduled' : 'Unscheduled';
        var parts_available = aData.parts_available ? 'Yes' : 'No';
        var sOut = '<div class="col-sm-12">';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Taxi License Plate No:</td><td>'+aData.license_plate_no+'</td></tr>';
        sOut += '<tr><td>Maintenance Task:</td><td>'+aData.maintenance_task+'</td></tr>';
        sOut += '<tr><td>Status:</td><td>'+status+'</td></tr>';
        sOut += '<tr><td>Time Required:</td><td>'+aData.time_required+'</td></tr>';
        sOut += '<tr><td>Parts Required:</td><td>'+aData.parts_required+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Parts Available:</td><td>'+parts_available+'</td></tr>';
        sOut += '<tr><td>Parts Cost:</td><td>'+aData.parts_cost+'</td></tr>';
        sOut += '<tr><td>Repair Cost (AU$):</td><td>'+aData.repair_cost+'</td></tr>';
        sOut += '<tr><td>Maintenance Date (AU$):</td><td>'+aData.maintenance_date+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '</div>';
        sOut += '<div class="col-sm-12">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td><strong>Comment:</strong> '+aData.comment+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        return sOut;
    },
    initMaintenancePage: function() {
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img src="<?php echo base_url()?>application/views/img/details_open.png">';
        nCloneTd.className = "center";

        $('#maintenance_list thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );

        $('#maintenance_list tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#maintenance_list').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $(document).on('click','#maintenance_list tbody td img',function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "<?php echo base_url()?>application/views/img/details_open.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "<?php echo base_url()?>application/views/img/details_close.png";
                oTable.fnOpen( nTr, maintenanceObject.fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
    }
}

function searchMaintenance() {
    var start_date = $("#maintenanceStart").val();
    var end_date = $("#maintenanceEnd").val();
    var serverURL = "<?php echo site_url('Maintenance/getAllMaintenanceDetailWithDateRange?maintenanceStart=')?>" + start_date + "&maintenanceEnd=" + end_date;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'searchMaintenance', function(data){
//            $('#maintenance_list').dataTable().fnClearTable();
        console.dir(data.result.result);
        maintenanceObject.allObjects = data.result.result;
        $('#maintenance_list_wrapper').remove();
        var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
            'class="display table table-bordered tb_roster_paying"' +
            'id="maintenance_list">' +
            '<thead><tr>' +
            '<th>Taxi #</th>' +
            '<th>Maintenance Task</th>' +
            '<th>Status</th>' +
            '<th>Date</th>' +
            '<th>Parts Required</th>' +
            '<th>Parts Available</th>' +
            '<th>Total Cost AU$</th>' +
            '<th>Action</th>' +
            '</tr></thead><tbody></tbody></table>';
        $(".adv-table").append(temp);
        maintenanceObject.populateMaintenanceList();
        maintenanceObject.initMaintenancePage();
    });
}

function updateMaintenanceList () {
    var serverURL = "<?php echo site_url('Maintenance/getAllMaintenanceDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateMaintenanceList', function(data){
//            $('#maintenance_list').dataTable().fnClearTable();
            console.dir(data.result.result);
        maintenanceObject.allObjects = data.result.result;
        maintenanceObject.populateMaintenanceList();
        maintenanceObject.initMaintenancePage();
    });
}

function viewMaintenanceDetail(maintenanceID){
    cuadroCommonMethods.resetModal("maintenanceDetailForm");
    $('#is_scheduled_yes').val(1);
    $('#is_scheduled_no').val(0);
    $('#parts_available_yes').val(1);
    $('#parts_available_no').val(0);
    var maintenanceDetail = maintenanceObject.getMaintenanceDetailFromID(maintenanceID);
    maintenanceObject.setMaintenanceObjectValue(maintenanceDetail);
    $('form#maintenanceDetailForm').attr('action', "<?php echo site_url('Maintenance/updateMaintenance?maintenance_id=')?>" + selectedMaintenanceID);
    $("#maintenanceDetailModal h4.modal-title").html("Update Maintenance Information");
    $("#maintenance_submit_button").html("Update Maintenance Information");
    $("#maintenanceDetailModal").modal('show');
}

function addNewMaintenance() {
    cuadroCommonMethods.resetModal("maintenanceDetailForm");
    $('#is_scheduled_yes').val(1);
    $('#is_scheduled_no').val(0);
    $('#parts_available_yes').val(1);
    $('#parts_available_no').val(0);
    $('form#maintenanceDetailForm').attr('action', "<?php echo site_url('Maintenance/addMaintenance')?>");
    $("#maintenanceDetailModal h4.modal-title").html("Add New Maintenance Information");
    $("#maintenance_submit_button ").html("Add New Maintenance Information");
    $("#maintenanceDetailModal").modal('show');
}

function deleteMaintenanceDetail(maintenanceID){
    var serverURL = "<?php echo site_url('Maintenance/removeMaintenance?maintenance_id=')?>" + maintenanceID;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            $('#maintenance_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
                'class="display table table-bordered tb_roster_paying"' +
                'id="maintenance_list">' +
                '<thead><tr>' +
                '<th>Taxi #</th>' +
                '<th>Maintenance Task</th>' +
                '<th>Status</th>' +
                '<th>Date</th>' +
                '<th>Parts Required</th>' +
                '<th>Parts Available</th>' +
                '<th>Total Cost AU$</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateMaintenanceList();
        }
    });
}

$("#maintenance_submit_button").click(function(e) {
    $("form#maintenanceDetailForm").submit();
});

$("form#maintenanceDetailForm").submit(function(e){
    e.preventDefault(); //STOP default action
    console.log('form submit');
    $("#maintenanceDetailModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'maintenanceDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#maintenance_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
                'class="display table table-bordered tb_roster_paying"' +
                'id="maintenance_list">' +
                '<thead><tr>' +
                '<th>Taxi #</th>' +
                '<th>Maintenance Task</th>' +
                '<th>Status</th>' +
                '<th>Date</th>' +
                '<th>Parts Required</th>' +
                '<th>Parts Available</th>' +
                '<th>Total Cost AU$</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateMaintenanceList();
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();

    });
});

$("#maintenanceStart").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#maintenanceEnd").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#maintenance_date").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
updateMaintenanceList();
maintenanceObject.getTaxiList();
</script>