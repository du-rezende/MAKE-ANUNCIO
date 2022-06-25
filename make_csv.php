<?php
///pai


function ma_cvs($v_skuF,$v_titulo,$v_preco,$v_pai,$v_descricao,$v_img){
    $csv= [];
    $csv[]="";
    $csv[]="$v_skuF";
    $csv[]='"'.$v_titulo.'"';
    $csv[]="UN";
    $csv[]="7117";
    $csv[]="0";
    $csv[]="$v_preco";
    $csv[]="0,00";
    $csv[]="";
    $csv[]="Ativo";
    $csv[]="500";
    $csv[]="$v_preco";
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="0,00";
    $csv[]="0,00";
    $csv[]="0,100";
    $csv[]="0,100";
    $csv[]="";
    $csv[]="";
    $csv[]="19.00";
    $csv[]="5.00";
    $csv[]="19.00";
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="1,00";
    $csv[]="Produto";
    $csv[]="Própria";
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="Grupo:MDK-LADYLU";
    $csv[]="0,00";
    $csv[]="$v_pai";
    $csv[]="0";
    $csv[]="";
    $csv[]="LADY LU";
    $csv[]="";
    $csv[]="1";
    $csv[]="$v_descricao";
    $csv[]="0";
    $csv[]="$v_img";
    $csv[]="";
    $csv[]="0";
    $csv[]="NÃO";
    $csv[]="NOVO";
    $csv[]="NÃO";
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="Metros";
    $csv[]="0,00";
    $csv[]="0,0000";
    $csv[]="0,0000";
    $csv[]="0,0000";
    $csv[]="";
    $csv[]="dd";
    $csv[]="";

    return implode(";", $csv);


}



if(isset($_POST['do_csv']) && $_POST['do_csv']== "true"){




//head

    $csv_head=[];
    $csv_head[]="ID";
    $csv_head[]="Código";
    $csv_head[]="Descrição";
    $csv_head[]="Unidade";
    $csv_head[]="NCM";
    $csv_head[]="Origem";
    $csv_head[]="Preço";
    $csv_head[]="Valor IPI fixo";
    $csv_head[]="Observações";
    $csv_head[]="Situação";
    $csv_head[]="Estoque";
    $csv_head[]="Preço de custo";
    $csv_head[]="Cód no fornecedor";
    $csv_head[]="Fornecedor";
    $csv_head[]="Localização";
    $csv_head[]="Estoque maximo";
    $csv_head[]="Estoque minimo";
    $csv_head[]="Peso líquido (Kg)";
    $csv_head[]="Peso bruto (Kg)";
    $csv_head[]="GTIN/EAN";
    $csv_head[]="GTIN/EAN da embalagem";
    $csv_head[]="Largura do Produto";
    $csv_head[]="Altura do Produto";
    $csv_head[]="Profundidade do produto";
    $csv_head[]="Data Validade";
    $csv_head[]="Descrição do Produto no Fornecedor";
    $csv_head[]="Descrição Complementar";
    $csv_head[]="Unidade por Caixa";
    $csv_head[]="Produto Variação";
    $csv_head[]="Tipo Produção";
    $csv_head[]="Classe de enquadramento do IPI";
    $csv_head[]="Código da lista de serviços";
    $csv_head[]="Tipo do item";
    $csv_head[]="Grupo de Tags/Tags";
    $csv_head[]="Tributos";
    $csv_head[]="Código Pai";
    $csv_head[]="Código Integração";
    $csv_head[]="Grupo de produtos";
    $csv_head[]="Marca";
    $csv_head[]="CEST";
    $csv_head[]="Volumes";
    $csv_head[]="Descrição Curta";
    $csv_head[]="Cross-Docking";
    $csv_head[]="URL Imagens Externas";
    $csv_head[]="Link Externo";
    $csv_head[]="Meses Garantia no Fornecedor";
    $csv_head[]="Clonar dados do pai";
    $csv_head[]="Condição do produto";
    $csv_head[]="Frete Grátis";
    $csv_head[]="Número FCI";
    $csv_head[]="Vídeo";
    $csv_head[]="Departamento";
    $csv_head[]="Unidade de medida";
    $csv_head[]="Preço de compra";
    $csv_head[]="Valor base ICMS ST para retenção";
    $csv_head[]="Valor ICMS ST para retenção";
    $csv_head[]="Valor ICMS próprio do substituto";
    $csv_head[]="Categoria do produto";
    $csv_head[]="Informações Adicionais";
    $csv_head[]="";

    $csv_headS = implode(";", $csv_head);

    $SS = $csv_headS."\n";

    //$SS .= ma_cvs($skuF,$titulo,$preco,$pai,$descricao,$img)."\n";
    $SS .= ma_cvs($skuF,$titulo,$preco,"",$descricao,$img)."\n";

//variação


for($i=0;$i< count($variacao_nome);$i++){

$t = $skuF."-V-".to_sku($variacao_nome[$i]);
$t1 = "Cor:$variacao_cor[$i];Tamanho:Único;Gênero:Unissex";
$SS .= ma_cvs($t,$t1,$preco,$skuF,$descricao,$variacao_img[$i])."\n";

//gera anuncio da variação

$z = $skuF."-".to_sku($variacao_nome[$i]);
$z1 = "Pulseira Articulada Feminina e Masculina $sku $variacao_nome[$i] $tamanho"."MM LadyLu";
$SS .= ma_cvs($z,$z1,$preco,"",$descricao,$variacao_img[$i])."\n";

}






$csv_handler = fopen ("csv/csvfile_$skuF.csv",'w');
fwrite ($csv_handler,$SS);
fclose ($csv_handler);

}