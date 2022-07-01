<?php
///pai


function ma_cvs($d){


global $all;


    $csv= [];
    $csv[]="";
    $csv[]=$d["sku"];
    $csv[]='"'.$d["titulo"].'"';
    $csv[]="UN";
    $csv[]=$all["ncm"];
    $csv[]="0";
    $csv[]=$all["preco"];
    $csv[]="0,00";
    $csv[]="";
    $csv[]="Ativo";
    $csv[]="500";
    $csv[]=$all["preco"];
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="0,00";
    $csv[]="0,00";
    $csv[]=$all["peso"];
    $csv[]=$all["peso"];
    $csv[]="";
    $csv[]="";
    $csv[]=$all["largura"];
    $csv[]=$all["altura"];
    $csv[]=$all["profundidade"];
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]="1,00";
    $csv[]="Produto";
    $csv[]="Própria";
    $csv[]="";
    $csv[]="";
    $csv[]="";
    $csv[]=$all["tag"];
    $csv[]="0,00";
    $csv[]=$d["pai"];
    $csv[]="0";
    $csv[]="";
    $csv[]=$all["marca"];
    $csv[]="";
    $csv[]="1";
    $csv[]='"'.$all["descricao"].'"';
    $csv[]=$all["cross"];
    $csv[]=$d["img"];
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
    $csv[]="";
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

 

foreach($o as $d){

    $SS .= ma_cvs($d)."\n";

}
foreach($o_add as $d){

    $SS .= ma_cvs($d)."\n";

}


$csv_handler = fopen ("csv/shoes/csvfile_$sku.csv",'w');
fwrite ($csv_handler,utf8_decode($SS));
fclose ($csv_handler);

}