
<?php
//var_dump($_POST["rawFileUploadSubmit"]);
if(isset($_POST["rawFileUploadSubmit"])){
	//check if the option was selected
	$uploadFileDir = "../../Metalab_data/raw_files/";
	for($i=0; $i<sizeof($_FILES["RawFileToUpload"]["name"]); $i++){
		$uploadFileName = $_FILES["RawFileToUpload"]["name"][$i];
		$uploadFileTemp_Name = $_FILES["RawFileToUpload"]["tmp_name"][$i];
		$uploadFile = $uploadFileDir.$uploadFileName;
		$uploadOk = 1;
		$uploadFileType = $_FILES["RawFileToUpload"]["type"][$i];
		$uploadFileSize = $_FILES["RawFileToUpload"]["size"][$i];
		$uploadFileError = $_FILES["RawFileToUpload"]["error"][$i];
		//var_dump($_FILES); //this will output $FILES array

		// Check if a file is actually attached
		if(!isset($_POST['rawFileUploadSubmit'])){
		    echo '<div class="error-msg">No file selected</div>';
		}else{
		    // if(!$uploadFileName) {
		    //     echo "Please select a file to be uploaded"."<br/>\n";
		    //     $uploadOk = 0;
		    // }
		    // Check if the file size is too large
		    if($uploadFileSize > 500000000000){
		        echo '<div class="error-msg">File size was too large to be uploaded</div>';
		        $uploadOk = 0;
		    }
		    // Check if the file already exists
		    elseif (file_exists($uploadFile) && $uploadFileName != "") {
		        echo '<div class="error-msg">File with the same name '.$uploadFileName.' already exists.</div>';
		        $uploadOk = 0;
		    }
		    // Allow certain file formats
		    // elseif($uploadFileType != "fasta") {
		    //     echo "Sorry, only fasta files are allowed.";
		    //     $uploadOk = 0;
		    // }
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo '<div class="error-msg">File '.$uploadFileName.' was not uploaded.</div>';
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($uploadFileTemp_Name, $uploadFile)) {
		        echo '<div class="complete-msg">File: '.$uploadFileName.'</div>';
		        echo '<div class="complete-msg">Type: '.$uploadFileType.'</div>';
		        echo '<div class="complete-msg">Size: '.$uploadFileSize.'</div>';
		        echo '<div class="complete-msg">The file '. $uploadFileName. ' has been uploaded.</div>';
		    } else {
		        // echo "There was an error uploading your file ".$uploadFileName. ".<br/>\n";
		    }
		}
	}
}
?>
