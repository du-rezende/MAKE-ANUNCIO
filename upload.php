<?php



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
include "variaveis.php";

$target_dir = $dir_img .$_POST["pasta"];

unlinkRecursive($target_dir);

$target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"][0]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/* echo "<pre>";
print_r($_FILES);
//print_r($_FILES["userpic"]);
echo "</pre>"; */
for ($i=0; $i<count($_FILES["fileToUpload"]["name"]);$i++){
    $target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // echo $imageFileType ."<br>";
    $nname = $target_dir ."/". $_POST["file_name_base"]."_".$i.".".$imageFileType;
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $nname);
}

?>