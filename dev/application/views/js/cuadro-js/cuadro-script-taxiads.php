<script>
var selectedTaxiAdsID = 0;
var oTable = '';
var taxiAdsObject = {
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
    populateTaxiAdsList: function(){
        var allTaxiAdsObjects = this.allObjects;
        var totalTaxiAds = allTaxiAdsObjects.length;
		
		oTable.fnClearTable();
		for (var i = 0; i < totalTaxiAds; i++) {
			oTable.fnAddData([
				'<img src="<?php echo base_url()?>application/views/img/details_open.png">',
				allTaxiAdsObjects[i].license_plate_no+'<span style="display: none">td_item_id'+allTaxiAdsObjects[i].license_plate_no+'td_item_id</span>',
				allTaxiAdsObjects[i].days,
				$.datepicker.formatDate("D, d M yy", new Date((allTaxiAdsObjects[i].shift_end))),
				$.datepicker.formatDate("D, d M yy", new Date((allTaxiAdsObjects[i].shift_start))),
				allTaxiAdsObjects[i].lease_rate,
                '<a data-toggle="modal" class="edit" title="" onclick="viewTaxiAdsDetail('+allTaxiAdsObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                '<a data-toggle="modal" class="remove" title="" onclick="deleteTaxiAdsDetail('+allTaxiAdsObjects[i].ID+')" ><i class="ico-close"></i></a>'
			]);
		}
		$("#taxiads_list tbody tr").addClass('gradeA');
    },
    getTaxiAdsDetailFromID: function (ID) {
        var taxiAdsDetailArray = [];
        var allTaxiAdsObjects = this.allObjects;
        var totalTaxiAds = allTaxiAdsObjects.length;
        for (var i = 0; i < totalTaxiAds; i++) {
            if (ID == allTaxiAdsObjects[i].license_plate_no) {
                taxiAdsDetailArray = allTaxiAdsObjects[i];
                break;
            }
        }

        return taxiAdsDetailArray;
    },
    getTaxiAdsDetailFromLicense: function (license_plate_no) {
        var taxiAdsDetailArray = [];
        var allTaxiAdsObjects = this.allObjects;
        var totalTaxiAds = allTaxiAdsObjects.length;
        for (var i = 0; i < totalTaxiAds; i++) {
            if (license_plate_no == allTaxiAdsObjects[i].license_plate_no) {
                taxiAdsDetailArray = allTaxiAdsObjects[i];
                break;
            }
        }

        return taxiAdsDetailArray;
    },
    setTaxiAdsObjectValue: function (taxiAdsDetail){
        selectedTaxiAdsID = taxiAdsDetail.ID;
        $("#taxi_id").val(taxiAdsDetail.taxi_id);
        $("#days").val(taxiAdsDetail.days);
        $("#shift_end").val(taxiAdsDetail.shift_end);
        $("#shift_start").val(taxiAdsDetail.shift_start);
        $("#lease_rate").val(taxiAdsDetail.lease_rate);
        $("#comment").val(taxiAdsDetail.comment);
    },
    fnFormatDetails:function ( oTable, nTr ) {
        var aData = oTable.fnGetData( nTr );
        var item_id = cuadroCommonMethods.getItemID(aData[1]);
        var aData = this.getTaxiAdsDetailFromID(item_id);

        var sOut = '<div class="adv-table col-sm-12">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td width="20%">Taxi License Plate No:</td><td>'+aData.license_plate_no+'</td></tr>';
        sOut += '<tr><td>Days:</td><td>'+aData.days+'</td></tr>';
        sOut += '<tr><td>Shift End:</td><td>'+aData.shift_end+'</td></tr>';
        sOut += '<tr><td>Shift Start:</td><td>'+aData.shift_start+'</td></tr>';
        sOut += '<tr><td>Lease Rate:</td><td>'+aData.lease_rate+'</td></tr>';
        sOut += '<tr><td><strong>Comment:</strong></td><td>'+aData.comment+'</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        return sOut;
    },
    initTaxiAdsPage: function() {
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        oTable = $('#taxiads_list').dataTable( {
			"aoColumns": [
				null,
				null,
				null,
				null,
				null,
				null,
				{ "sClass": "action_button"}
			],      
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
			],
            "aaSorting": [[1, 'asc']]
        });
		
		/* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $(document).on('click','#taxiads_list tbody td img',function () {
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
                oTable.fnOpen( nTr, taxiAdsObject.fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
    }
}

function initTaxiAdsList () {
    var serverURL = "<?php echo site_url('Ads/getAllAdsDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateTaxiAdsList', function(data){
        taxiAdsObject.allObjects = data.result.result;
		taxiAdsObject.initTaxiAdsPage();
        taxiAdsObject.populateTaxiAdsList();
        
    });
}

function updateTaxiAdsList () {
    var serverURL = "<?php echo site_url('Ads/getAllAdsDetail')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'updateTaxiAdsList', function(data){
        taxiAdsObject.allObjects = data.result.result;
        taxiAdsObject.populateTaxiAdsList();
    });
}

function viewTaxiAdsDetail(taxiAdsID){
    cuadroCommonMethods.resetModal("taxiAdsDetailForm");
    var taxiAdsDetail = taxiAdsObject.getTaxiAdsDetailFromID(taxiAdsID);
    taxiAdsObject.setTaxiAdsObjectValue(taxiAdsDetail);
    $("#taxiAdsDetailModal h4.modal-title").html("Update Taxi Ads Information");
    $("#taxiads_submit_button").html("Update Taxi Ads Information");
    $("#taxiAdsDetailModal").modal('show');
}

function addNewTaxiAds() {
    var serverURL = "<?php echo site_url('Ads/canAddMoreTaxiAds')?>";

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', addNewTaxiAds, function(data){
        if (data.error['code'] == 0) {
            cuadroCommonMethods.resetModal("taxiAdsDetailForm");
            $("#taxiAdsDetailModal h4.modal-title").html("Add New Taxi Ads Information");
            $("#taxiads_submit_button ").html("Add New Taxi Ads Information");
            $("#taxiAdsDetailModal").modal('show');
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        }
    });
}

function deleteTaxiAdsDetail(taxiAdsID){
    var serverURL = "<?php echo site_url('Ads/removeTaxiAds?taxiads_id=')?>" + taxiAdsID;

    cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
        if (data.error['code'] == 0) {
            updateTaxiAdsList();
        }
    });
}

$("#taxiads_submit_button").click(function(e) {
    $("form#taxiAdsDetailForm").submit();
});

$("form#taxiAdsDetailForm").submit(function(e){
    console.log('form submit');
    $("#taxiAdsDetailModal").modal('hide');
    var postData = $(this).serializeArray();
    var formURL = $("#taxiads_submit_button").html() == "Add New Taxi Ads Information" ? "<?php echo site_url('Ads/addTaxiAds')?>" : "<?php echo site_url('Ads/updateTaxiAds?taxiads_id=')?>" + selectedTaxiAdsID;

    cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'taxiAdsDetailFormSubmit', function(data){
        if (data.error['code'] == 0) {
            updateTaxiAdsList();
        } else if (data.error['code'] == 208) {
            cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
        } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
        }
//            $(".registrationLoaderBox").hide();
    });
    e.preventDefault(); //STOP default action
});

$("#shift_start").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });

$("#shift_end").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
})
    .on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
	
initTaxiAdsList();
taxiAdsObject.getTaxiList();
</script>