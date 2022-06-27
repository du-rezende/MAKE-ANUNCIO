<?php

function trace($s){

    echo "<pre>";
    print_r($s); 
    echo "</pre>";
}


function scanIT($s){
    $r = array_diff(scandir($s), array('.', '..')); 
    return $r;
}

function forIMG($img,$p){

    foreach($img as $i){

        if (substr($i,-3)=="txt"){
            echo "<a href='$p/$i' target='_BLANK'>$i</a>";

        }
        else{
echo "<img src='$p/$i' width='100'/>";
}
    }
}


$mydir = 'img-base'; 
  
$myfiles = scanIT($mydir);

trace($myfiles);

foreach($myfiles as $f){

    if (is_dir($mydir."/".$f)){

        //echo '<p><a href="file:///C:\doc2\MAKE-ANUNCIO\img-base\">'.$f.'</a></p>';
        echo "<p>$f</p>";
        $img =scanIT($mydir."/".$f);
        forIMG($img,$mydir."/".$f); 
        
    }else{

        echo "<p>NO!</p>";
    }

}


?>
