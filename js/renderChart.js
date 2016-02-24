/**
 * Created by Manuel
 * V1
 * @param chartType, data
 * When an indicator data is fetched from the query, this script render the chart specified and rendered with the fetche.
 */

/**
 *  Tests
 */

//Data dummy values

// --------------- For Doughnut -----------
//  {
//    value: 90,
//        color: "red",
//    highlight: "#FF5A5E",
//    label: "Red"
//  },
//  {
//    value: 50,
//        color: "green",
//    highlight: "#5AD3D1",
//    label: "Green"
//  }
// --------  For the Rest --------------
// [65, 59, 80, 81, 56, 55, 40]
//--------------------------------------

//Render Charts with dummy data
//var data;
data_line = {
    pointLabels: ["January", "February", "March", "April", "May", "June", "July"],
    values: [65, 59, 80, 81, 56, 55, 40],
    yLabel: "TestData",
    chartType: "3"
    // With dummy data all passed.
};
// Load Data from php.

function renderChart(data) {

/**
 *  Set Default Options.
 */
// Area Chart options
var areaChartOptions = {
    datasetFill: true,
    responsive: true
};

// Line Chart Options
var lineChartOptions = {
    responsive : true,
    datasetFill : false
};

// Doughnut Chart Options
var doughnutChartOptions = {


    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke : true,

    //String - The colour of each segment stroke
    segmentStrokeColor : "#fff",

    //Number - The width of each segment stroke
    segmentStrokeWidth : 2,

    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout : 50, // This is 0 for Pie charts

    //Number - Amount of animation steps
    animationSteps : 100,

    //String - Animation easing effect
    animationEasing : "easeOutBounce",

    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate : true,

    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale : false,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

};

// Bar Chart Options
var barChartOptions = {

        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 1,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
};

/**
 *  Load Data .
 */

var lineChartData;
var lineChart;
var areaChartData;
var areaChart;
var doughnutChart;
var barChartData;
var barChart;


// Line chart
lineChartData = {
    label: data.yLabel,
    strokeColor: "rgba(249,206,13,0.8)",
    pointColor: "rgba(249,206,13,0.01)",
    pointStrokeColor: "rgba(249,206,13,0.01)",
    pointHighlightFill: "rgba(249,206,13,0.8)",
    pointHighlightStroke: "rgba(249,206,13,0.8)",
    data: data.values
};

// Parse the data.

lineChart = {
    labels: data.pointLabels,
    datasets: [
        lineChartData
    ]
};

// Area Chart
areaChartData = {

    label: data.yLabel,
    fillColor: "rgba(151,187,205,0.2)",
    strokeColor: "rgba(151,187,205,1)",
    pointColor: "rgba(151,187,205,1)",
    pointStrokeColor: "#fff",
    pointHighlightFill: "#fff",
    pointHighlightStroke: "rgba(151,187,205,1)",
    data: data.values

};
areaChart = {
    labels: data.pointLabels,
    datasets: [
        areaChartData
    ]
};

// Doughnut  Chart

doughnutChart = data.values;


// Bar Chart

barChartData = {
    fillColor: "#3E606F",
    strokeColor: "rgba(62,96,111,0.8)",
    highlightFill: "rgba(220,220,220,0.75)",
    highlightStroke: "rgba(220,220,220,1)",
    data: data.values
};

barChart = {
    labels: data.pointLabels,
    datasets: [
        barChartData
    ]
};


/**
 *  Render Chart.
 */



    var ctx; // chart variable.
    ctx = document.getElementById("canvas").getContext("2d"); // get the context
    var chart_type = data.chartType; // case parse.

    switch (chart_type) {

        // Area Chart
        case("1"):
            var myAreaChart =new Chart(ctx).Line(areaChart, areaChartOptions);
            break;

        // Doughnut Chart
        case("2"):
            new Chart(ctx).Doughnut(doughnutChart, doughnutChartOptions);
            break;
        // Line Chart
        case("3"):
            new Chart(ctx).Line(lineChart, lineChartOptions);
            break;
        // Bar Chart.
        case("4"):
            var myBarChart = new Chart(ctx).Bar(barChart,barChartOptions);
            break;


    }


}
