<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/base.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
   
<div class="container">

<p>
 SKU:LADYLU-P71-CONCHA   
</p>



<?php

function acentos($s){
$r = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$s);
return $r;
}
function espaco($s,$a="",$b=" "){
   $r = str_replace($b, $a, $s);
   return $r;   
}

function to_sku($s){

$r = acentos($s);
$r = espaco($r);
$r = strtoupper($r);
//$r = $r;
return $r;

}

function to_file($s){

  $r = acentos($s);
  $r = espaco($r,"-");
  $r = strtolower($r);
  //$r = $r;
  return $r;
  
  }



$url = "https://calcecomestilo.com/image/MKTPLACE/LADYLU/PULSEIRAS/";
$titulo_base = "Pulseira Articulada Feminina e Masculina [nome] [tamanho]MM LadyLu";
$desc_base = "Sobressaia-se com a <nome>. A joia possui acabamento impecável e produzida com material de alta qualidade. O modelo do fechamento dessa pulseira articulada confere a peça segurança e um design  moderno e cheio de estilo. Detalhes sobre as medidas da peça podem ser encontrados nas fotos do anuncio. ";


$sku = (isset($_POST['sku']) ?$_POST['sku']: '');
$tamanho = (isset($_POST['tamanho']) ?$_POST['tamanho']: '');
$preco = (isset($_POST['preco']) ?$_POST['preco']: '');




$variacao_nome = (isset($_POST['variacao_nome']) ?$_POST['variacao_nome']: []);
$variacao_cor = (isset($_POST['variacao_cor']) ?$_POST['variacao_cor']: []);
$variacao_img = (isset($_POST['variacao_img']) ?$_POST['variacao_img']: []);



$img = (isset($_POST['img']) ?$_POST['img']: '');



$sku_lower = strtolower($sku);


$skuF = "LADYLU-P$tamanho-".to_sku($sku);
$titulo = "Pulseira Articulada Feminina e Masculina $sku $tamanho"."MM LadyLu";

$descricao = espaco($desc_base,$titulo,"<nome>");

//$file_name_base = (isset($_POST['file_name_base']) ?$_POST['file_name_base']: '');
$file_name_base = to_file($titulo);


$t = "";
$t1 = "";


for($i=0;$i< count($variacao_nome);$i++){
$t .= $skuF."-V-".to_sku($variacao_nome[$i])."<br>";
$t1 .= "Cor:$variacao_cor[$i];Tamanho:Único;Gênero:Unissex<br>";


}


if(!is_dir('img/'.$skuF)){
  mkdir('img/'.$skuF, 0777, true);

}

include "make_csv.php";


//

?>





<div class="row">
<div class="col-6">
<form method="post" id="form1">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">SKU</label>
  <input type="text" class="form-control" name="sku" value="<?php echo $sku; ?>" >
</div>

<div class="row">

<div class="mb-3 col-6">
  <label for="exampleFormControlInput1" class="form-label">TAMANHO</label>
  <input type="text" class="form-control" name="tamanho" value="<?php echo $tamanho; ?>" >
</div>

<div class="mb-3 col-6">
  <label for="exampleFormControlInput1" class="form-label">PREÇO</label>
  <input type="text" class="form-control" name="preco" value="<?php echo $preco; ?>" >
</div>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">DESCRICAO</label>
  <textarea class="form-control" id="descricao" rows="5"><?php echo $descricao; ?></textarea>
</div>

<div class="mb-3 col-6">
  <label for="exampleFormControlInput1" class="form-label">IMG</label>
  <input type="text" class="form-control" name="img" id="img" value="<?php echo $img; ?>" >
</div>

<div class="mb-3">
  <button type="button" id="add_vars" class="btn btn-sucessbtn btn-primary">+ VARIAÇÃO</button>
</div>
    <div id="my_vars">

    <?php
   
