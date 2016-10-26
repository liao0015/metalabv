<?php

/*************select database section***************/
echo '<h3>Pick a Database</h3>';
//default databse section
echo '<fieldset id="default-database-options">
            <legend>Available database options (You can only selecte one per analysis):</legend>';

//open database directory
$dir_database = "../../Metalab_data/fasta_database";

//List files in database directory
if(is_dir($dir_database)){
    if($dh = opendir($dir_database)){
        while(($file = readdir($dh)) !== false ){
            if($file !== "." && $file !== ".."){
                if(filetype($dir_database."/".$file) == "file"){
                    echo '<div class="database-list"><input type="radio" name="databaseList" value="'.$file.'" /><label>'.$file.'</label></div>';
                    //echo filetype($dir_database."/".$file);
                }
            }
        }
        closedir($dh);
    }
}
            
echo '</fieldset>';//END select database section
?>