<script>
var selectedJournalID = 0;
var journalObject = {
    allObjects: [],
    populateJournalList: function(){
        var allJournalObjects = this.allObjects;
        var totalJournal = allJournalObjects.length;
        var journalListString = '';
        for (var i = 0; i < totalJournal; i++) {
//            var total_expanse = parseInt(allJournalObjects[i].shift_rate) + parseInt(allJournalObjects[i].fuel_cost) + parseInt(allJournalObjects[i].other_cost);
//            var total_income = parseInt(allJournalObjects[i].cash_payment) + parseInt(allJournalObjects[i].eftpos_shift_total) + parseInt(allJournalObjects[i].docket);
            journalListString += '<tr class="gradeA">';
            journalListString += '<td>'+allJournalObjects[i].paying_date+'</td>';
            journalListString += '<td>'+allJournalObjects[i].shift+'</td>';
            journalListString += '<td>'+allJournalObjects[i].license_plate_no+'<span style="display: none">td_item_id'+allJournalObjects[i].ID+'td_item_id</span> </td>';
            journalListString += '<td>'+allJournalObjects[i].operator_name+'</td>';
            journalListString += '<td>'+allJournalObjects[i].shift_rate+'</td>';
            journalListString += '<td>'+allJournalObjects[i].fuel_cost+'</td>';
            journalListString += '<td>'+allJournalObjects[i].other_cost+'</td>';
            journalListString += '<td>'+allJournalObjects[i].cash_payment+'</td>';
            journalListString += '<td>'+allJournalObjects[i].eftpos_shift_total+'</td>';
            journalListString += '<td>'+allJournalObjects[i].docket+'</td>';
            journalListString += '<td class="action_button">' +
                '<a data-toggle="modal" class="edit" onclick="viewJournalDetail('+allJournalObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" onclick="deleteJournalDetail('+allJournalObjects[i].ID+')" ><i class="ico-close"></i></a>' +
                '</td>';
            journalListString += '</tr>';
        }

        $("#journal_list tbody").html(journalListString);
    },
    getJournalDetailFromID: function (ID) {
        var journalDetailArray = [];
        var allJournalObjects = this.allObjects;
        var totalJournal = allJournalObjects.length;
        for (var i = 0; i < totalJournal; i++) {
            if (ID == allJournalObjects[i].ID) {
                journalDetailArray = allJournalObjects[i];
                break;
            }
        }

        return journalDetailArray;
    },
    setJournalObjectValue: function (journalDetail){
        selectedJournalID = journalDetail.ID;
        $("#license_plate_no").val(journalDetail.license_plate_no);
        $("#paying_date").val(journalDetail.paying_date);
        $("#journal_shift").val(journalDetail.journal_shift);
        $("#journal_shift").val(journalDetail.journal_shift);
        $("#operator_name").val(journalDetail.operator_name);
        $("#shift_rate").val(journalDetail.shift_rate);
        $("#fuel_cost").val(journalDetail.fuel_cost);
        $("#other_cost").val(journalDetail.other_cost);
        $("#cash_payment").val(journalDetail.cash_payment);
        $("#eftpos_shift_total").val(journalDetail.eftpos_shift_total);
        $("#docket").val(journalDetail.docket);
        $("#comment").val(journalDetail.comment);
    },
    fnFormatDetails:function ( oTable, nTr ) {
        var aData = oTable.fnGetData( nTr );
        console.dir(aData);
        var item_id = cuadroCommonMethods.getItemID(aData[1]);
        var aData = this.getJournalDetailFromID(item_id);

        var total_expanse = parseInt(allJournalObjects[i].shift_rate) + parseInt(allJournalObjects[i].fuel_cost) + parseInt(allJournalObjects[i].other_cost);
        var total_income = parseInt(allJournalObjects[i].cash_payment) + parseInt(allJournalObjects[i].eftpos_shift_total) + parseInt(allJournalObjects[i].docket);
        var gross_profit = total_income - total_expanse;

        var sOut = '<div class="col-sm-12">';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>License Plate No:</td><td>'+aData.license_plate_no+'</td></tr>';
        sOut += '<tr><td>Date:</td><td>'+aData.paying_date+'</td></tr>';
        sOut += '<tr><td>Shift:</td><td>'+aData.Shift+'</td></tr>';
        sOut += '<tr><td>Operator name:</td><td>'+aData.operator_name+'</td></tr>';
        sOut += '<tr><td>Shift Rate (AU$):</td><td>'+aData.shift_rate+'</td></tr>';
        sOut += '<tr><td>Fuel Cost (AU$):</td><td>'+aData.fuel_cost+'</td></tr>';
        sOut += '<tr><td>Other Cost (AU$):</td><td>'+aData.other_cost+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Cash Payment (AU$):</td><td>'+aData.cash_payment+'</td></tr>';
        sOut += '<tr><td>Eftpos Shift Total (AU$):</td><td>'+aData.eftpos_shift_total+'</td></tr>';
        sOut += '<tr><td>docket (AU$):</td><td>'+aData.docket+'</td></tr>';
        sOut += '<tr><td>Total Expense (AU$):</td><td>'+total_expanse+'</td></tr>';
        sOut += '<tr><td>Total Income (AU$):</td><td>'+total_income+'</td></tr>';
        sOut += '<tr><td>Gross Profit (AU$):</td><td>'+gross_profit+'</td></tr>';
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
    initJournalPage: function() {
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img src="<?php echo base_url()?>application/views/img/details_open.png">';
        nCloneTd.className = "center";

        $('#journal_list thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );

        $('#journal_list tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#journal_list').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $(document).on('click','#journal_list tbody td img',function () {
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
                oTable.fnOpen( nTr, journalObject.fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
    }
}

function searchJournal() {
    var start_date = $("#journalStart").val();
    var end_date = $("#journalEnd").val();
    var serverURL = "<?php echo site_url('Journal/getAllJournalDetailWithDateRange?journalStart=')?>" + start_date + "&journalEnd=" + end_date;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'searchJournal', function(data){
//            $('#journal_list').dataTable().fnClearTable();
        console.dir(data.result.result);
        journalObject.allObjects = data.result.result;
        $('#journal_list_wrapper').remove();
        var temp = '<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered tb_roster_paying" id="journal_list">' +
            '<thead>' +
            '<tr>' +
            '<th>Date</th>' +
            '<th>Shift</th>' +
            '<th>Taxi #</th>' +
            '<th>Operator name</th>' +
            '<th>Shift Rate</th>' +
            '<th>Fuel Cost</th>' +
            '<th>Other Cost</th>' +
            '<th>Cash</th>' +
            '<th>Eftpos Shift Total</th>' +
            '<th>Docket</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody></tbody></table>';
        $(".adv-table").append(temp);
        journalObject.populateJournalList();
        journalObject.initJournalPage();
    });
}

function updateJournalList () {
    var serverURL = "<?php echo site_url('Journal/getAllJournalDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateJournalList', function(data){
//            $('#journal_list').dataTable().fnClearTable();
            console.dir(data.result.result);
        journalObject.allObjects = data.result.result;
        journalObject.populateJournalList();
        journalObject.initJournalPage();
    });
}

function viewJournalDetail(journalID){
    cuadroCommonMethods.resetModal("journalDetailForm");
    var journalDetail = journalObject.getJournalDetailFromID(journalID);
    journalObject.setJournalObjectValue(journalDetail);
    $('form#journalDetailForm').attr('action', "<?php echo site_url('Journal/updateJournal?journal_id=')?>" + selectedJournalID);
    $("#journalDetailModal h4.modal-title").html("Update Journal Information");
    $("#journal_submit_button").html("Update Journal Information");
    $("#journalDetailModal").modal('show');
}

function addNewJournal() {
    cuadroCommonMethods.resetModal("journalDetailForm");
    $('form#journalDetailForm').attr('action', "<?php echo site_url('Journal/addJournal')?>");
    $("#journalDetailModal h4.modal-title").html("Driver Daily Journal");
    $("#journal_submit_button ").html("Add New Journal Information");
    $("#journalDetailModal").modal('show');
}

function deleteJournalDetail(journalID){
    var serverURL = "<?php echo site_url('Journal/removeJournal?journal_id=')?>" + journalID;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            $('#journal_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered tb_roster_paying" id="journal_list">' +
                '<thead>' +
                '<tr>' +
                '<th>Date</th>' +
                '<th>Shift</th>' +
                '<th>Taxi #</th>' +
                '<th>Operator name</th>' +
                '<th>Shift Rate</th>' +
                '<th>Fuel Cost</th>' +
                '<th>Other Cost</th>' +
                '<th>Cash</th>' +
                '<th>Eftpos Shift Total</th>' +
                '<th>Docket</th>' +
				'<th>Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateJournalList();
        }
    });
}

$("#journal_submit_button").click(function(e) {
    $("form#journalDetailForm").submit();
});

$("form#journalDetailForm").submit(function(e){
    e.preventDefault(); //STOP default action
    console.log('form submit');
    $("#journalDetailModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    console.log(postData);
    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'journalDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            $('#journal_list_wrapper').remove();
            var temp = '<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered tb_roster_paying" id="journal_list">' +
                '<thead>' +
                '<tr>' +
                '<th>Date</th>' +
                '<th>Shift</th>' +
                '<th>Taxi #</th>' +
                '<th>Operator name</th>' +
                '<th>Shift Rate</th>' +
                '<th>Fuel Cost</th>' +
                '<th>Other Cost</th>' +
                '<th>Cash</th>' +
                '<th>Eftpos Shift Total</th>' +
                '<th>Docket</th>' +
				'<th>Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody></tbody></table>';
            $(".adv-table").append(temp);
            updateJournalList();
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();

    });
});

$("#journalStart").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#journalEnd").datepicker({
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
updateJournalList();
</script>