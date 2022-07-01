<?php
include "mdk_core.php";
/* 
$im = imagecreatetruecolor(1000, 1000);

// sets background to red
$red = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $red);

header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
 */

function do_resize($caminho,$arquivo,$ext){
//$caminho="img/shoes/CAT/CAT-V1/";
$nomearquivo = $arquivo.".".$ext;
 $width = 1000;
 $height = 1000;

 $width_p = 1000;
 $height_p = 1000;

 $xp = 0;
 $yp = 0;

$v = getimagesize($caminho.$nomearquivo);
list($width_orig, $height_orig, $tipo, $atributo) =$v;
//trace($v);
//trace($atributo);

 
if($width_orig > $height_orig){
    $height_p = ($width/$width_orig)*$height_orig;
    // Se altura é maior que largura, dividimos a altura determinada    pela original e multiplicamos a largura pelo resultado, para manter    a proporção da imagem
    } elseif($width_orig < $height_orig) {
    $width_p = ($height/$height_orig)*$width_orig;
    } 

    $xp = ($width - $width_p)/2;
    $yp = ($height - $height_p)/2;

$novaimagem = imagecreatetruecolor($width, $height);
$fundo = imagecolorallocate($novaimagem, 255, 255, 255);
imagefill($novaimagem, 0, 0, $fundo);


switch($tipo){
case 1:
    // Obtém a imagem gif original
    $origem = imagecreatefromgif($caminho.$nomearquivo);
    // Copia a imagem original para a imagem com novo tamanho
    
    break;
    
    // Se o tipo da imagem for jpg
    case 2:
    // Obtém a imagem jpg original
    $origem = imagecreatefromjpeg($caminho.$nomearquivo);
    // Copia a imagem original para a imagem com novo tamanho
 
    // Envia a nova imagem jpg para o lugar da antiga
    
    break;
    
    // Se o tipo da imagem for png
    case 3:
    // Obtém a imagem png original
    $origem = imagecreatefrompng($caminho.$nomearquivo);
    // Copia a imagem original para a imagem com novo tamanho
   
    break;
    } // -> fim switch

  //


    imagecopyresampled($novaimagem, $origem, $xp, $yp, 0, 0, $width_p,
    $height_p, $width_orig, $height_orig);

    unlink($caminho.$nomearquivo);
    imagejpeg($novaimagem, $caminho.$arquivo.".jpg");

    imagedestroy($novaimagem);
// Destrói a cópia de nossa imagem original
imagedestroy($origem);

}
?>