for($i=0;$i< count($variacao_nome);$i++){
  
echo '
<div class="row">

  <div class="col-5">

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nome</label>
    <input type="text" class="form-control" name="variacao_nome[]" value="'.$variacao_nome[$i].'">
  </div>
  </div>
  <div class="col-5">
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Cor</label>
    
    <select class="form-control form-select" name="variacao_cor[]" data-selected="'.$variacao_cor[$i].'">
    <option value=""></option>
    <option value="Amarelo">Amarelo</option>
<option value="Azul">Azul</option>
<option value="Bege">Bege</option>
<option value="Branco">Branco</option>
<option value="Bronze">Bronze</option>
<option value="Cinza">Cinza</option>
<option value="Cobre">Cobre</option>
<option value="Colorido">Colorido</option>
<option value="Creme">Creme</option>
<option value="Cromado">Cromado</option>
<option value="Laranja">Laranja</option>
<option value="Marrom">Marrom</option>
<option value="Metálico">Metálico</option>
<option value="Natural">Natural</option>
<option value="Ouro">Ouro</option>
<option value="Prata">Prata</option>
<option value="Preto">Preto</option>
<option value="Rosa">Rosa</option>
<option value="Roxo">Roxo</option>
<option value="Transparente">Transparente</option>
<option value="Verde">Verde</option>
<option value="Vermelho">Vermelho</option>
</select>
  </div>
  </div>
  <div class="col-2">
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">.</label>
    <button type="button" class="form-control btn btn-sucessbtn btn-danger del_vars">DEL</button>
  </div>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">IMG</label>
  <input type="text" class="form-control" name="variacao_img[]" value="'.$variacao_img[$i].'">
  </div>
    </div>

';


}
    ?>

    </div>





<div class="mb-3">
  <button type="submit" class=" btn btn-primary">GO</button>
</div>

<div class="mb-3">
<input type="hidden" name="do_csv" id="do_csv" value="false"/>
  <button type="button" id="makeCSV" class="btn btn-success">CSV</button>
</div>

</form>

</div>


<div class="col-6">

<p><span class="text-muted">TITULO: </span><br><?php echo $titulo_base; ?></p>

<p><span class="text-muted">URL: </span><?php echo $url; ?></p>

<p><span class="text-muted">DESCRIÇÃO: </span><?php echo $desc_base; ?></p>


<pre>
<?php

print_r($_POST);

?>

</pre>

</div>
</div>
<hr>
<div class="col-12">
<?php

echo "
<h5>$skuF<br>$t</h5>
<h5>$titulo<br>$t1</h5>


";


?>


</div>
<br>
<br>
<br>



<form id="form_upload" method="post" enctype="multipart/form-data">
  <input type="hidden" name="pasta" value="<?php echo $skuF; ?>"/>
  <input type="hidden" name="file_name_base" id="file_name_base" value="<?php echo $file_name_base; ?>"/>
  <input type="hidden" name="file_dir_base" id="file_dir_base" value="https://calcecomestilo.com/image/MKTPLACE/LADYLU/PULSEIRAS/<?php echo $skuF; ?>/"/>
<button type="submit" id="bt_upload" class="btn btn-sucessbtn btn-primary">UPLOAD</button>
<input type="file" name="fileToUpload[]" multiple id="inputI" accept="image/*" data-my="RR">
</form>

<div id="ret"></div>

<div class="container" id="imgC" style="display: flex">

</div>
<br>
<br>
<br>

<hr>
Imagem Pai
<button type="button" id="" base="-PAI" class="btn btn-sucessbtn btn-primary bt_get">GET</button>

<div class="container border " id="imgV-PAI" style="min-height: 150px;display: flex;" ondrop="drop(event)" ondragover="allowDrop(event)" >

</div>
<div id="retV-PAI"></div>

<div class="row">
<?php
   
for($i=0;$i< count($variacao_nome);$i++){
  ?>
 <div class="col-6">
Imagem Variacao <?php echo $variacao_nome[$i];?>
<button type="button" id="" base="-<?php echo $i;?>" base_id="<?php echo $i;?>" class="btn btn-sucessbtn btn-primary bt_get">GET</button>

<div class="container border " id="imgV-<?php echo $i;?>" style="min-height: 150px;display: flex;" ondrop="drop(event)" ondragover="allowDrop(event)" >

</div>
<div id="retV-<?php echo $i;?>"></div>
 </div>

<?php
}
?>

</div>
<br>
<br>
<br>
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/MDKFileReader.js"></script>
<script type="text/javascript" src="js/base.js"></script>



</body>
</html>





