<?php
header('Content-Type: text/html; charset=UTF-8');
?>
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

include "mdk_core.php";

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


$sku = (isset($_POST['sku']) ?$_POST['sku']: '');
$tamanho = (isset($_POST['tamanho']) ?$_POST['tamanho']: '');
$preco = (isset($_POST['preco']) ?$_POST['preco']: '');

$num_max = (isset($_POST['num_max']) ?$_POST['num_max']: '');
$num_min = (isset($_POST['num_min']) ?$_POST['num_min']: '');
$genero = (isset($_POST['genero']) ?$_POST['genero']: '');
$marca = (isset($_POST['marca']) ?$_POST['marca']: '');

$titulo = (isset($_POST['titulo']) ?$_POST['titulo']: '');
$descricao = (isset($_POST['descricao']) ?$_POST['descricao']: '');

$variacao_nome = (isset($_POST['variacao_nome']) ?$_POST['variacao_nome']: []);
$variacao_cor = (isset($_POST['variacao_cor']) ?$_POST['variacao_cor']: []);
$variacao_img = (isset($_POST['variacao_img']) ?$_POST['variacao_img']: []);


$img = (isset($_POST['img']) ?$_POST['img']: '');



$sku_lower = strtolower($sku);


$skuF = "LADYLU-P$tamanho-".to_sku($sku);
//$titulo = "Pulseira Articulada Feminina e Masculina $sku $tamanho"."MM LadyLu";

include "variaveis_calcado.php";

//$descricao = espaco($desc_base,$titulo,"<nome>");
//$descricao = espaco($descricao,$tamanho,"<tamanho>");

//$file_name_base = (isset($_POST['file_name_base']) ?$_POST['file_name_base']: '');
$file_name_base = to_file($titulo);


$t = "";
$t1 = "";


for($i=0;$i< count($variacao_nome);$i++){
$t .= $skuF."-V-".to_sku($variacao_nome[$i])."<br>";
$t1 .= "Cor:$variacao_cor[$i];Tamanho:Único;Gênero:Unissex<br>";


}


if(!is_dir($dir_img.$sku)){
  mkdir($dir_img.$sku, 0777, true);

}



function monta_var($sku,$cor,$img,$sku_ajuste){
  global $num_min, $num_max, $genero;
  $o = array();
  for ($i =$num_min; $i<= $num_max; $i++){
 
    $o1 = array();
    $o1["titulo"] = "Cor:$cor;Tamanho:$i;Gênero:$genero";;
    $o1["sku"] = "$sku_ajuste-T$i";
    $o1["img"] = $img;
    $o1["pai"]= "$sku";
  $o[]=$o1;
    
  }
  return $o;

}



$o = array();
$o_add = array();

  $o1 = array();
  
  $o1["titulo"] = "$titulo";
  $o1["sku"] = "$sku";
  $o1["img"] = $img;

  $o1["pai"]= "";

$o[]=$o1;

for ($ii=0;$ii< count($variacao_cor);$ii++){
$vc = $variacao_cor[$ii];
$vi = $variacao_img[$ii];
$ot1 = monta_var($sku,$vc,$vi,"$sku-V-C-$vc");
$o = array_merge($o,$ot1);
//$o[] = monta_var($sku,$vc,$vi,"$sku-V-C-$vc");

$oa = array();
$oa["titulo"] = "$titulo $vc";
$oa["sku"] = "$sku-C-$vc";
$oa["img"] = $vi;
$oa["pai"]= "";


$o_add[] = $oa;
$ot2 = monta_var("$sku-C-$vc",$vc,$vi,"$sku-C-$vc");
$o_add=array_merge($o_add,$ot2);
//$o_add[] = monta_var("$sku-C-$vc",$vc,$vi,"$sku-C-$vc");sd


}


$all= array();
$all["preco"] = $preco;
$all["descricao"] = $descricao;
$all["marca"]= "$myv_marca";
$all["cross"]= "$myv_crossDoc";
$all["ncm"]= $myv_ncm;
$all["tag"]= $myv_tag;
$all["peso"]=$myv_peso;
$all["altura"]=$myv_lardura;
$all["largura"]=$myv_altura;
$all["profunfidade"]=$myv_profundidade;


include "make_csv_calcado.php";



//

?>





<div class="row">
<div class="col-6">
<form method="post" id="form1">

<div class="row">

<div class="mb-3 col-3">
  <label for="exampleFormControlInput1" class="form-label">SKU</label>
  <input type="text" class="form-control" name="sku" value="<?php echo $sku; ?>" >
</div>

<div class="mb-3 col-9">
  <label for="exampleFormControlInput1" class="form-label">TITULO</label>
  <input type="text" class="form-control" name="titulo" value="<?php echo $titulo; ?>" >
</div>

</div>
<div class="row">

<div class="mb-3 col-3">
  <label for="exampleFormControlInput1" class="form-label">GENERO</label>
  <select class="form-control form-select" name="genero" data-selected="<?php echo $genero; ?>">
  <option value=""></option>
  <option value="Masculino">Masculino</option>
  <option value="Feminino">Feminino</option>
  <option value="Unissex">Unissex</option>
</select>
</div>

