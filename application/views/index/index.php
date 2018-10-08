<script src="<?php echo base_url("/public/plugins/chartjs/Chart.min.js"); ?>"></script>
<link href="<?php echo base_url("/public/plugins/datatables/dataTables.bootstrap.css"); ?>" rel="stylesheet" type="text/css">
<?php if(isset($userId)){ ?>
<section class="content-header">
    <h1>
        Welcome! <?php echo $username ?>
        <small> <b> | <?php echo $this->session->userdata('r_groupName');?></b> </small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
</section>
<?php } ?>



<div id="option-modal">
</div>
<script type="text/javascript">

    /* FROM CHART.JS */
    //$(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        /*var chartData = {
            labels  : ['BALONGPANGGANG', 'BENJENG', 'BUNGAH', 'CERME'],
            datasets: [
                {
                    label               : 'PK, RUSAK RINGAN',
                    fillColor: "rgba(60,141,188,0.8)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "rgba(60,141,188,0.8)",
                    pointHighlightStroke: "rgba(60,141,188,0.8)",
                    data                : [65, 59, 80, 81]
                },
                {
                    label               : 'PK, RUSAK SEDANG',
                    fillColor: "rgba(253,180,92,1)",
                    strokeColor: "rgba(253,180,92,1)",
                    pointColor: "rgba(253,180,92,1)",
                    pointHighlightStroke: "rgba(253,180,92,1)",
                    data                : [28, 48, 40, 19]
                },
                {
                    label               : 'PK, RUSAK BERAT',
                    fillColor: "rgba(247,70,74,1)",
                    strokeColor: "rgba(247,70,74,1)",
                    pointColor: "rgba(247,70,74,1)",
                    pointHighlightStroke: "rgba(247,70,74,1)",
                    data                : [65, 59, 80, 81]
                },
            ]
        }

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
            {
                value    : 500,
                color    : '#00a65a',
                highlight: '#00a65a',
                label    : 'Rusak Ringan'
            },
            {
                value    : 400,
                color    : '#f39c12',
                highlight: '#f39c12',
                label    : 'Rusak Sedang'
            },
            {
                value    : 700,
                color    : '#f56954',
                highlight: '#f56954',
                label    : 'Rusak Berat'
            },
        ]
        var pieOptions     = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            //String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth   : 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps       : 100,
            //String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : true,
            legend: {
                display: true,
                labels: {
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)

        //-------------
        //- BAR CHART -
        //-------------
        /*var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
        var barChart                         = new Chart(barChartCanvas)
        var barChartData                     = chartData
        barChartData.datasets[0].fillColor   = '#00a65a'
        barChartData.datasets[0].strokeColor = '#00a65a'
        barChartData.datasets[0].pointColor  = '#00a65a'
        var barChartOptions                  = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero        : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - If there is a stroke on each bar
            barShowStroke           : true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth          : 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing         : 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing       : 1,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive              : true,
            maintainAspectRatio     : true,
        }

        barChart.Bar(barChartData, barChartOptions);

    })*/

    /* END FROM CHART.JS */
</script>