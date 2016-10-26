<?php

$fvmarray = array();
$ffmarray = array();
$fenzymearray = array();
$fisotopearray = array();

//generate variable modification array from vm.csv file
if(($vmcsvfile = fopen('input\vm.csv', 'r')) !== FALSE){
	$row = 0;
	while(($vmarray = fgetcsv($vmcsvfile, 0 , ",")) !== FALSE){
		$num = count($vmarray);
		//echo "<p>$num fields in line $row: <br/></p>\n";
		
		for($c = 0; $c < $num; $c++){
			//echo $vmarray[$c]."<br/>\n";
			//$newvmarray = $vmarray[$c];
			$fvmarray[$row] = $vmarray[$c];
		}
		$row++;
	}
	fclose($vmcsvfile);
}

//generate fixed modification array from fm.csv file
if(($fmcsvfile = fopen('input\fm.csv', 'r')) !== FALSE){
	$row = 0;
	while(($fmarray = fgetcsv($fmcsvfile, 0 , ",")) !== FALSE){
		$num = count($fmarray);
		//echo "<p>$num fields in line $row: <br/></p>\n";
		
		for($c = 0; $c < $num; $c++){
			//echo $vmarray[$c]."<br/>\n";
			//$newvmarray = $vmarray[$c];
			$ffmarray[$row] = $fmarray[$c];
		}
		$row++;
	}
	fclose($fmcsvfile);
}

//generate enzyme array from enzyme.csv file
if(($enzymecsvfile = fopen('input\enzyme.csv', 'r')) !== FALSE){
	$row = 0;
	while(($enzymearray = fgetcsv($enzymecsvfile, 0 , ",", " ", ">")) !== FALSE){
		$num = count($enzymearray);
		//echo "<p>$num fields in line $row: <br/></p>\n";
		
		for($c = 0; $c < $num; $c++){
			//echo $enzymearray[$c]."<br/>\n";
			$fenzymearray[$row] = $enzymearray[$c];
		}
		$row++;
	}
	fclose($enzymecsvfile);
}

//generate isotope array from isotope.csv file
if(($isotopecsvfile = fopen('input\isotope.csv', 'r')) !== FALSE){
	$row = 0;
	while(($isotopearray = fgetcsv($isotopecsvfile, 0 , ",", " ", ">")) !== FALSE){
		$num = count($isotopearray);
		//echo "<p>$num fields in line $row: <br/></p>\n";
		
		for($c = 0; $c < $num; $c++){
			//echo $enzymearray[$c]."<br/>\n";
			$fisotopearray[$row] = $isotopearray[$c];
		}
		$row++;
	}
	fclose($isotopecsvfile);
}

//////////////////////////////////////////////////
//               Parameter section
//////////////////////////////////////////////////

// variable modification section
echo '<div id="vm-wrapper">';
echo '<h3>Variable modification</h3>';
echo '<div id="vm-section">';

for($i = 0; $i < sizeof($fvmarray) ; $i++){
	if($fvmarray[$i] == "Oxidation (M)" || $fvmarray[$i] == "Acetyl (Protein N-term)"){
		echo '<div class="vmlist"><label>'.$fvmarray[$i].'</label><input type="checkbox" name="vmchecklist[]" checked value="'.$fvmarray[$i].'" /></div>';
	}else {
		echo '<div class="vmlist"><input type="checkbox" name="vmchecklist[]" value="'.$fvmarray[$i].'" /><label>'.$fvmarray[$i].'</label></div>';
	}
}
echo '</div></div>';//End of variable modification

// fixed modification section
echo "<div id=".'"fm-wrapper"'.">";
echo "<h3>Fixed modification</h3>";
echo "<div id=".'"fm-section"'.">";

for($i = 0; $i < sizeof($ffmarray) ; $i++){
	if($ffmarray[$i] == "Carbamidomethyl (C)"){
		echo '<div class="fmlist"><label>'.$ffmarray[$i].'</label><input type="checkbox" name="fmchecklist[]" checked value="'.$ffmarray[$i].'" /></div>';
	}else{
		echo '<div class="fmlist"><input type="checkbox" name="fmchecklist[]" value="'.$ffmarray[$i].'" /><label>'.$ffmarray[$i].'</label></div>';
	}
}
echo '</div></div>';//End of fixed modification

// enzyme section
echo '<div id="enzyme-wrapper">';
echo '<h3>Enzyme treatment</h3>';
echo '<div id="enzyme-section">';
//print_r($fenzymearray);
for($i = 0; $i < sizeof($fenzymearray) ; $i++){
	if($fenzymearray[$i] == "Trypsin"){
		echo '<div class="enzymelist"><input type="checkbox" name="enzymechecklist[]" checked value="'.$fenzymearray[$i].'" /><label>'.$fenzymearray[$i].'</label></div>';
	}else{
		echo '<div class="enzymelist"><input type="checkbox" name="enzymechecklist[]" value="'.$fenzymearray[$i].'" /><label>'.$fenzymearray[$i].'</label></div>';
	}
}
echo '</div></div>';//End of enzyme treatment

// isotope lable section
echo '<div id="isotope-wrapper">';
echo '<h3>Isotope labels</h3>';

//navigation bar for isotope lables
echo '<nav class="menu"><ul>';
echo '<li id="tab-light" class="active"><span>Light</span></li>';
echo '<li id="tab-medium"><span>Medium</span></li>';	
echo '<li id="tab-heavy"><span>Heavy</span></li></ul></nav>';
		
//isotope light section
echo '<div id="isotope-section-light">';
//print_r($fisotopearray);
for($i = 0; $i < sizeof($fisotopearray) ; $i++){
	echo '<div class="isotopelistlight"><input type="checkbox" name=isotopechecklistlight[]" value="'.$fisotopearray[$i].'" /><label>'.$fisotopearray[$i].'</label></div>';
}
echo "</div>";//End of isotope light

//isotope medium section
echo "<div id=".'"isotope-section-medium"'.">";
//print_r($fisotopearray);
for($i = 0; $i < sizeof($fisotopearray) ; $i++){
	echo '<div class="isotopelistmedium"><input type="checkbox" name="isotopechecklistmedium[]" value="'.$fisotopearray[$i].'" /><label>'.$fisotopearray[$i].'</label></div>';
}
echo "</div>";//End of isotope medium

//isotope heavy section
echo '<div id="isotope-section-heavy">';
//print_r($fisotopearray);
for($i = 0; $i < sizeof($fisotopearray) ; $i++){
	echo '<div class="isotopelistheavy"><input type="checkbox" name="isotopechecklistheavy[]" value="'.$fisotopearray[$i].'" /><label>'.$fisotopearray[$i].'</label></div>';
}
echo "</div>";//End of isotope heavy
echo "</div>";//End of isotope wrapper
?>



