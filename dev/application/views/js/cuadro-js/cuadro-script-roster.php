<script>
var selectedRosterID = 0;
var rosterObject = {
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
    populateRosterList: function(){
        var allRosterObjects = this.allObjects;
        var totalRoster = allRosterObjects.length;
        var rosterListString = '';
        for (var i = 0; i < totalRoster; i++) {
            var balance = parseInt(allRosterObjects[i].amount_paid) - parseInt(allRosterObjects[i].mf_amount) - parseInt(allRosterObjects[i].m7_amount) - parseInt(allRosterObjects[i].cash_amount) - parseInt(allRosterObjects[i].fine_toll_amount) - parseInt(allRosterObjects[i].expenses);
            var is_paid = parseInt(allRosterObjects[i].is_paid) ? 'Yes' : 'No';
            rosterListString += '<tr class="gradeA">';
            rosterListString += '<td>'+allRosterObjects[i].license_plate_no+'<span style="display: none">td_item_id'+allRosterObjects[i].ID+'td_item_id</span> </td>';
            rosterListString += '<td>'+allRosterObjects[i].paying_date+'</td>';
            rosterListString += '<td>'+allRosterObjects[i].shift+'</td>';
            rosterListString += '<td>'+allRosterObjects[i].driver_name+'</td>';
            rosterListString += '<td>'+is_paid+'</td>';
            rosterListString += '<td>'+allRosterObjects[i].amount_paid+'</td>';
            rosterListString += '<td>'+balance+'</td>';
            rosterListString += '<td class="action_button">' + '<a data-toggle="modal" class="edit" title="" onclick="viewRosterDetail(\''+allRosterObjects[i].ID+'\','+allRosterObjects[i].taxi_id+',\''+allRosterObjects[i].paying_date+'\',\''+allRosterObjects[i].shift+'\')" ><i class="ico-pencil"></i></a>';
            rosterListString += allRosterObjects[i].ID == '' ? '' : '<a data-toggle="modal" class="remove" title="" onclick="deleteRosterDetail('+allRosterObjects[i].ID+')" ><i class="ico-close"></i></a>' +
                '</td>';
            rosterListString += '</tr>';
        }

        $("#roster_list tbody").html(rosterListString);
    },
    getRosterDetailFromID: function (ID) {
        var rosterDetailArray = [];
        var allRosterObjects = this.allObjects;
        var totalRoster = allRosterObjects.length;
        for (var i = 0; i < totalRoster; i++) {
            if (ID == allRosterObjects[i].ID) {
                rosterDetailArray = allRosterObjects[i];
                break;
            }
        }

        return rosterDetailArray;
    },
    getRosterDetailFromLicense: function (license_plate_no) {
        var rosterDetailArray = [];
        var allRosterObjects = this.allObjects;
        var totalRoster = allRosterObjects.length;
        for (var i = 0; i < totalRoster; i++) {
            if (license_plate_no == allRosterObjects[i].license_plate_no) {
                rosterDetailArray = allRosterObjects[i];
                break;
            }
        }

        return rosterDetailArray;
    },
    setRosterObjectValue: function (rosterDetail){
        selectedRosterID = rosterDetail.ID;
        $("#taxi_id").val(rosterDetail.taxi_id);
        $("#paying_date").val(rosterDetail.paying_date);
        if (rosterDetail.shift == 'Morning') {
            $('#shift_morning').prop("checked", true);
        } else {
            $('#shift_evening').prop("checked", true);
        }

        if (parseInt(rosterDetail.is_leased)) {
            $("#is_leased_yes").prop("checked", true);
        } else {
            $("#is_leased_no").prop("checked", true);
        }

        $("#driver_name").val(rosterDetail.driver_name);
        if (parseInt(rosterDetail.is_paid)) {
            $("#is_paid_yes").prop("checked", true);
        } else {
            $("#is_paid_no").prop("checked", true);
        }

        $("#amount_paid").val(rosterDetail.amount_paid);
        $("#mf_amount").val(rosterDetail.mf_amount);
        $("#m7_amount").val(rosterDetail.m7_amount);
        $("#cash_amount").val(rosterDetail.cash_amount);
        $("#fine_toll_amount").val(rosterDetail.fine_toll_amount);
        $("#expenses").val(rosterDetail.expenses);
        $("#comment").val(rosterDetail.comment);
    },
    fnFormatDetails:function ( oTable, nTr ) {
        var aData = oTable.fnGetData( nTr );
        var item_id = cuadroCommonMethods.getItemID(aData[1]);
        var aData = this.getRosterDetailFromID(item_id);

        var is_paid = parseInt(aData.is_paid) ? 'Yes' : 'No';
        var is_leased = parseInt(aData.is_leased) ? 'Yes' : 'No';

        var sOut = '<div class="col-sm-12">';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Taxi License Plate No:</td><td>'+aData.license_plate_no+'</td></tr>';
        sOut += '<tr><td>Date:</td><td>'+aData.paying_date+'</td></tr>';
        sOut += '<tr><td>Shift:</td><td>'+aData.shift+'</td></tr>';
        sOut += '<tr><td>Leased:</td><td>'+is_leased+'</td></tr>';
        sOut += '<tr><td>Driver Name:</td><td>'+aData.driver_name+'</td></tr>';
        sOut += '<tr><td>Paid:</td><td>'+is_paid+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Amount Paid (AU$):</td><td>'+aData.amount_paid+'</td></tr>';
        sOut += '<tr><td>MF (AU$):</td><td>'+aData.mf_amount+'</td></tr>';
        sOut += '<tr><td>M7 (AU$):</td><td>'+aData.m7_amount+'</td></tr>';
        sOut += '<tr><td>Cash (AU$):</td><td>'+aData.cash_amount+'</td></tr>';
        sOut += '<tr><td>Fine/Toll (AU$):</td><td>'+aData.fine_toll_amount+'</td></tr>';
        sOut += '<tr><td>Expenses (AU$):</td><td>'+aData.expenses+'</td></tr>';
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
    initRosterPage: function() {
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img src="<?php echo base_url()?>application/views/img/details_open.png">';
        nCloneTd.className = "center";

        $('#roster_list thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );

        $('#roster_list tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#roster_list').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $(document).on('click','#roster_list tbody td img',function () {
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
                oTable.fnOpen( nTr, rosterObject.fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
    }
}

function searchRoster() {
    var start_date = $("#rosterStart").val();
    var end_date = $("#rosterEnd").val();
    var serverURL = "<?php echo site_url('Roster/getAllRosterDetailWithDateRange?rosterStart=')?>" + start_date + "&rosterEnd=" + end_date;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'searchRoster', function(data){
//            $('#roster_list').dataTable().fnClearTable();
        console.dir(data.result.result);
        rosterObject.allObjects = data.result.result;
        $('#roster_list_wrapper').remove();
        var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
            'class="display table table-bordered tb_roster_paying"' +
            'id="roster_list">' +
            '<thead><tr>' +
            '<th>Taxi #</th>' +
            '<th>Date</th>' +
            '<th>Shift</th>' +
            '<th>Driver Name</th>' +
            '<th>Paid</th>' +
            '<th>Amount Paid</th>' +
            '<th>Balance</th>' +
            '<th>Action</th>' +
            '</tr></thead><tbody></tbody></table>';
        $(".adv-table").append(temp);
        rosterObject.populateRosterList();
        rosterObject.initRosterPage();
    });
}

function updateRosterList () {
    var serverURL = "<?php echo site_url('Roster/getAllRosterDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateRosterList', function(data){
//            $('#roster_list').dataTable().fnClearTable();
        console.dir(data.result.result);
        rosterObject.allObjects = data.result.result;
        rosterObject.populateRosterList();
        rosterObject.initRosterPage();
    });
}

function viewRosterDetail(rosterID, taxi_id, paying_date, shift){
    if (rosterID == '') {
        addNewRoster();
        $("#taxi_id").val(taxi_id);
        $("#paying_date").val(paying_date);
        if (shift == 'Morning') {
            $("#shift_morning").prop("checked", true);
        } else {
            $("#shift_evening").prop("checked", true);
        }
    } else {
        cuadroCommonMethods.resetModal("rosterDetailForm");
        $('#shift_morning').val('Morning');
        $('#shift_evening').val('Evening');
        $('#is_leased_yes').val(1);
        $('#is_leased_no').val(0);
        var rosterDetail = rosterObject.getRosterDetailFromID(rosterID);
        rosterObject.setRosterObjectValue(rosterDetail);
        $('form#rosterDetailForm').attr('action', "<?php echo site_url('Roster/updateRoster?roster_id=')?>" + selectedRosterID);
        $("#rosterDetailModal h4.modal-title").html("Update Roster Information");
        $("#roster_submit_button").html("Update Roster Information");
        $("#rosterDetailModal").modal('show');
    }
}

function addNewRoster() {
    cuadroCommonMethods.resetModal("rosterDetailForm");
    $('#shift_morning').val('Morning');
    $('#shift_evening').val('Evening');
    $('#is_leased_yes').val(1);
    $('#is_leased_no').val(0);
    $('form#rosterDetailForm').attr('action', "<?php echo site_url('Roster/addRoster')?>");
    $("#rosterDetailModal h4.modal-title").html("Add New Roster Information");
    $("#roster_submit_button ").html("Add New Roster Information");
    $("#rosterDetailModal").modal('show');
}

function deleteRosterDetail(rosterID){
    var serverURL = "<?php echo site_url('Roster/removeRoster?roster_id=')?>" + rosterID;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            $('#roster_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
                'class="display table table-bordered tb_roster_paying"' +
                'id="roster_list">' +
                '<thead><tr>' +
                '<th>Taxi #</th>' +
                '<th>Date</th>' +
                '<th>Shift</th>' +
                '<th>Driver Name</th>' +
                '<th>Paid</th>' +
                '<th>Amount Paid</th>' +
                '<th>Balance</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateRosterList();
        }
    });
}

$("#roster_submit_button").click(function(e) {
    $("form#rosterDetailForm").submit();
});

$("form#rosterDetailForm").submit(function(e){
    e.preventDefault(); //STOP default action
    console.log('form submit');
    $("#rosterDetailModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'rosterDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#roster_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0"' +
                'class="display table table-bordered tb_roster_paying"' +
                'id="roster_list">' +
                '<thead><tr>' +
                '<th>Taxi #</th>' +
                '<th>Date</th>' +
                '<th>Shift</th>' +
                '<th>Driver Name</th>' +
                '<th>Paid</th>' +
                '<th>Amount Paid</th>' +
                '<th>Balance</th>' +
                '<th>Action</th>' +
                '</tr></thead><tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateRosterList();
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();

    });
});

$("#rosterStart").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#rosterEnd").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#paying_date").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
updateRosterList();
rosterObject.getTaxiList();
</script>