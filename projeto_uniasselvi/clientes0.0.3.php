<?php
include('_php/conexao.php');

//itens por pagina
$itens_por_pagina = 20;
//$itens_por_pagina = isset($_POST['items_por_pagina']);

//pagina atual
$pagina = intval($_GET['pagina']);

//select no banco
$sql_code = "select * from clientes LIMIT $pagina, $itens_por_pagina";
$retorno_query = $conn->prepare($sql_code);
$retorno_query->execute();
$list = $retorno_query->fetch(PDO::FETCH_ASSOC);
$num = $retorno_query->rowCount();

//total de objetos no banco
$retorno_query2 = $conn->prepare("select * from clientes");
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
        <script type="text/javascript">
            function onSelectChange(x){
                console.log(x);
                window.location.href = "clientes.php?name=" + x;
                
            }
        </script>
        <div id="interface">
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
                <form action="" method="POST">
                <select name="itens" onchange="onSelectChange(value);">
                    <option selected>Itens por página</option>
                    <option value="1">10</option>
                    <option value="2">20</option>
                    <option value="3">30</option>
                    <option value="4">40</option>
                    <option value="5">50</option>
                </select>
                </form>
                <?php $itens_por_pagina = isset($_GET['name'])?> <?php echo $itens_por_pagina?>;
            </section>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Clientes</h1>
                    <?php if($num>0){?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>   </td>
                                    <td>Código Cliente</td>
                                    <td>Nome</td>
                                    <td>CPF</td>
                                    <td>E-mail</td>
                                    <td>Editar</td>
                                    <td>Excluir</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php do{ ?>
                                <tr>
                                    <td><input type="checkbox" name="clientes_check" value="<?php echo $list['CodCliente'] ?>"></td>
                                    <td><?php echo $list['CodCliente']?></td>
                                    <td><?php echo $list['NomeCliente']?></td>
                                    <td><?php echo $list['CPF']?></td>
                                    <td><?php echo $list['Email']?></td>
                                    <td>Editar</td>
                                    <td>Excluir</td>
                                </tr>
                                <?php } while($list = $retorno_query->fetch(PDO::FETCH_ASSOC)); ?>
                            </tbody>
                        </table> 
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                            <a class="page-link" href="clientes.php?pagina=0" tabindex="-1" aria-disabled="true">Primeira</a>
                            </li>
                            <?php for($i=0;$i<$num_paginas;$i++) { 
                                $estilo = "";
                                if($pagina == $i) {
                                    $estilo = "class\"active\"";
                                }
                                ?>
                            <li <?php echo $estilo; ?>><a class="page-link" href="clientes.php?pagina=<?php echo $i* $itens_por_pagina; ?>"><?php echo $i+1 ?></a></li>

                            <?php } ?>
                            <a class="page-link" href="clientes.php?pagina=<?php echo $num_paginas+$itens_por_pagina?>">Ultima</a>
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