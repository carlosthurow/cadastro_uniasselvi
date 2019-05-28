<?php
include('conexao.php');

//nome tabela
$nometabela = "clientes";
$where = "";
if ((isset($_POST["CodCliente"])) && ($_POST["CodCliente"] != "")) {
    $cod_cliente = $_POST["CodCliente"];
    $where .= "CodCliente = '$cod_cliente'"; 
};
if ((isset($_POST["NomeCliente"])) && ($_POST["NomeCliente"] != "")) {
    $nom_cliente = $_POST["NomeCliente"];
    $where .= "and NomeCliente like '%$nom_cliente%'"; 
};
if ((isset($_POST["CPF"])) && ($_POST["CPF"] != "")) {
    $cpf = $_POST["CPF"];
    $where .= "and CPF like '%$cpf%'"; 
};
if ((isset($_POST["Email"])) && ($_POST["Email"] != "")) {
    $email = $_POST["Email"];
    $where .= "and Email like '%$email%'"; 
};
$where = ltrim($where,'and ');

echo $where;
//itens por pagina
$itens_por_pagina = 2;

//pagina atual
$pagina = intval($_GET['pagina']);
$ordem = $ordem = "order by CodCliente asc";
if (isset($_GET["order"])) {
    $order = $_GET["order"];
    switch ($order) {
        case 2:
        $ordem = "order by NomeCliente asc";
        break;
        case 3:
        $ordem = "order by CPF asc";
        break;
        case 4:
        $ordem = "order by Email asc";
        break;
        default:
        $ordem = "order by CodCliente asc";
    }
}




//select no banco
if ($where == "") {
    $sql_code = "select * from $nometabela $ordem LIMIT $pagina, $itens_por_pagina";
}else {
    $sql_code = "select * from $nometabela where $where $ordem LIMIT $pagina, $itens_por_pagina";
}
$retorno_query = $conn->prepare($sql_code);
$retorno_query->execute();
$list = $retorno_query->fetch(PDO::FETCH_ASSOC);
$num = $retorno_query->rowCount();

//total de objetos no banco
if ($where == "") {
    $retorno_query2 = $conn->prepare("select * from $nometabela");
}else {
    $retorno_query2 = $conn->prepare("select * from $nometabela where $where");
}
$retorno_query2->execute();
$num_total = $retorno_query2->rowCount();

//numero de paginas
$num_paginas = ceil($num_total/$itens_por_pagina);



?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
    <title>Projeto Uniasselvi</title>
        
  </head>
    <body>
        <!--<div id="interface">
            <header id="cabecalho">
                <nav id="menu">
                    <h1>Menu Principal</h1>
                    <ul type="disc">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="clientes.html">Clientes</a></li>
                        <li><a href="produtos.html">Produtos</a></li>
                        <li><a href="pedidos.html">Pedidos</a></li>
                    </ul>
                </nav>
            </header>
            <section id="corpo">
                <form method="POST" action="_php/insert.php">
                    <input type="hidden" name="nometabela" value="clientes"/>
                    <input type="hidden" name="v1" value="CodCliente"/>
                    <input type="hidden" name="v2" value="NomeCliente"/>
                    <input type="hidden" name="v3" value="CPF"/>
                    <input type="hidden" name="v4" value="Email"/>
                    Nome: <input type="text" name="NomeCliente"/>
                    Cpf: <input type="text" name="CPF"/>
                    Email: <input type="text" name="Email"/>
                    <input type="submit" value="Inserir"/>                    
                </form>
                <form method="POST" action="_php/paginacao.php">
                    <input type="hidden" name="nometabela" value="clientes"/>
                    <input type="hidden" name="v1" value="CodCliente"/>
                    <input type="hidden" name="v2" value="NomeCliente"/>
                    <input type="hidden" name="v3" value="CPF"/>
                    <input type="hidden" name="v4" value="Email"/>
                    <input type="submit" value="Localizar"/>
                </form>
            </section>
        </div>-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Clientes</h1>
                    <form method="POST" action="
                    
                    
                    ">
                    Nome: <input type="text" name="NomeCliente"/>
                    Cpf: <input type="text" name="CPF"/>
                    Email: <input type="text" name="Email"/>
                    <input type="submit" value="Pesquisar"/>
                    </form> 
                    <?php if($num>0){?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>   </td>
                                    <td><a href="?order=1">Código Cliente</td>
                                    <td><a href="?order=2">Nome</td>
                                    <td><a href="?order=3">CPF</td>
                                    <td><a href="?order=4">E-mail</td>
                                    <td>Editar</td>
                                    <td>Excluir</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php do{ ?>
                                <tr>
                                    <td><input type="checkbox" name="check" value="ch<?php echo $list['CodCliente'] ?>"></td>
                                    <td><?php echo $list['CodCliente']?></td>
                                    <td><?php echo $list['NomeCliente']?></td>
                                    <td><?php echo $list['CPF']?></td>
                                    <td><?php echo $list['Email']?></td>
                                    <td><form method="get" action="editar.php">
                                    <input type="hidden" name="editar_input" value="ed<?php echo $list['CodCliente'] ?>"/>
                                    <input type="hidden" name="editar_tabela" value="clientes"/>
                                    <input type="submit" value="Editar"/>
                                    </form></td>
                                    <td><form method="get" action="excluir.php">
                                    <input type="hidden" name="excluir_input" value="ex<?php echo $list['CodCliente'] ?>"/>
                                    <input type="hidden" name="excluir_tabela" value="clientes"/>
                                    <input type="submit" value="Excluir"/>
                                    </form></td>
                                </tr>
                                <?php } while($list = $retorno_query->fetch(PDO::FETCH_ASSOC)); ?>
                            </tbody>
                        </table> 
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <?php for($i=0;$i<$num_paginas;$i++) { 
                                $estilo = "";
                                if($pagina == $i) {
                                    $estilo = "class\"active\"";
                                }
                                ?>
                            <li <?php echo $estilo; ?>><a class="page-link" href="clientes.php?pagina=<?php echo $i* $itens_por_pagina; ?>"><?php echo $i+1 ?></a></li>
                            <?php } ?>
                            </li>
                        </ul>
                        </nav>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>