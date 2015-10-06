<script>
    $( ".car_type" ).autocomplete({
        source: globalStaticData.carType
    });

    $( ".car_style" ).autocomplete({
        source: globalStaticData.carStyle
    });

    $(".car_manufacturer").autocomplete({
        source: globalStaticData.carManufacturer
    });

    $(".fuel_type").autocomplete({
        source: globalStaticData.fuelType
    });

    var selectedTaxiID = 0;
    var taxiObject = {
        allObjects: [],
        populateTaxiList: function(){
            var allTaxiObjects = this.allObjects;
            var totalTaxi = allTaxiObjects.length;
            var taxiListString = '';
            for (var i = 0; i < totalTaxi; i++) {
                taxiListString += '<tr class="gradeA">';
                taxiListString += '<td>'+allTaxiObjects[i].license_plate_no+'<span style="display: none">td_item_id'+allTaxiObjects[i].ID+'td_item_id</span> </td>';
                taxiListString += '<td>'+allTaxiObjects[i].taxi_network+'</td>';
                taxiListString += '<td>'+allTaxiObjects[i].car_type+'</td>';
                taxiListString += '<td>'+allTaxiObjects[i].car_style+'</td>';
                taxiListString += '<td>'+allTaxiObjects[i].fuel_type+'</td>';
                taxiListString += '<td>'+allTaxiObjects[i].kilometres+'</td>';
                taxiListString += '<td>'+allTaxiObjects[i].insurance_due_date+'</td>';
                taxiListString += '<td class="action_button">' +
                    '<a data-toggle="modal" class="edit" title="" onclick="viewTaxiDetail('+allTaxiObjects[i].ID+')" ><i class="ico-pencil"></i></a>' +
                    '<a data-toggle="modal" class="remove" title="" onclick="deleteTaxiDetail('+allTaxiObjects[i].ID+')" ><i class="ico-close"></i></a>' +
                    '</td>';
                taxiListString += '</tr>';
            }

            $("#taxi_list tbody").html(taxiListString);
        },
        getTaxiDetailFromID: function (ID) {
            var taxiDetailArray = [];
            var allTaxiObjects = this.allObjects;
            var totalTaxi = allTaxiObjects.length;
            var taxiListString = '';
            for (var i = 0; i < totalTaxi; i++) {
                if (ID == allTaxiObjects[i].ID) {
                    taxiDetailArray = allTaxiObjects[i];
                    break;
                }
            }

            return taxiDetailArray;
        },
        getTaxiDetailFromLicense: function (license_plate_no) {
            var taxiDetailArray = [];
            var allTaxiObjects = this.allObjects;
            var totalTaxi = allTaxiObjects.length;
            var taxiListString = '';
            for (var i = 0; i < totalTaxi; i++) {
                if (license_plate_no == allTaxiObjects[i].license_plate_no) {
                    taxiDetailArray = allTaxiObjects[i];
                    break;
                }
            }

            return taxiDetailArray;
        },
        setTaxiObjectValue: function (taxiDetail){
            selectedTaxiID = taxiDetail.ID;
            $("#taxi_network").val(taxiDetail.taxi_network);
            $("#license_plate_no").val(taxiDetail.license_plate_no);
            $("#car_type").val(taxiDetail.car_type);
            $("#car_style").val(taxiDetail.car_style);
            $("#fuel_type").val(taxiDetail.fuel_type);
            $("#car_manufacturer").val(taxiDetail.car_manufacturer);
            $("#year_manufacturerd").val(taxiDetail.year_manufacturerd);
            $("#kilometres").val(taxiDetail.kilometres);
            $("#plate_fee").val(taxiDetail.plate_fee);
            $("#network_fee").val(taxiDetail.network_fee);
            $("#insurance_fee").val(taxiDetail.insurance_fee);
            $("#car_finance_fee").val(taxiDetail.car_finance_fee);
            $("#registration_fee").val(taxiDetail.registration_fee);
            $("#registration_due_date").val(taxiDetail.registration_due_date);
            $("#insurance_due_date").val(taxiDetail.insurance_due_date);
            $("#comment").val(taxiDetail.comment);
        },
        fnFormatDetails:function ( oTable, nTr ) {
            var aData = oTable.fnGetData( nTr );
            var item_id = cuadroCommonMethods.getItemID(aData[1]);
            var aData = this.getTaxiDetailFromID(item_id);

            var sOut = '<div class="col-sm-12">';
            sOut += '<div class="adv-table col-sm-6">';
            sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
            sOut += '<tr><td>Network:</td><td>'+aData.taxi_network+'</td></tr>';
            sOut += '<tr><td>Taxi License Plate No:</td><td>'+aData.license_plate_no+'</td></tr>';
            sOut += '<tr><td>Car Type:</td><td>'+aData.car_type+'</td></tr>';
            sOut += '<tr><td>Car Style:</td><td>'+aData.car_style+'</td></tr>';
            sOut += '<tr><td>Fuel Type:</td><td>'+aData.fuel_type+'</td></tr>';
            sOut += '<tr><td>Car Manufacturer:</td><td>'+aData.car_manufacturer+'</td></tr>';
            sOut += '<tr><td>Year of Manufacturer:</td><td>'+aData.year_manufacturerd+'</td></tr>';
            sOut += '<tr><td>Kilometres:</td><td>'+aData.kilometres+'</td></tr>';
            sOut += '</table>';
            sOut += '</div>';
            sOut += '<div class="adv-table col-sm-6">';
            sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
            sOut += '<tr><td>Plate Fee (AU$):</td><td>'+aData.plate_fee+'</td></tr>';
            sOut += '<tr><td>Network Fee (AU$):</td><td>'+aData.network_fee+'</td></tr>';
            sOut += '<tr><td>Insurance Fee (AU$):</td><td>'+aData.insurance_fee+'</td></tr>';
            sOut += '<tr><td>Car Finance Fee (AU$):</td><td>'+aData.car_finance_fee+'</td></tr>';
            sOut += '<tr><td>Registration Fee (AU$):</td><td>'+aData.registration_fee+'</td></tr>';
            sOut += '<tr><td>Registration Due Date:</td><td>'+aData.registration_due_date+'</td></tr>';
            sOut += '<tr><td>Insurance Due Date:</td><td>'+aData.insurance_due_date+'</td></tr>';
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
        initTaxiPage: function() {
            /*
             * Insert a 'details' column to the table
             */
            var nCloneTh = document.createElement( 'th' );
            var nCloneTd = document.createElement( 'td' );
            nCloneTd.innerHTML = '<img src="<?php echo base_url()?>application/views/img/details_open.png">';
            nCloneTd.className = "center";

            $('#taxi_list thead tr').each( function () {
                this.insertBefore( nCloneTh, this.childNodes[0] );
            } );

            $('#taxi_list tbody tr').each( function () {
                this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
            } );

            /*
             * Initialse DataTables, with no sorting on the 'details' column
             */
            var oTable = $('#taxi_list').dataTable( {
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0 ] }
                ],
                "aaSorting": [[1, 'asc']]
            });

            /* Add event listener for opening and closing details
             * Note that the indicator for showing which row is open is not controlled by DataTables,
             * rather it is done here
             */
            $(document).on('click','#taxi_list tbody td img',function () {
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
                    oTable.fnOpen( nTr, taxiObject.fnFormatDetails(oTable, nTr), 'details' );
                }
            } );
        }
    }

    function updateTaxiList () {
        var serverURL = "<?php echo site_url('Taxi/getAllTaxiDetail')?>";

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', updateTaxiList, function(data){
//            $('#taxi_list').dataTable().fnClearTable();
//            console.dir(data);
            taxiObject.allObjects = data.result.result;
            taxiObject.populateTaxiList();
            taxiObject.initTaxiPage();
        });
    }

    function viewTaxiDetail(taxiID){
        cuadroCommonMethods.resetModal("taxiDetailForm");
        var taxiDetail = taxiObject.getTaxiDetailFromID(taxiID);
        taxiObject.setTaxiObjectValue(taxiDetail);
        $("#taxiDetailModal h4.modal-title").html("Update Taxi Information");
        $("#taxi_submit_button").html("Update Taxi Information");
        $("#taxiDetailModal").modal('show');
    }

    function addNewTaxi() {
        var serverURL = "<?php echo site_url('Taxi/canAddMoreTaxi')?>";

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', addNewTaxi, function(data){
            if (data.error['code'] == 0) {
                cuadroCommonMethods.resetModal("taxiDetailForm");
                $("#taxiDetailModal h4.modal-title").html("Add New Taxi Information");
                $("#taxi_submit_button ").html("Add New Taxi Information");
                $("#taxiDetailModal").modal('show');
            } else if (data.error['code'] == 208) {
                cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
            }
        });
    }

    function deleteTaxiDetail(taxiID){
        var serverURL = "<?php echo site_url('Taxi/removeTaxi?taxi_id=')?>" + taxiID;

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', updateTaxiList, function(data){
            if (data.error['code'] == 0) {
                $('#taxi_list_wrapper').remove();
                var temp = '<table id="taxi_list" cellpadding="0" cellspacing="0" border="0"' +
                    'class="dynamic-table display table table-bordered tb_roster_paying"' +
                    'id="hidden-table-info">' +
                    '<thead><tr>' +
                    '<th>Taxi #</th>' +
                    '<th>Taxi Network</th>' +
                    '<th>Car type</th>' +
                    '<th>Car Style</th>' +
                    '<th>Fuel type</th>' +
                    '<th>Kilometres (Circle one)</th>' +
                    '<th>Insurance Due Date</th>' +
                    '<th>Action</th>' +
                    '</tr></thead><tbody></tbody></table>';
                $(".adv-table").append(temp);
                updateTaxiList();
            }
        });
    }

    $("#taxi_submit_button").click(function(e) {
        $("form#taxiDetailForm").submit();
    });

    $("form#taxiDetailForm").submit(function(e){
        console.log('form submit');
        $("#taxiDetailModal").modal('hide');
        var postData = $(this).serializeArray();
        var formURL = $("#taxi_submit_button").html() == "Add New Taxi Information" ? "<?php echo site_url('Taxi/addTaxi')?>" : "<?php echo site_url('Taxi/updateTaxi?taxi_id=')?>" + selectedTaxiID;

        cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'loginSubmit', function(data){
            if (data.error['code'] == 0) {
                $('#taxi_list_wrapper').remove();
                var temp = '<table id="taxi_list" cellpadding="0" cellspacing="0" border="0"' +
                    'class="dynamic-table display table table-bordered tb_roster_paying"' +
                    'id="hidden-table-info">' +
                    '<thead><tr>' +
                    '<th>Taxi #</th>' +
                    '<th>Taxi Network</th>' +
                    '<th>Car type</th>' +
                    '<th>Car Style</th>' +
                    '<th>Fuel type</th>' +
                    '<th>Kilometres (Circle one)</th>' +
                    '<th>Insurance Due Date</th>' +
                    '<th>Action</th>' +
                    '</tr></thead><tbody></tbody></table>';
                $(".adv-table").append(temp);
                updateTaxiList();
            } else if (data.error['code'] == 208) {
                cuadroCommonMethods.showModalView("subscriptionUpdateNeeded");
            } else {
//                cuadroCommonMethods.showGeneralPopUp('Error!!!', data.error['description'], false);
            }
//            $(".registrationLoaderBox").hide();
        });
        e.preventDefault(); //STOP default action
    });

    $("#registration_due_date").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    })
        .on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

    $("#insurance_due_date").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    })
        .on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    updateTaxiList();
</script>