<?php
include 'preencher.php';
include 'conexao.php';


    $rs = "SELECT $columns FROM $nometabela ORDER BY $v[1]";
    $retorno_query = $conn->prepare($rs);
    $retorno_query->execute();

    //Inicio tabela
    echo "<table><tr>";
    echo "<th></th>";
    for($i = 1; $i <= $contador_colunas; $i++){
        echo "<th>".$v[$i]."</th>";
    }
    echo "</tr><tr>";
    while($row_cont = $retorno_query->fetch(PDO::FETCH_ASSOC)) {
        echo "<th><input type=\"checkbox\" id=\"v$i\" name=\"v$i\" /></th>";
        for($i = 1; $i <= $contador_colunas; $i++){
            echo "<th>".$row_cont[$v[$i]]."</th>";
        }
        echo "</tr>";
    }
    echo "</table>";


$conn = null;
?>