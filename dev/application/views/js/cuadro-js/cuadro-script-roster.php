<style>
.tableRowColor {
	background-color: #f9f9f9;
}

.tableHiddenRowColor {
    background: #eeeeee;
}
</style>

<script>
	var MAX_PAGES = 5;
	
	var gTaxiList = [];
	
	var gCurrentData = null;
	
	var gSearchDebounce = false;
	
	var gTableData = {
		page : 1,
		pageNumber : 0,
		pageSize : 10,
		taxiID : null,
		count: 0,
		from : 0,
		dateFrom : null,
		dateTo : null,
		sortField : null,
		sort : null,
		search : null
	};
	
	function getPageNext() {
		var firstPaginatorNum =  parseInt($("#previewTableFooter2 nav ul li:eq(1)").children().text());
		var page = parseInt($("#previewTableFooter2 nav ul li.active a").text()) + 1;
		
		if(page == firstPaginatorNum + MAX_PAGES)
			getPage(page, true);
		else
			getPage(page, false);		
	}
	
	function getPagePrevious() {
		var firstPaginatorNum =  parseInt($("#previewTableFooter2 nav ul li:eq(1)").children().text());
		var page = parseInt($("#previewTableFooter2 nav ul li.active a").text()) - 1;
		
		if(page < firstPaginatorNum) {
			getPage(page, true);
		} else {
			getPage(page, false);	
		}			
	}
	
    function getPage(page, redrawPagination) {
		gTableData.page = page;
		gTableData.from = (page - 1)*gTableData.pageSize;
		
		//$.post( "/dev/index.php/Roster/getRosters", gTableData, function( data ) {
		$.post( "<?php echo site_url('Roster/getRosters')?>", gTableData, function( data ) {
		
			console.log(JSON.stringify(data.time));
			
			//console.log(JSON.stringify(data).length);
			gCurrentData = data.data;
			gTableData.count = data.count;
			
			/* no data */
			if(!data.data.length) {
				$("#previewTable tbody").html("<tr class='tableRowColor'><td colspan='10'><p class='text-center'>No data available in the table</p></td></tr>");
				$("#previewTableFooter1").html('');
				$("#previewTableFooter2").html('');
				return;
			}
			
			var tableData = "";
			$.each(data.data, function(i, entry) {
				var date = new Date(parseInt(entry.paying_date)*1000);
			
				var balance = parseInt(entry.amount_paid) - parseInt(entry.mf_amount) - parseInt(entry.m7_amount) - parseInt(entry.cash_amount) - parseInt(entry.fine_toll_amount) - parseInt(entry.expenses);
				
				var plate = null;
           		$.each(gTaxiList, function(i, e) { 
					if(e.id == entry.taxi_id) {
						plate = e.plate;
						return false;
					}
				});
				
				tableData = tableData +
				"<tr class='" + ((i % 2 == 0) ? "tableRowColor" : "") + "'>" +
				"<td><button id='moreButton" + i + "' class='btn btn-white btn-xs' onclick=toggleMoreButton('" + i + "') >More</button></td>" +
				"<td>" + plate + "</td>" +
				"<td>" + $.datepicker.formatDate("D, d M yy", date) + "</td>" +
				"<td>" + entry.shift + "</td>" +
				"<td>" + (parseInt(entry.is_leased) ? 'Yes' : 'No') + "</td>" +
				"<td>" + entry.driver_name + "</td>" +
				"<td>" + (parseInt(entry.is_paid) ? 'Yes' : 'No') + "</td>" +
				"<td>" + entry.amount_paid + "</td>" +
				"<td>" + balance + "</td>" +
				"<td class='action_button'>" +
				'<a data-toggle="modal" class="edit" title="" onclick="updateRoster('+entry.ID+')" ><i class="ico-pencil"></i></a>'+ 
				'<a data-toggle="modal" class="remove" title="" onclick="deleteRoster('+entry.ID+')" ><i class="ico-close"></i></a>' +
				"</td>" +
				"</tr>"+
				
				"<tr id='moreRow" + i + "' class='hidden tableHiddenRowColor'><td colspan='10'>" + hiddenDetailsFormat(entry) + "</td></tr>";			
			});
			
			$("#previewTable tbody").empty();
			$("#previewTable tbody").html(tableData);
			
			/* set footer text */
			$("#previewTableFooter1").html("Showing " + ( gTableData.from + 1) + " to " + (gTableData.from + data.data.length) + " of " + gTableData.count + " entries");
			
			setPagination(redrawPagination);
		});
	}
	
	function setPagination(redraw) {
		if(redraw){
			gTableData.pageNumber = (Math.floor(gTableData.count/gTableData.pageSize) < gTableData.count/gTableData.pageSize) ? 
				Math.floor(gTableData.count/gTableData.pageSize) + 1 : 
					Math.floor(gTableData.count/gTableData.pageSize);
		
			var startPage = gTableData.page;
			var endPage = MAX_PAGES;
		
			if(gTableData.pageNumber < MAX_PAGES) {
				startPage = 1;
				endPage = gTableData.pageNumber;
			} else if(gTableData.pageNumber - gTableData.page < MAX_PAGES) {
				startPage = gTableData.pageNumber - MAX_PAGES + 1;	
			}
			
			var html = 
				"<nav class=\"pull-right\">" +
					"<ul class=\"pagination\">" +
						"<li><a onclick='getPagePrevious()'>Previous</a></li>";
		
			for (var i = startPage; i < startPage + endPage; i++) {
				html = html + "<li><a onclick='getPage(" + i +", false)'>" + i + "</a></li>";
			}
		
			html = html +		
						"<li><a onclick='getPageNext()'>Next</a></li>" +
					"</ul>" +
				"</nav>";
			
			$("#previewTableFooter2").html(html);	
		}
		
		$("#previewTableFooter2 nav ul li").removeClass("active");
		$("#previewTableFooter2 nav ul li > a:contains('" + gTableData.page + "')").parents().addClass("active");

		if(gTableData.page == 1)
			$("#previewTableFooter2 nav ul li > a:contains('Previous')").addClass("hidden");
		else 
			$("#previewTableFooter2 nav ul li > a:contains('Previous')").removeClass("hidden");
			
		if(gTableData.page == gTableData.pageNumber)
			$("#previewTableFooter2 nav ul li > a:contains('Next')").addClass("hidden");
		else 
			$("#previewTableFooter2 nav ul li > a:contains('Next')").removeClass("hidden");
	}
	
	function toggleMoreButton(i) {
		if($("#moreRow"+i).hasClass("hidden")) {
			$("#moreRow"+i).removeClass("hidden");
			$("#moreButton"+i).html("Close");
		} else {
			$("#moreRow"+i).addClass("hidden");
			$("#moreButton"+i).html("More");
		}
	}
	
	function hiddenDetailsFormat(entry) {
		var date = new Date(parseInt(entry.paying_date)*1000);
		
		var plate = null;
        $.each(gTaxiList, function(i, e) { 
			if(e.id == entry.taxi_id) {
				plate = e.plate;
				return false;
			}
		});
		
        return '<div class="col-sm-12">' +
			'<div class="adv-table col-sm-6">' +
			'<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">' +
			'<tr><td>Taxi License Plate No:</td><td>'+plate+'</td></tr>' +
			'<tr><td>Date:</td><td>'+$.datepicker.formatDate("D, d M yy", date)+'</td></tr>' +
			'<tr><td>Shift:</td><td>'+entry.shift+'</td></tr>' +
			'<tr><td>Leased:</td><td>'+(parseInt(entry.is_leased) ? 'Yes' : 'No')+'</td></tr>' +
			'<tr><td>Driver Name:</td><td>'+entry.driver_name+'</td></tr>' +
			'<tr><td>Paid:</td><td>'+(parseInt(entry.is_paid) ? 'Yes' : 'No')+'</td></tr>' +
			'</table>' +
			'</div>' +
			'<div class="adv-table col-sm-6">' +
			'<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">' +
			'<tr><td>Amount Paid (AU$):</td><td>'+entry.amount_paid+'</td></tr>' +
			'<tr><td>MF (AU$):</td><td>'+entry.mf_amount+'</td></tr>' +
			'<tr><td>M7 (AU$):</td><td>'+entry.m7_amount+'</td></tr>' +
			'<tr><td>Cash (AU$):</td><td>'+entry.cash_amount+'</td></tr>' +
			'<tr><td>Fine/Toll (AU$):</td><td>'+entry.fine_toll_amount+'</td></tr>' +
			'<tr><td>Expenses (AU$):</td><td>'+entry.expenses+'</td></tr>' +
			'</table>' +
			'</div>' +
			'</div>' +
			'<div class="col-sm-12">' +
			'<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">' +
			'<tr><td><strong>Comment:</strong> '+entry.comment+'</td></tr>' +
			'</table>' +
			'</div>';
    }
	
	function sort(field, col) {
		gTableData.sortField = field;
		
		var sortIcon = 'fa-sort-down';
		gTableData.sort = 'DESC';
		if($("#previewTable thead tr th:eq(" + col + ") span").hasClass('fa-sort-down')) {
			sortIcon = 'fa-sort-up';
			gTableData.sort = 'ASC';
		} 
		
		$("#previewTable thead tr th span").removeClass('fa-sort-down');
		$("#previewTable thead tr th span").removeClass('fa-sort-up');
		$("#previewTable thead tr th span").addClass('fa-sort');
		$("#previewTable thead tr th:eq(" + col + ") span").addClass(sortIcon);
		
		filterGeneral();
	}
	
	function setRowsNumer() {
		gTableData.pageSize = $("#previewTableRowNumber").val();
		filterGeneral();
	}
	
	function filterWeek() {
		/* when option None */
		gTableData.dateFrom = null;
		gTableData.dateTo = null;
		
		/* when option not None*/
		if($("#filterWeek option:selected").attr("from") != '' && $("#filterWeek option:selected").attr("to") != '') {
			gTableData.dateFrom = $("#filterWeek option:selected").attr("from");
			gTableData.dateTo = $("#filterWeek option:selected").attr("to");
		} 
		
		/* reset fields */
		$("#filterDateFrom").val('');
		$("#filterDateTo").val('');
		
		filterGeneral();
	}
	
	function filterTaxi() {
		/* when option All */
		gTableData.taxiID = null;
		
		/* when option not All */
		if($("#filterTaxi").val() != '') 
			gTableData.taxiID = $("#filterTaxi").val();
			
		filterGeneral();
		
	}
	
	function filterSearch() {
		if(gSearchDebounce)
			return;
		
		gSearchDebounce = true;
		setTimeout(function() {
			gSearchDebounce = false;
			filterGeneral();
		}, 500);
	}
	
	function filterGeneral() {
		/* look for taxi ids in general search (filterTaxi is All) */
		if($("#filterTaxi").val() == '' && $("#filterGeneral").val() != '') {
			gTableData.taxiID = [];
		
           	$.each(gTaxiList, function(i, e) { 
				if(e.plate.indexOf($("#filterGeneral").val()) != -1) {
					gTableData.taxiID.push(e.id);
				}
			});
		}
		
		/* filterTaxi already contains search criteria */
		if($("#filterTaxi").val() != '' && $("#filterTaxi  option:selected").text().indexOf($("#filterGeneral").val()) != -1) 
			gTableData.search = '';
		else 
			gTableData.search = $("#filterGeneral").val();	
			
		getPage(1, true);
	}
	
	$(document).ready(function () {
		$('#filterDateFrom').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true
		}).on('changeDate', function (ev) {
			$(this).datepicker('hide');
			
			if($("#filterWeek").val() != "None") {
				$("#filterWeek").val("None");
				gTableData.dateTo = null;
			}
		
			var filterFrom = new Date(ev.date);
			gTableData.dateFrom = filterFrom.getTime()/1000;
			filterGeneral();
		});
	
		$('#filterDateTo').datepicker({
			format: "dd/mm/yyyy",
			altFormat: '@',
			autoclose: true
		}).on('changeDate', function (ev) {
			$(this).datepicker('hide');
			
			if($("#filterWeek").val() != "None") {
				$("#filterWeek").val("None");
				gTableData.dateFrom = null;
			}
		
			var filterTo = new Date(ev.date);
			gTableData.dateTo = filterTo.getTime()/1000 + 86400;// ...+ 1 day(sec)
			filterGeneral();
		});
		
		$("#paying_date").datepicker({
			format: 'mm/dd/yyyy',
			autoclose: true,
			clearBtn: true,
			todayHighlight: true
		}).on('changeDate', function (ev) {
			$(this).datepicker('hide');
		});	
		
		/* set current week */
		var tmpNowDate = (new Date().getTime())/1000;
		$.each($("#filterWeek > option"), function() { 
			if( tmpNowDate > $(this).attr("from")) {
				$(this).attr('selected','selected');
				gTableData.dateFrom = $(this).attr("from");
				gTableData.dateTo = $(this).attr("to");
			} else {
				return false;
			}
		});
				
		cuadroServerAPI.getServerData('GET', "<?php echo site_url('Taxi/getAllTaxiDetail')?>", 'JSONp', '', function(data){
			if (data.result.result.length > 0){
				for (var total = 0; total < data.result.result.length; total++) {
					gTaxiList.push({
						id : data.result.result[total].ID,
						plate : data.result.result[total].license_plate_no
					});
					
					$("#filterTaxi").append(
						$('<option></option>').val(data.result.result[total].ID).html(data.result.result[total].license_plate_no)
					);
					
					$("#taxi_id").append(
						$('<option></option>').val(data.result.result[total].ID).html(data.result.result[total].license_plate_no)
					);
				}
			}
		});
		
		getPage(1, true);
	});	
	
	function updateRoster(rosterID){
		var roster = null;
		$.each(gCurrentData, function(i, entry) {
			if(entry.ID == rosterID) {
				roster = entry;
				return false;
			}
		});
		
		cuadroCommonMethods.resetModal("rosterDetailForm");
	
		$("#rosterDetailModalAlert").addClass("hidden");
	
		$('#taxi_id option[value='+roster.taxi_id+']').attr('selected','selected');
	
		$('#driver_name').val(roster.driver_name);
		
		var date = new Date(parseInt(roster.paying_date)*1000);
		$('#paying_date').val($.datepicker.formatDate("mm/dd/yy", date));

		if(roster.shift == 'Morning') {
			$('#shift_morning').click();
		} else {
			$('#shift_evening').click();
		}
	
		if(roster.is_leased == 0) {
			$('#is_leased_no').click();
		} else {
			$('#is_leased_yes').click();
		}
	
		if(roster.is_paid == 0) {
			$('#is_paid_no').click();
		} else {
			$('#is_paid_yes').click();
		}
		
		$('#amount_paid').val(roster.amount_paid);
		$('#mf_amount').val(roster.mf_amount);
		$('#m7_amount').val(roster.m7_amount);
		$('#cash_amount').val(roster.cash_amount);
		$('#fine_toll_amount').val(roster.fine_toll_amount);
		$('#expenses').val(roster.expenses);
		$('#comment').val(roster.comment);
		
		$('form#rosterDetailForm').attr('action', "<?php echo site_url('Roster/updateRoster?roster_id=')?>" + rosterID);
		$("#rosterDetailModal h4.modal-title").html("Update Roster Information");
		$("#roster_submit_button").html("Update Roster Information");
		$("#rosterDetailModal").modal('show');
	}

	function deleteRoster(rosterID){
		var serverURL = "<?php echo site_url('Roster/removeRoster?roster_id=')?>" + rosterID;
		$('#confirmationModal div.confirmationMessage').html("Are you sure you want to delete this roster item?");
		$('#confirmationModal').modal('show'); 
		$('#confirmDelete').click(function(e) {
			cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', '', function(data){
				if (data.error['code'] == 0) {
					getPage(gTableData.page, true);
				}
			});
		});
	}

	function addNewRoster() {
		cuadroCommonMethods.resetModal("rosterDetailForm");
    
		$("#rosterDetailModalAlert").addClass("hidden");
	
		$("#taxi_id").val($("#taxi_id option:first").val());
	
		$('#shift_morning').click();
		$('#shift_morning').val('Morning');
	
		$('#is_leased_no').click();
		$('#is_leased_no').val(0);
	
		$('#is_paid_no').click();
		$('#is_paid_no').val(0);
	
		$('form#rosterDetailForm').attr('action', "<?php echo site_url('Roster/addRoster')?>");
		$("#rosterDetailModal h4.modal-title").html("Add New Roster Information");
		$("#roster_submit_button ").html("Add New Roster Information");
		$("#rosterDetailModal").modal('show');
	}

	$("#roster_submit_button").click(function(e) {
		if($("form#rosterDetailForm")[0].checkValidity()) {
			$("form#rosterDetailForm").submit();
		} else {
			var field = "";
			$( 'form#rosterDetailForm :input[required]').each( function (idx, elem) {
				if ( $(elem).val() == '' ) {
					field = $(elem).parent().parent().find("label").text();
					return false;
				}
			});
	
			$("#rosterDetailModalAlert p").html("<b><i class='fa fa-exclamation-triangle'></i> " + field + "</b> field cannot be left empty!");
			$("#rosterDetailModalAlert").removeClass("hidden");
		}
	});

	$("form#rosterDetailForm").submit(function(e){
		e.preventDefault(); //STOP default action
		console.log('form submit');
		$("#rosterDetailModal").modal('hide');
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");

		cuadroServerAPI.postDataToServer(formURL, postData, 'JSONp', 'rosterDetailFormSubmit', function(data){
			if (data.error['code'] == 0) { 
				getPage(gTableData.page, true);
			} else {
				$('#warningModal div.confirmationMessage').html("Entry adding failed! Bad input parameters!");
				$('#warningModal').modal('show');
			}
		});
	});

</script>