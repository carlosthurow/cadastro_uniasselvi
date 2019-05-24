<?php
include_once 'conexao.php';

//Inicio paginacao


    $total_reg = "2";

    $pagina=$_GET['pagina'];
    if (!$pagina) {
        $pc = "1";
    } else {
        $pc = $pagina;
    }

    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;

    $busca = "SELECT * FROM clientes";
    $limite = $conn->prepare($busca." LIMIT $inicio,$total_reg");
    $limite->execute();
    $todos = $conn->prepare($busca);
    $todos->execute();
    
    

    

    
    $tr = $todos->rowCount(); // verifica o número total de registros
    $tp = $tr / $total_reg; // verifica o número total de páginas
    
    // vamos criar a visualização
    while ($dados = $limite->fetch(PDO::FETCH_ASSOC)){
    $nome = $dados["CodCliente"];
    echo "Nome: $nome<br>";
    }
    
    // agora vamos criar os botões "Anterior e próximo"
    $anterior = $pc -1;
    $proximo = $pc +1;
    if ($pc>1) {
    echo " <a href='?pagina=$anterior'><- Anterior</a> ";
    }
    echo "|";
    if ($pc<$tp) {
    echo " <a href='?pagina=$proximo'>Próxima -></a>";
    }

$conn = null;
?>