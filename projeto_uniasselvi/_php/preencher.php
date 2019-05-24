<?php
include_once 'conexao.php';
include_once 'colunas_linhas.php';
$nometabela = $_POST["nometabela"];
$col = $contador_colunas;
$values = "";
$columns = "";


#Preencher nome das colunas
for($i = 1; $i<=$col; $i++) {
    if(isset($_POST["v$i"])){
    $v[$i] = $_POST["v$i"];
    }
}

#Preencher dados 
for($i = 1; $i<=sizeof($v); $i++) {
    if(isset($_POST[$v[$i]])){
    $var[$i] = $_POST[$v[$i]];
    }
}

#Preencher columns
for($i = 1; $i<=$col; $i++) {
    if(isset($v[$i])){
        $columns .= "$v[$i], ";
    }
}
$columns = rtrim($columns,', ');

#Preencher values
for($i = 1; $i<=$col; $i++) {
    if ($i == 1){
        $values = "default, ";
    }elseif(isset($var[$i])){
        $values .= "'$var[$i]', ";
    }
}
$values = rtrim($values,', ');
?>