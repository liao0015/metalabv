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
//upload new raw files
echo '<div id="upload-rawfile-wrapper"><h3>Upload Raw Files</h3>
        <form action="index.php" method="POST" enctype="multipart/form-data">
        <fieldset id="raw-files-upload">
            <legend>Add a new raw file: (you may add multiple raw files)</legend>
            <div><input type="file" name="RawFileToUpload[]" style="margin:10px;"></div>
            <div><input type="file" name="RawFileToUpload[]" style="margin:10px;"></div>
            <input type="button" id="generateUploadBtn">
            <div id="generateUploadlabel">
            	<label for="generateUploadBtn">Upload more...</label>
            </div>
        </fieldset><input type="submit" name="rawFileUploadSubmit" id="rawFileUploadSubmitBtn">
        <a href="index.php" id="rawFileUploadCloseLabel">Close</a>
        <div id="rawFileUploadSubmitLabel"><label for="rawFileUploadSubmitBtn">Upload Raw Files</label></div>
        </form>
    </div>'; //END add new raw files

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