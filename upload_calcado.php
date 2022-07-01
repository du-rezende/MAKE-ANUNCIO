<?php
include "resize.php";


function unlinkRecursive($dir) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        { 
            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 
    closedir($dh); 
    return; 
} 
include "variaveis_calcado.php";

$target_dir = $dir_img .$_POST["pasta"];


$old_index = (int)$_POST["img_index"];
$new_index =0;
//unlinkRecursive($target_dir);

 

$target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"][0]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo "XXXX".$target_file;
/* echo "<pre>";
print_r($_FILES);
//print_r($_FILES["userpic"]);
echo "</pre>"; */
for ($i=0; $i<count($_FILES["fileToUpload"]["name"]);$i++){
    $target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // echo $imageFileType ."<br>";
   $new_index = $old_index + $i;
    $nname = $target_dir ."/". $_POST["file_name_base"]."_".$new_index.".".$imageFileType;
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $nname);

do_resize($target_dir ."/", $_POST["file_name_base"]."_".$new_index,$imageFileType);

}
echo $new_index+1;

?>