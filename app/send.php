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
	echo '<div id="summary-wrapper">';
	echo '<h3 class="title-decoration">Submission Summary</h3>';

	/******************************************************************/
	/***************************selected raw files*********************/
	/******************************************************************/

	if(isset($_POST['selectedRawFileList']) && isset($_POST['experiments'])){
		
		for($j=0; $j<sizeof($_POST["selectedRawFileList"]); $j++){
			$rawFiles[$j]['path'] = "C:\\xampp\\htdocs\\Metalab_data\\raw_files\\".$_POST['selectedRawFileList'][$j];
			$rawFiles[$j]['experiment'] = trim($_POST['experiments'][$j]);
			$showFiles[$j]['name'] = $_POST['selectedRawFileList'][$j];
			$showFiles[$j]['experiment'] = trim($_POST['experiments'][$j]);
			//echo $rawFiles[$j]['path']."<br/>\n";
		}
		echo "<h4>Current experiment setup with the corresponding raw files: </h4>";
		//print_r($rawFiles);
		echo "<ol>";
		foreach($showFiles as $outputraw){
			echo '<li>Experiment '.$outputraw['experiment'].': '.$outputraw['name']."</li>";
		}
		echo "</ol>";
	}else{
		echo '<p class="error-msg">You did not specify raw files for analysis.</p>';
	}

	/******************************************************************/
	/***********************selected database files********************/
	/******************************************************************/

	if(isset($_POST["databaseList"])){
		echo "<h4>Selected database: </h4>";
		echo $_POST["databaseList"]."<br/>\n";
		$database = "C:\\xampp\\htdocs\\Metalab_data\\fasta_database\\".$_POST["databaseList"];
	}else{
		echo '<p class="error-msg">You didn not specify a database for analysis.</p>';
	}

	/**********************************************************************/
	/******************************parameters******************************/
	/**********************************************************************/
	$submitCheck = 1;
	//parse variable modification check list array
	if(isset($_POST['vmchecklist'])){
		$qvmarray = $_POST['vmchecklist'];
		echo "<h4>Selected variable modification</h4>";
		foreach($qvmarray as $qvmitem){
			echo "<ul><li>".$qvmitem."</li></ul>";
			$updatedvmarray[] = array('name'=>$qvmitem);
		}
	}else{
		echo "<p>No selection for variable modification</p>";
		$updatedvmarray[] = array('name'=>" ");
	}

	//parse fixed modification check list array
	if(isset($_POST['fmchecklist'])){
		$qfmarray = $_POST['fmchecklist'];
		echo "<h4>Selected fixed modification</h4>";
		foreach($qfmarray as $qfmitem){
			echo "<ul><li>".$qfmitem."</li></ul>";
			$updatedfmarray[] = array('name'=>$qfmitem);
		}
	}else{
		echo "<p>No selection for fixed modification</p>";
		$updatedfmarray[] = array('name'=>" ");
	}

	//parse enzyme check list array
	if(isset($_POST['enzymechecklist'])){
		$qenzymearray = $_POST['enzymechecklist'];
		echo "<h4>Selected enzyme</h4>";
		foreach($qenzymearray as $qenzymeitem){
			echo "<ul><li>".$qenzymeitem."</li></ul>";
			$updatedenzymearray[] = array('name'=>$qenzymeitem);
		}
	}else{
		echo "<p>No selection for enzyme treatment</p>";
		$updatedenzymearray[] = array('name'=>" ");
	}

	//parse isotope label light check list array
	if(isset($_POST['isotopechecklistlight'])){
		$qisotopelightarray = $_POST['isotopechecklistlight'];
		echo "<h4>Selected isotope light lables</h4>";
		foreach($qisotopelightarray as $qisotopelightitem){
			echo "<ul><li>".$qisotopelightitem."</li></ul>";
			$updatedisotopelightarray[] = array('name'=>$qisotopelightitem);
		}
	}else{
		echo "<p>No selection for isotope light lables</p>";
		$updatedisotopelightarray[] = array('name'=>" ");
	}

	//parse isotope label medium check list array
	if(isset($_POST['isotopechecklistmedium'])){
		$qisotopemediumarray = $_POST['isotopechecklistmedium'];
		echo "<h4>Selected isotope medium lables</h4>";
		foreach($qisotopemediumarray as $qisotopemediumitem){
			echo "<ul><li>".$qisotopemediumitem."</li></ul>";
			$updatedisotopemediumarray[] = array('name'=>$qisotopemediumitem);
		}
	}else{
		echo "<p>No selection for isotope medium labels</p>";
		$updatedisotopemediumarray[] = array('name'=>" ");
	}

	//parse isotope label light check list array
	if(isset($_POST['isotopechecklistheavy'])){
		$qisotopeheavyarray = $_POST['isotopechecklistheavy'];
		echo "<h4>Selected isotope heavy lables</h4>";
		foreach($qisotopeheavyarray as $qisotopeheavyitem){
			echo "<ul><li>".$qisotopeheavyitem."</li></ul>";
			$updatedisotopeheavyarray[] = array('name'=>$qisotopeheavyitem);
		}
	}else{
		echo "<p>No selection for isotope heavy lables<p>";
		$updatedisotopeheavyarray[] = array('name'=>" ");
	}
	
	//var_dump($_POST);

	/**********************************************************************/
	/****************************generate JSON*****************************/
	/**********************************************************************/

	$results['vari mods'] = $updatedvmarray;
	$results['fix mods'] = $updatedfmarray;
	$results['enzyme'] = $updatedenzymearray;
	$results['light'] = $updatedisotopelightarray;
	$results['medium'] = $updatedisotopemediumarray;
	$results['heavy'] = $updatedisotopeheavyarray;

	//system default
	$results['thread count'] = 4;
	$results['Peptide to Gi'] = "Resources\\db\\pep_gi_human";
	$results['Gi to Taxonomy'] = "Resources\\db\\gi_taxid_prot.dmp";
	$results['peptideFdr'] = 0.01;
	$results['proteinFdr'] = 0.01;
	$results['minRatioCount'] = 2;
	$results['lfqMinRatioCount'] = 2;
	
	if(isset($_POST['instrumentResolution'])){
		$results['instrument resolution'] = $_POST['instrumentResolution'];
	}else{
		$results['instrument resolution'] = 'high-high';
	}

	echo '<h4>Instrument Resolution: </h4>'.$results['instrument resolution'];

	echo '<h4>Taxonomy: </h4>';
	if(isset($_POST['taxonomy'][0])){
		$results['build-in'] = "true";
		echo '<p>build-in</p>';
		if(isset($_POST['taxonomy'][1])){
			$results['unipept'] = "true";
			echo '<p>unipept</p>';
		}else{
			$results['unipept'] = "false";
		}

	}else{
		$results['build-in'] = "false";
		if(isset($_POST['taxonomy'][1])){
			$results['unipept'] = "true";
			echo '<p>unipept</p>';
		}else{
			$results['unipept'] = "false";
		}
	}

	if(isset($database)&&isset($rawFiles)){
		$results['database'] = $database;
		$results['raw files'] = $rawFiles;

		//write php array into a JSON file
		$fp = fopen('..\..\Metalab\results.json', 'w');
		fwrite($fp, json_encode($results));
		fclose($fp);
		//for testing output
		//print_r($results);

		echo '<form action="check.php" method="POST">
		<input type="submit" name="check" value="Start Data Analysis" id="analysis-submit-btn"/>
		<div style="width:100%;">
			<div id="analysis-submit-label"><label for="analysis-submit-btn">Start Data Analysis</label></div>
			<a href="index.php" class="cancel-submit-label"><label>Go Back</label></a>
		</div>
		</form>';
	}else{
		echo '<p class="error-msg">Missing raw files or database. </p>';
		echo '<div><label style="background:#efefef; color:red; margin: 10px; padding: 5px; width:40%; display: inline-block; text-align: center;">CANNOT PROCEED</label>
			<a href="index.php" class="cancel-submit-label"><label>Go Back</label></a>';
	}
	echo '</div>'; //END summary wrapper
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