<div class="mb-3 col-3">
  <label for="exampleFormControlInput1" class="form-label">NUMERO MIN</label>
  <input type="text" class="form-control" name="num_min" value="<?php echo $num_min; ?>" >
</div>

<div class="mb-3 col-3">
  <label for="exampleFormControlInput1" class="form-label">NUMERO MAX</label>
  <input type="text" class="form-control" name="num_max" value="<?php echo $num_max; ?>" >
</div>

<div class="mb-3 col-3">
  <label for="exampleFormControlInput1" class="form-label">PREÇO</label>
  <input type="text" class="form-control" name="preco" value="<?php echo $preco; ?>" >
</div>


</div>




<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">DESCRICAO</label>
  <textarea class="form-control" id="descricao" name="descricao" rows="5"><?php echo $descricao; ?></textarea>
</div>

<div class="mb-3 col-6">
  <label for="exampleFormControlInput1" class="form-label">IMG PAI</label>
  <input type="text" class="form-control" name="img" id="img" value="<?php echo $img; ?>" >
</div>

<div class="mb-3">
  <button type="button" id="add_vars" class="btn btn-sucessbtn btn-primary">+ VARIAÇÃO</button>
</div>
    <div id="my_vars">
    <div class="row">

<div class="col-6">

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Nome da cor</label>
  <input type="text" class="form-control" name="variacao_nome[0]" value="<?php echo $variacao_nome[0]; ?>">
</div>
</div>
<div class="col-6">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Cor</label>
  
  <select class="form-control form-select" name="variacao_cor[0]" data-selected="<?php echo $variacao_cor[0]; ?>">
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


<div class="mb-3 col-12">
  <label for="exampleFormControlInput1" class="form-label">IMG</label>
  <input type="text" class="form-control" name="variacao_img[]"  value="<?php echo $variacao_img[0]; ?>" >
</div>


</div>


    <?php
   
for($i=1;$i< count($variacao_nome);$i++){
  
echo '
<hr>
<div class="row">

  <div class="col-6">

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nome</label>
    <input type="text" class="form-control" name="variacao_nome[]" value="'.$variacao_nome[$i].'">
  </div>
  </div>
  <div class="col-6">
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

  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">IMG</label>
  <input type="text" class="form-control" name="variacao_img[]" value="'.$variacao_img[$i].'">
  </div>
    </div>

';


}
    ?>

    </div>





<div class="d-grid gap-2 col-6 mx-auto m-5">
  <button type="submit" class=" btn btn-primary">SALVA SALVA OK</button>

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
<input class="form-control" type="text" name="img_index" id="img_index" value="0"/><br><p>cabra para trocar de pasta</p>
  <input class="form-control" type="text" name="pasta" value="<?php echo $sku; ?>"/><br><p>nome da pasta</p>
  <input class="form-control" type="text" name="file_name_base" id="file_name_base" value="<?php echo $file_name_base; ?>"/><br><p>base do nome</p>
  <input class="form-control" type="text" name="file_dir_base" id="file_dir_base" value="https://calcecomestilo.com/image/MKTPLACE/<?php echo $myv_pasta_img.'/'.$sku; ?>/"/><br><p>dir no servidor</p>
<button type="submit" id="bt_upload" class="btn btn-sucessbtn btn-primary">UPLOAD</button>
<input type="file" name="fileToUpload[]" multiple id="inputI" accept="image/*" data-my="RR">
</form>

<div id="ret"></div>

<div class="container sticky-top" id="imgC" style="display: flex">

</div>
<br>
<br>
<br>

<hr>

<!-- <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>

<div class="card text-bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>

<div class="card text-bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
 -->
Imagem Pai
<button type="button" id="" base="-PAI" class="btn btn-sucessbtn btn-primary bt_get">GET</button>
<div id="retV-PAI"class="m-5"></div>
<div class="container border " id="imgV-PAI" style="min-height: 150px;display: flex;" ondrop="drop(event)" ondragover="allowDrop(event)" >

</div>

<hr>
<div class="row">
<?php
   
for($i=0;$i< count($variacao_nome);$i++){
  ?>
  
 <div class="col-12">
Imagem Variacao <?php echo $variacao_nome[$i];?>
<button type="button" id="" base="-<?php echo $i;?>" base_id="<?php echo $i;?>" class="btn btn-sucessbtn btn-primary bt_get">GET</button>
<div id="retV-<?php echo $i;?>" class="m-5"></div>
<div class="container border " id="imgV-<?php echo $i;?>" style="min-height: 150px;display: flex;" ondrop="drop(event)" ondragover="allowDrop(event)" >

</div>

 </div>
 <hr>
<?php
}
?>

</div>
<br>
<br>
<br>



<hr>

<button class="btn btn-primary" id="btn_teste">TESTE</button>

<div id="teste">

<?php



echo "<p>DADOS VALIDOS PRA TODOS</p>";
trace($all);
echo "<p>FEED</p>";
trace($o);
echo "<p>FEED ADICIONAL</p>";
trace($o_add);



?>

</div>





<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/MDKFileReader.js"></script>
<script type="text/javascript" src="js/base_calcado.js"></script>



</body>
</html>





