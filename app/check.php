
<?php
echo '<!DOCTYPE html>
		<html>
		<head>
			<title>MetaLab</title>
			<meta charset="UTF-8">
			<link href="css/styles.css" rel="stylesheet"/>
		</head>
		<body>
			<div class="header">
				<a href="../index.html"><img src="img/45pxgray.png"></a>
				<h2>Data Analysis</h2>
			</div>';


//exec('java -jar C:\xampp\htdocs\Metalab\Metalab.jar -help', $result);
error_reporting(0);
$to_execute = "cd C:/xampp/htdocs/Metalab/ & java -jar Metalab.jar -par results.json";
exec($to_execute, $output);


echo '<div style="width: 640px; margin:0 auto;"><h2>Thank you for using our service!</h2>';
echo "<h3>The following file has been generated in directory: </h3>";
// var_dump($result);
//var_dump($output);
//print_r($output);
echo "</div>";

echo '<div class="footer">
		<div style="width:30%; float:left; padding-top: 3%;">
			<span>Metalab Copyright@2016</span>
		</div>
		<div style="width:30%; float:left;">
			<div style="padding-top: 5%; text-align: left;" id="help">Help</div>
			<div style="padding-top: 5%; text-align: left;" id="privacy">Privacy and terms</div>
		</div>
		<div style="width:35%; float:left;">
			<a href="../index.html"><img src="img/45pxgray.png"></a>
		</div>
	</div>

		<script src="js/index.js"></script>
	</body>
	</html>';	
?>