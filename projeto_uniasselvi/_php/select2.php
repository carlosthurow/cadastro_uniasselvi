<?php
include 'conexao.php';

$nome = isset($_POST['NomeCliente']);

//nome tabela
$nometabela = "clientes";

//itens por pagina
$itens_por_pagina = 2;

//pagina atual
$pagina = intval($_GET['pagina']);

//select no banco
$sql_code = "select * from $nometabela LIMIT $pagina, $itens_por_pagina where NomeCliente = '$nome'";
$retorno_query = $conn->prepare($sql_code);
$retorno_query->execute();
$list = $retorno_query->fetch(PDO::FETCH_ASSOC);
$num = $retorno_query->rowCount();

//total de objetos no banco
$retorno_query2 = $conn->prepare("select * from $nometabela");
$retorno_query2->execute();
$num_total = $retorno_query2->rowCount();

//numero de paginas
$num_paginas = ceil($num_total/$itens_por_pagina);


$conn = null;
?>