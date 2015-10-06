function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<div class="col-sm-12">';
    sOut += '<div class="adv-table col-sm-6">';
    sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
    sOut += '<tr><td>Date:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Taxi Number:</td><td>5002</td></tr>';
    sOut += '<tr><td>Driver Name:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Shift:</td><td>Morning</td></tr>';
    sOut += '<tr><td>Leased:</td><td>yes</td></tr>';
    sOut += '<tr><td>Paid:</td><td>No</td></tr>';
    sOut += '<tr><td>Amount Paid (AUD):</td><td>$100</td></tr>';
    sOut += '</table>';
    sOut += '</div>';
    sOut += '<div class="adv-table col-sm-6">';
    sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
    sOut += '<tr><td>MF AU$:</td><td>$17.50</td></tr>';
    sOut += '<tr><td>M7 AU$:</td><td>$20.20</td></tr>';
    sOut += '<tr><td>Cash AU$:</td><td>$52.30</td></tr>';
    sOut += '<tr><td>Fine/ Toll AU$:</td><td>$3.50</td></tr>';
    sOut += '<tr><td>Expenses AU$:</td><td>$10</td></tr>';
    sOut += '<tr><td>Balance:</td><td>$76.50</td></tr>';
    sOut += '<tr><td>Comment:</td><td>And any further details here</td></tr>';
    sOut += '</table>';
    sOut += '</div>';
    sOut += '</div>';
    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );

    function rosterFormatDetails ( oTable, nTr )
    {
        var aData = oTable.fnGetData( nTr );
        var sOut = '<div class="col-sm-12">';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>Date:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
        sOut += '<tr><td>Taxi Number:</td><td><input type="text" value="5002" placeholder="Taxi Number"></td></tr>';
        sOut += '<tr><td>Driver Name:</td><td>Could provide a link here</td></tr>';
        sOut += '<tr><td>Shift:</td><td>Morning</td></tr>';
        sOut += '<tr><td>Leased:</td><td>yes</td></tr>';
        sOut += '<tr><td>Paid:</td><td>No</td></tr>';
        sOut += '<tr><td>Amount Paid (AUD):</td><td>$100</td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '<div class="adv-table col-sm-6">';
        sOut += '<table class="display table table-bordered " cellspacing="0" cellpadding="0" border="0" <thead="">';
        sOut += '<tr><td>MF AU$:</td><td>$17.50</td></tr>';
        sOut += '<tr><td>M7 AU$:</td><td>$20.20</td></tr>';
        sOut += '<tr><td>Cash AU$:</td><td>$52.30</td></tr>';
        sOut += '<tr><td>Fine/ Toll AU$:</td><td>$3.50</td></tr>';
        sOut += '<tr><td>Expenses AU$:</td><td>$10</td></tr>';
        sOut += '<tr><td>Balance:</td><td>$76.50</td></tr>';
        sOut += '<tr><td>Comment:</td><td>And any further details here</td></tr>';
        sOut += '<tr><td></td><td><input type="button" value="Update"></td></tr>';
        sOut += '</table>';
        sOut += '</div>';
        sOut += '</div>';
        return sOut;
    }

    $('#tb_roster_paying thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#tb_roster_paying tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#tb_roster_paying').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#tb_roster_paying tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, rosterFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );