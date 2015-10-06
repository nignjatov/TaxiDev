<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/serial.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/themes/light.js"></script>
<script>
    dashboardInit();

    var dashboardObject = {
        populateDashboardListTable: function(){
            $('#dashboard-data-table_wrapper').remove();
            var temp = '<table  class="display table table-bordered table-striped" id="dashboard-data-table">' +
                '<thead><tr>' +
                '<th>Taxi #</th>' +
                '<th>Plate Fee (AU$)</th>' +
                '<th>Network Finance (AU$)</th>' +
                '<th>Insurance Finance (AU$)</th>' +
                '<th>Car Finance (AU$)</th>' +
                '<th>Maintenance Cost (AU$)</th>' +
                '<th>Total (AU$)</th>' +
                '<th>Balance (AU$)</th>' +
                '<th>Profit/<span class="error">Loss</span> (AU$)</th>' +
                '</tr></thead>' +
                '<tbody></tbody>' +
                '<tfoot><tr>' +
                '<th>Taxi #</th>' +
                '<th>Plate Fee (AU$)</th>' +
                '<th>Network Finance (AU$)</th>' +
                '<th>Insurance Finance (AU$)</th>' +
                '<th>Car Finance (AU$)</th>' +
                '<th>Maintenance Cost (AU$)</th>' +
                '<th>Total (AU$)</th>' +
                '<th>Balance (AU$)</th>' +
                '<th>Profit/<span class="error">Loss</span> (AU$)</th>' +
                '</tr></tfoot>' +
                '</table>';
            $(".adv-table").append(temp);
        },
        populateDashboardList: function(objects){
            this.populateDashboardListTable();
            var dashboard_data = objects;
            console.dir(dashboard_data);
            var total_record = dashboard_data.length;
            var data_string = '';
            var tr_class = "gradeX";
            var profit_class = "";

            for (var i = 0; i < total_record; i++) {
                tr_class = i % 2 == 0 ? "gradeX" : "gradeC";
                profit_class = dashboard_data[i].profit < 0 ? "error" : "";
                data_string = '<tr class="'+tr_class+'">';
                data_string += '<td>'+dashboard_data[i].license_plate_no+'</td>';
                data_string += '<td>'+dashboard_data[i].plate_fee+'</td>';
                data_string += '<td>'+dashboard_data[i].network_fee+'</td>';
                data_string += '<td>'+dashboard_data[i].insurance_fee+'</td>';
                data_string += '<td>'+dashboard_data[i].car_finance_fee+'</td>';
                data_string += '<td>'+dashboard_data[i].maintenance_cost+'</td>';
                data_string += '<td>'+dashboard_data[i].total+'</td>';
                data_string += '<td>'+dashboard_data[i].balance+'</td>';
                data_string += '<td class="'+profit_class+'">'+dashboard_data[i].profit+'</td>';
                data_string += '</tr>';

                $("#dashboard-data-table tbody").append(data_string);
            }

            $('#dashboard-data-table').dataTable( {
                "aaSorting": [[ 8, "desc" ]]
            });
        },
        makeBarGraph: function(objectID, reportData){
            var chart = AmCharts.makeChart( objectID, {
                "type": "serial",
                "theme": "light",
                "dataProvider": reportData,
                "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0
                } ],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [ {
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "value"
                } ],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "taxi_id",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true,
                    "libs": {
                        "path": "<?php echo base_url()?>application/views/js/amcharts/exporting"
                    }
                }

            } );
        }
    }

    function dashboardInit(){
        updateDashboardData();
        $("#dashboardStartDate").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            clearBtn: true,
            todayHighlight: true
        })
            .on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

        $("#dashboardEndDate").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            clearBtn: true,
            todayHighlight: true
        })
            .on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
    }

    function updateDashboardData(){
        var serverURL = "<?php echo site_url('Dashboard/getDashboardDetail')?>";
        $("#dashboard-data-table tbody").html("");
        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', updateDashboardData, function(data){
            if (data.error['code'] == 0) {
                console.dir(data.result.result);
                dashboardObject.populateDashboardList(data.result.result.detail);
                dashboardObject.makeBarGraph('profit_graph', data.result.result.profitData);
                dashboardObject.makeBarGraph('maintenance_graph', data.result.result.maintenanceData);
            }
        });
    }

    function searchDashboardInformation(){
        var start_date = $("#dashboardStartDate").val();
        var end_date = $("#dashboardEndDate").val();
        var serverURL = "<?php echo site_url('Dashboard/getDashboardDetail?start_date=')?>" + start_date + "&end_date=" + end_date;

        $("#dashboard-data-table tbody").html("");
        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'searchDashboardInformation', function(data){
            if (data.error['code'] == 0) {
                dashboardObject.populateDashboardList(data.result.result.detail);
                dashboardObject.makeBarGraph('profit_graph', data.result.result.profitData);
                dashboardObject.makeBarGraph('maintenance_graph', data.result.result.maintenanceData);
            }
        });
    }
</script>