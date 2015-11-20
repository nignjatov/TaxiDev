<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/serial.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>application/views/js/amcharts/themes/light.js"></script>
<script>
    dashboardInit();

    var dashboardObject = {
        populateOperatorDashboardListTable: function(){
            $('#dashboard-data-table_wrapper').remove();
            $("#journalChart").remove();
            $("#yearPickerForm").remove();
            var temp = '<div class="table-responsive"><table class="display table table-bordered table-striped" id="dashboard-data-table">' +
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
                '</table></div>';
            $(".adv-table").append(temp);
        },
        populateDriverDashboardListTable: function(){
            $('#dashboard-data-table_wrapper').remove();
            $('#maintenanceChart').remove();
            $('#profitChart').remove();
            $('#datePickerForm').remove();
            var years = "";
            var cur_year = new Date().getFullYear();
            for ( var i = 2015; i<=2020; i++) {
                if(i != cur_year) {
                    years+= '<option>'+i+'</option>';
                } else {
                    years+= '<option selected="selected">'+i+'</option>';
                }
            }

            $('#yearPicker').html(years);
            var temp = '<div class="table-responsive"><table class="display table table-bordered table-striped" id="dashboard-data-table">' +
                '<thead><tr>' +
                '<th>Month</th>' +
                '<th>Shift pay (AU$)</th>' +
                '<th>Fuel cost (AU$)</th>' +
                '<th>Other cost (AU$)</th>' +
                '<th>Cash (AU$)</th>' +
                '<th>Eftpos Shift Total(AU$)</th>' +
                '<th>Docket (AU$)</th>' +
                '<th>Kilometer Driven</th>' +
                '<th>Total Expense (AU$)</th>' +
                '<th>Gross Income(AU$)</th>' +
                '<th>Net Income(AU$)</th>' +
                '<th>GST Payable</th>' +
                '</thead>' +
                '<tbody></tbody>' +
                '</table></div>';
            $(".adv-table").append(temp);
        },
        populateOperatorDashboardList: function(objects){
            this.populateOperatorDashboardListTable();
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
                data_string += '<td>'+parseFloat(dashboard_data[i].plate_fee).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].network_fee).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].insurance_fee).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].car_finance_fee).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].maintenance_cost).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].total).toFixed(2)+'</td>';
                data_string += '<td>'+parseFloat(dashboard_data[i].balance).toFixed(2)+'</td>';
                data_string += '<td class="'+profit_class+'">'+parseFloat(dashboard_data[i].profit).toFixed(2)+'</td>';
                data_string += '</tr>';

                $("#dashboard-data-table tbody").append(data_string);
            }

            $('#dashboard-data-table').dataTable( {
                "aaSorting": [[ 8, "desc" ]]
            });
        },
        populateDriverDashboardList: function(objects){
            this.populateDriverDashboardListTable();
            var dashboard_data = objects;
            console.dir(dashboard_data);
            var data_string = '';
            for (var i = 0; i < dashboard_data.length; i++) {

                data_string = '<tr>';
                data_string += '<td>'+dashboard_data[i].title+'</td>';
                data_string += '<td>'+dashboard_data[i].shiftPay+'</td>';
                data_string += '<td>'+dashboard_data[i].fuelCost+'</td>';
                data_string += '<td>'+dashboard_data[i].otherCost+'</td>';
                data_string += '<td>'+dashboard_data[i].cash+'</td>';
                data_string += '<td>'+dashboard_data[i].eftposShiftTotal+'</td>';
                data_string += '<td>'+dashboard_data[i].docket+'</td>';
                data_string += '<td>'+dashboard_data[i].kilometer+'</td>';
                data_string += '<td>'+dashboard_data[i].totalExpense+'</td>';
                data_string += '<td>'+dashboard_data[i].grossIncome+'</td>';
                data_string += '<td>'+dashboard_data[i].netIncome+'</td>';
                data_string += '<td>'+dashboard_data[i].gst+'</td>';
                data_string += '</tr>';

                $("#dashboard-data-table tbody").append(data_string);
            }
        },
        makeOperatorBarGraph: function(objectID, reportData){
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
        },

        makeDriverProfitGraph: function(reportData){
            data = reportData.slice(0, 12);
            var chart = AmCharts.makeChart( 'journal_graph', {
                "type": "serial",
                "categoryField": "title",
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "trendLines": [],
                "graphs": [
                    {
                        "balloonText": "[[title]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-1",
                        "title": "Gross income",
                        "type": "column",
                        "valueField": "grossIncome",
                        "valueAxis": "v1",
                    },
                    {
                        "balloonText": "[[title]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-2",
                        "title": "Total expense",
                        "type": "column",
                        "valueAxis": "v1",
                        "valueField": "totalExpense"
                    },
                    {
                        "balloonText": "[[title]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-4",
                        "title": "GST Payable",
                        "type": "column",
                        "valueAxis": "v1",
                        "valueField": "gst"
                    },
                    {
                        "balloonText": "[[title]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-5",
                        "title": "Net income",
                        "type": "column",
                        "valueAxis": "v1",
                        "valueField": "netIncome"
                    },
                    {
                        "id": "AmGraph-3",
                        "title": "Kilometer driven",
                        "valueAxis": "v2",
                        "valueField": "kilometer"
                    }
                ],
                "guides": [],
                "valueAxes": [{
                     "id":"v1",
                     "axisColor": "#FF6600",
                     "axisThickness": 2,
                     "gridAlpha": 0,
                     "axisAlpha": 1,
                     "position": "left",
                     "title": "AU$"
                 }, {
                     "id":"v2",
                     "axisColor": "#FCD202",
                     "axisThickness": 2,
                     "gridAlpha": 0,
                     "axisAlpha": 1,
                     "position": "right",
                     "title": "Kilometer driven"
                 }
                ],
                "allLabels": [],
                "balloon": {},
                "legend": {
                    "useGraphSettings": true
                },
                "titles": [
                    {
                        "id": "Title-1",
                        "size": 15,
                        "text": "Driver Journal"
                    },
                    {
                        "id": "Title-2",
                        "size": 10,
                        "text": "Monthly relationship between income, expense and kilometer driven"
                    }
                ],
                "dataProvider": data
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
        var serverURL = "<?php echo site_url('Dashboard/getDashboardDetail')?>"+"/year/"+(new Date().getFullYear());
        $("#dashboard-data-table").remove();
        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', updateDashboardData, function(data){
            if (data.error['code'] == 0) {
                console.dir(data.result.result);
                if(data.result.result.type === "operator"){
                    dashboardObject.populateOperatorDashboardList(data.result.result.detail);
                    dashboardObject.makeOperatorBarGraph('profit_graph', data.result.result.profitData);
                    dashboardObject.makeOperatorBarGraph('maintenance_graph', data.result.result.maintenanceData);
                } else if(data.result.result.type == "driver") {
                    dashboardObject.populateDriverDashboardList(data.result.result.profitData);
                    dashboardObject.makeDriverProfitGraph(data.result.result.profitData);
                }
            }
        });
    }

    function searchDashboardInformation(){
        var start_date = $("#dashboardStartDate").val();
        var end_date = $("#dashboardEndDate").val();
        var year = $("#yearPicker").val();
        var serverURL = "<?php echo site_url('Dashboard/getDashboardDetail')?>"+"/start_date/" + start_date + "/end_date/" + end_date+ "/year/"+year;

        $("#dashboard-data-table").remove();

        cuadroServerAPI.getServerData('GET', serverURL, 'JSONp', 'searchDashboardInformation', function(data){
            if (data.error['code'] == 0) {
                if(data.result.result.type === "operator"){
                    dashboardObject.populateOperatorDashboardList(data.result.result.detail);
                    dashboardObject.makeBarGraph('profit_graph', data.result.result.profitData);
                    dashboardObject.makeBarGraph('maintenance_graph', data.result.result.maintenanceData);
                } else if(data.result.result.type == "driver") {
                    dashboardObject.populateDriverDashboardList(data.result.result.profitData);
                    dashboardObject.makeDriverProfitGraph(data.result.result.profitData);
                }
            }
        });
    }
</script>