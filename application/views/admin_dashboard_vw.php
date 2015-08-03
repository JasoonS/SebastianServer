<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php //if(isset($this->session->flashdata('ErrorAcessMsg'))) { echo $this->session->flashdata('ErrorAcessMsg')} ?>
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">2500</div>
                    <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                </div>
            </div>
            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Google Play</span>
                    <div class="count">500</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                </div>
            </div>

            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-clock-o"></i> iPhone</span>
                    <div class="count">700</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                </div>
            </div>

            
            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Registered Hotels</span>
                    <div class="count">4,567</div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

        <div class="page-title">
            <div class="title_left">
                <h3>System Stastiscs</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hotels Signed Up</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>                        
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="canvas000"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Statistics</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="canvas_bar"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>App Downloads</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="canvas_doughnut"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Memory Usage</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                            <span class="sr-only">45% Complete</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="">
                <p class="pull-right"><?php echo $title ?> from<a>Eeshana</a>. |
                    <span class="lead"> <i class="fa fa-paw"></i> <?php echo $title ?></span>
                </p>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script src="<?php echo THEME_ASSETS;  ?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS;  ?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS;  ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS;  ?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/custom.js"></script>
<script>
    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100)
    };
    var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                fillColor: "#26B99A", //rgba(220,220,220,0.5)
                strokeColor: "#26B99A", //rgba(220,220,220,0.8)
                highlightFill: "#36CAAB", //rgba(220,220,220,0.75)
                highlightStroke: "#36CAAB", //rgba(220,220,220,1)
                data: [51, 30, 40, 28, 92, 50, 45]
        },
            {
                fillColor: "#03586A", //rgba(151,187,205,0.5)
                strokeColor: "#03586A", //rgba(151,187,205,0.8)
                highlightFill: "#066477", //rgba(151,187,205,0.75)
                highlightStroke: "#066477", //rgba(151,187,205,1)
                data: [41, 56, 25, 48, 72, 34, 12]
        }
    ],
    }

    $(document).ready(function () {
        new Chart($("#canvas_bar").get(0).getContext("2d")).Bar(barChartData, {
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            responsive: true,
            barDatasetSpacing: 6,
            barValueSpacing: 5
        });
    });


    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
                strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [31, 74, 6, 39, 20, 85, 7]
        },
            {
                label: "My Second dataset",
                fillColor: "rgba(3, 88, 106, 0.3)", //rgba(151,187,205,0.2)
                strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
                pointColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [82, 23, 66, 9, 99, 4, 2]
        }
    ]

    }

    $(document).ready(function () {
        new Chart(document.getElementById("canvas000").getContext("2d")).Line(lineChartData, {
            responsive: true,
            tooltipFillColor: "rgba(51, 51, 51, 0.55)"
        });
    });

    var sharePiePolorDoughnutData = [
        {
            value: 120,
            color: "#455C73",
            highlight: "#34495E",
            label: "Dark Grey"
    },
        {
            value: 50,
            color: "#9B59B6",
            highlight: "#B370CF",
            label: "Purple Color"
    },
        {
            value: 150,
            color: "#BDC3C7",
            highlight: "#CFD4D8",
            label: "Gray Color"
    },
        {
            value: 180,
            color: "#26B99A",
            highlight: "#36CAAB",
            label: "Green Color"
    },
        {
            value: 100,
            color: "#3498DB",
            highlight: "#49A9EA",
            label: "Blue Color"
    }
];

$(document).ready(function () {
    window.myDoughnut = new Chart(document.getElementById("canvas_doughnut").getContext("2d")).Doughnut(sharePiePolorDoughnutData, {
        responsive: true,
        tooltipFillColor: "rgba(51, 51, 51, 0.55)"
    });
});

</script>

