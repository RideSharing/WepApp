<?php
    /*
        Include the `fusioncharts.php` file that contains functions to embed the charts.
    */
    include("includes/fusioncharts.php");
?>

<html>

    <head>
        <title>FusionCharts XT - Simple Area 2D Chart with JSON Data</title>

        <!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->
        <script src="fusioncharts/fusioncharts.js"></script>
        <script type="text/javascript" src="fusioncharts/themes/fusioncharts.theme.zune.js"></script>
    </head>
    <body>
        <?php
            /*
                Create a `area2DChart` chart object using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`. To load data from a JSON string, `json` is passed as the value for the data format parameter of the constructor. The actual JSON data for the chart is passed as a string to the constructor.
            */
            $area2DChart = new FusionCharts("Column2D", "myFirstChart" , 600, 300, "chart-1", "json",
                                            '{
                                                "chart": {
                                                    "caption": "Sales of Liquor",
                                                    "subCaption": "Last week",
                                                    "xAxisName": "Day",
                                                    "yAxisName": "Sales (In USD)",
                                                    "numberPrefix": "$",
                                                    "paletteColors": "#0075c2",
                                                    "bgColor": "#ffffff",
                                                    "showBorder": "1",
                                                    "showCanvasBorder": "0",
                                                    "plotBorderAlpha": "10",
                                                    "usePlotGradientColor": "0",
                                                    "plotFillAlpha": "50",
                                                    "showXAxisLine": "1",
                                                    "axisLineAlpha": "25",
                                                    "divLineAlpha": "10",
                                                    "showValues": "1",
                                                    "showAlternateHGridColor": "0",
                                                    "captionFontSize": " 14",
                                                    "subcaptionFontSize": "14",
                                                    "subcaptionFontBold": "0",
                                                    "toolTipColor": "#ffffff",
                                                    "toolTipBorderThickness": "0",
                                                    "toolTipBgColor": "#000000",
                                                    " toolTipBgAlpha": "80",
                                                    "toolTipBorderRadius": "2",
                                                    "toolTipPadding": "5"
                                                },
                                                "data": [{
                                                    "label": " Mon",
                                                    "value": "4123"
                                                }, {
                                                    "label": "Tue",
                                                    "value": "  4633"
                                                }, {
                                                    "label": "Wed",
                                                    "value": "5507"
                                                }, {
                                                    "label": "Thu",
                                                    "value": "4910"
                                                }, {
                                                    "label": "Fri",
                                                    "value": "5529"
                                                }, {
                                                    "label": "Sat",
                                                    "value": "5803"
                                                }, {
                                                    "label": "Sun",
                                                    "value": "6202"
                                                }]
                                            }'
                                        );

            // Render the chart
            $area2DChart->render();
        ?>
    <div id="chart-1"></div>
   </body>
</html>