<?php 

include ('connections/conn.php');

$buscar_user = $_GET['buscar'];

//echo "<h1>Resultados para: $buscar_user</h1>";
$consulta = "select * from vw_tbprodutos where descri_produto like'. 
$buscar_user.' order by descri_produto asc";
$lista = $conn->query($consulta);
$linha = $lista->fetch_assoc();
$totalLinhas = $lista->num_rows;


/* <table>
    <?php do{ ?>
        <tr>
            <td><?php echo $linha['descri_produto']?></td>
            <td><?php echo $linha['valor_produto']?></td>
        </tr>
    <?php } while ($linha-$lista->fetch_assoc()) ?>
</table> */
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/meu_estilo.css" type="text/css">
    <title>Busca de Produtos</title>
</head>
<body class="fundofixo" >
    <?php include('menu_publico.php');?>
    <main class="container" >
        <!-- Mostrar se a consulta retornar vazio -->
        <?php if($linha == null){?>
            <h2 class="breadcrumb alert-danger" >
                <a href="javascript: window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left" ></span>
                </a>
                Você Pesquisou:
                <strong><i><?php echo $buscar_user;?></i></strong>
                <br>
                A busca não retornou nenhum produto. Em breve atualizaremos.
            </h2>
            <?php }?>
            
            <!-- fecha se a consulta retornar algum resultado -->
            <!-- Mostra os registros se a consulta retornar vazio -->
            <?php if($totalLinhas > 0 && $linha != null)?>
            <h2 class="breadcrumb alert-danger" >
                <a href="javascript: window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left" ></span>
                </a>
                Você Pesquisou:
                <strong><i><?php echo $buscar_user;?></i></strong>
            </h2>
            <div class="row"><!-- Manter os elementos na linha -->
                <!-- Abre estrutura de repetição -->
                <?php do {?>
                <!-- Abre thumbnail/card -->
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="produtos_busca.php?id_produto=<?php echo $linha['id_produto'] ?>">
                            <img src="images/<?php echo $linha['imagem_produto']; ?>" alt="" class="img-responsive img-rounded" >
                        </a>
                        <div class="caption text-right" >
                            <h3 class="text-danger" >
                                <strong>
                                    <?php echo ($linha['descri_produto']); ?>
                                </strong>
                            </h3>
                            <p class="text-warning">
                                <strong>
                                    <?php echo ($linha['rotulo_tipo']);?>
                                </strong>
                            </p>
                            <p class="text-left">
                               <span> <?php echo mb_strimwidth($linha['resumo_produto'],0,42,'...');?> </span> 
                            </p>
                            <p>
                                <button class="btn btn-default disabled" style="cursor: default;" role="button" >
                                    <?php echo number_format($linha['valor_produto'],2,',',',');?>
                                </button>
                                <a href="produtos_busca.php?id_produto=<?php echo $linha['id_produto'] ?>">
                                    <span class="hidden-xs">Saiba mais... </span>
                                    <span class="visible-xs glyphicon glyphicon-eye-open " aria-hidden="true" ></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div><!-- Fecha thumbnail -->
                <?php } while ($linha=$lista->fetch_assoc()); ?>
            </div><!-- Fechar os elementos na linha -->
                    

        <footer>
            <?php include('rodape.php');?>
        </footer>
    </main>


    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
<!-- links dos arquivos bootstrap js -->


</html>
