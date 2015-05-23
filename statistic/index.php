<?php
include_once '../controller/Constant.php';
   /* **Step 1:** Include the `fusioncharts.php` file that contains functions to embed the charts. */
   include("../includes/fusioncharts.php");
   session_start ();

if(isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "en") {
        require_once '../includes/lang_en.php';
    } else {
        require_once '../includes/lang_vi.php';
    }
} else {
    setcookie('lang', 'en', time() + (86400 * 365), "/");
}
   
   if (! isset ( $_SESSION ["api_key"] )) {
   	header ( 'Location: ../' );
   	die ();
   }
   require_once '../header_master.php';
   ?>
   <title><?php echo $lang['STATISTIC']?></title>
	<!-- Header -->
	<script src="../fusioncharts/fusioncharts.js"></script>
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-text">
						<?php
						
						$api_key = $_SESSION ["api_key"];
						$ch = curl_init ();
						
						curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/statistic_driver/all" );
						curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
						curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
						'Authorization: ' . $api_key
						) );
						
						// Thiết lập sử dụng GET
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
						
						// execute the request
						$result = curl_exec ( $ch );
						
						// close curl resource to free up system resources
						curl_close ( $ch );
						
						$json = json_decode ( $result );
						
						$stats = $json->{'stats_driver'};
						


				     	/* **Step 3:** Create a `columnChart` chart object using the FusionCharts PHP class constructor. Syntax for the constructor: `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`   */
				
						$arrData = array(
								"chart"=> array(
								"caption" => "Monthly revenue for this year",
								"subCaption" => "Harry\’s SuperMart",
								"xAxisName" => "Month",
								"yAxisName" => "Revenues (In VND)",
								"numberPrefix" => "$",
								"paletteColors" => "#0075c2",
								"bgColor" => "#ffffff",
								"borderAlpha" => "20",
								"canvasBorderAlpha" => "0",
								"usePlotGradientColor" => "0",
								"plotBorderAlpha" => "10",
								"placeValuesInside" => "1",
								"rotatevalues" => "1",
								"valueFontColor" => "#ffffff",
								"showXAxisLine" => "1",
								"xAxisLineColor" => "#999999",
								"divlineColor" => "#999999",
								"divLineIsDashed" => "1",
								"showAlternateHGridColor" => "0",
								"subcaptionFontSize" => "14",
								"subcaptionFontBold" => "0"
								)
						);
						
						$arrData["data"] = $stats;
						
						$jsonEncodedData = json_encode($arrData);
						
				    	$columnChart = new FusionCharts("Column2D", "myFirstChart" , 700, 400, "chart-1", "json",$jsonEncodedData);
				
				/* Because we are using JSON to specify chart data, `json` is passed as the value for the data format parameter of the constructor. The actual chart data, in string format, is passed as the value for the data source parameter of the constructor. Alternatively, you can store this string in a variable and pass the variable to the constructor. */
				
				     	/* **Step 4:** Render the chart */
				     	$columnChart->render();
				  	?>
				  	<div id="chart-1"><!-- Fusion Charts will render here--></div>
					</div>
				</div>
			</div>
		</div>
	</header>
  	
    <?php
    require_once '../footer_master.php';
    ?>
    
    <!-- **Step 2:**  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->
