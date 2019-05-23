<?php
include_once 'dados_conexao.php';
$nometabela = $_POST["nometabela"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM $nometabela"); 
    $stmt->execute();

    $contador_colunas = $stmt->columnCount();
    $contador_linhas = $stmt->rowCount();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>