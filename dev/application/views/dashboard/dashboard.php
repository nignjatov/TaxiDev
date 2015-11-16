<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Dashboard
                    </header>
                    <div class="row graph-container">
                        <div class="col-md-6" id="profitChart">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget_title">Profit</div>
                                    <div class="top-stats-panel dashboard_widget" id="profit_graph">

                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6" id="maintenanceChart">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget_title">Maintenance Cost</div>
                                    <div class="top-stats-panel dashboard_widget" id="maintenance_graph">

                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12" id="journalChart">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget_title">Driver Journal</div>
                                        <div class="top-stats-panel dashboard_widget" id="maintenance_graph">
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                            <div class="space15 m-bot20"></div>
                            <div class="query_box row-fluid">
                                <div class="container-fluid">
                                    <div class="row m-bot20">
                                        <div class="form-group">
                                            <div class="col-md-4" id="datePickerForm">
                                                <div class="input-group input-large" data-date="13/07/2013"
                                                     data-date-format="mm/dd/yyyy">
                                                    <input type="text" class="form-control dpd1" name="from"
                                                           value="Date form" id="dashboardStartDate">
                                                    <span class="input-group-addon">To</span>
                                                    <input type="text" class="form-control dpd2" name="to"
                                                           value="Date to" id="dashboardEndDate">
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="yearPickerForm">
                                                <div class="col-sm-2">
                                                    <label class="control-label" style="margin-top: 100%;">Year</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="year" id="yearPicker">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="btn-group">
                                                    <a onclick="searchDashboardInformation()" class="btn btn-default">
                                                        <i class="fa fa-search"></i> Search
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>

<script>
    document.title = '<?php echo config_item("site_title");?>: Dashboard';
    $("#nav-accordion li a").removeClass("active");
    $("#dashboard_menu a").addClass("active");
</script>