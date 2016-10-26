
<?php

/***********raw files upload section*********/
echo '<div id="select-rawfile-wrapper" class="modal">';
//choose from existing file
echo '<div class="modal-content"><h3>Select Raw Files</h3>';
echo '<fieldset id="choose-existing-rawfiles"><legend>Existing raw files in your directory:</legend>';
//open output directory
$dir_rawfiles = "../../Metalab_data/raw_files";

//List files in output directory
if(is_dir($dir_rawfiles)){
    if($dh = opendir($dir_rawfiles)){
        while(($file = readdir($dh)) !== false ){
            if($file !== "." && $file !== ".."){
                if(filetype($dir_rawfiles."/".$file) == "file"){
                    echo '<div><input class="raw-file-list" type="checkbox" name="existingRawFileList[]" value="'.$file.'" /><label>'.$file.'</label></div>';
                    //echo filetype($dir_rawfiles."/".$file);
                }
            }
        }
        closedir($dh);
    }
}
echo '</fieldset>
    <div id="selectedRawFileListCloseLable" class="close"><label>Close</label></div>
    <div id="selectedRawFileListSubmitLable"><label>Submit</label></div>
    </div></div>';  //END choose from existing file
?>


    