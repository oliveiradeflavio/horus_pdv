<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header("Location: login.php?login=2");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!--------- ONLINE -------->
    <!-- cdn bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

     //jquery mask 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    //fontawesome
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script> -->
    <!------- FIM ONLINE ------>

    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

    <!-- jquery mask -->
    <script src="js/jquery.mask.min.js"></script>

    <!-- fontawesome-->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

     <!-- sweetalert2 -->
     <link rel="stylesheet" href="css/sweetalert2.min.css">
     <script src="js/sweetalert2.all.min.js"></script>   
       <!------------ FIM OFFLINE ------------->

     <!-- css -->
     <link rel="stylesheet" href="css/index.css">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Histórico de Vendas</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <i class="fa-solid fa-ellipsis"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <div class="dropdown">
                        <img src="../pdv/img/usuarios/<?= $_SESSION['foto_usuario'] ?>" alt="" width="50" height="50" class="img-circulo">
                        <div class="dropdown-content mr-5">
                            <a><?php echo $_SESSION['nome_usuario'] ?></a>
                            <div class="dropdown-divider"></div>
                            <a href="perfil_usuario.php">Meu Perfil</a>
                            <?php if ($_SESSION['perfil_usuario'] == 1) : ?>
                                <a href="configuracoes.php">Configurações</a>
                            <?php endif; ?>
                            <a href="sobre.php">Sobre</a>
                            <a href="logout.php">Sair</a>
                        </div>
                    </div>

                </ul>

            </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id='menu-dashboard'>
                        <div class="card-body">
                            <h5 class="card-title">Histórico de Vendas</h5>
                            <p class="card-text">
                                Procure pelo histórico de vendas do seu PDV.
                            </p>
                            <button onclick="location.href='index.php'" class="btn btn-primary">Dashboard</button>
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cadastros
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="cad_clientes.php" class="dropdown-item">Cadastrar Clientes</a>
                                <a href="cad_fornecedores.php" class="dropdown-item">Cadastrar Fornecedores</a>
                                <a href="cad_produtos.php" class="dropdown-item">Cadastrar Produtos</a>
                            </div>

                            <button onclick="location.href='historico_venda.php'"class="btn btn-primary">Histórico</button>
                            <button onclick="location.href='relatorios.php'" class="btn btn-primary">Relatórios</button>
                            <button onclick="window.open('venda.php', '_blank')" class="btn btn-primary">Iniciar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container centro mt-5" id="campo_pesquisa">
            <div class="row">
                <div class="col-md-12">
                <form method="GET" action="?#campo_pesquisa" id='pesquisar_dados'>
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded input_pesquisar" name="buscar" id="inputPesquisaHistorico" placeholder="Número do Pedido" onchange="verificarCampoPesquisa()" />
                            <button type="button" onclick="verificarCampoPesquisa()" class="input-group-text border-0" id="botaoPesquisar">
                                <i class="fas fa-search"></i>
                            </button>
                            <i class="fa-solid fa-circle-question icone_fontawesome ml-3" id="ajuda_historico_venda" style="cursor: pointer" onclick="ajuda_cadastro()"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if(isset($_GET['buscar'])){?>

          <?php
            require_once '../pdv/conexao.php';
            $conexao = new Conexao();
            $conexao = $conexao->conectar();            
            $buscar = $_GET['buscar'];
            if($buscar == "%"){
                $query = "SELECT * FROM tb_vendas ORDER BY data_hora_venda DESC";
                $stmt = $conexao->prepare($query);                
                $stmt->execute();
            }else{
                $query = "SELECT * FROM tb_vendas WHERE numero_da_venda_venda = :buscar";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':buscar', $buscar);
                $stmt->execute();
            }
           
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            if(count($resultado) <= 0){
                ?>
                 <div class="d-flex justify-content-center col-md-12" role="alert">
                    <img class="img-fluid" width="400" height="400" src="img/not-found.jpg" id='imagem_arquivo_not_found' alt="">
                <?php
            }else {
                ?>
                <div id="loading"></div>
                <div class="container col-md-10">
                   
                    <table class="table table-sm table-hover table-responsive p-3 mt-5" id="tabela_historico_venda">
                        <thead>
                            <tr>
                                <th scope="col">Número da Venda</th>
                                <th scope="col">Nome do Cliente</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor Unitário</th>
                                <th scope="col">Valor Total</th>
                                <th scope="col">Total da Venda</th>
                                <th scope="col">Tipo de PG</th>
                                <th scope="col">Desconto</th>
                                <th scope="col">Total com Desconto</th>
                                <th scope="col">Código PG com Cartão</th>
                                <th scope="col">Data da Venda</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($resultado as $key => $historico){?>
                            <tr>
                                <td><?php echo $historico->numero_da_venda_venda; ?></td>
                                <td><?php echo $historico->nome_cliente_venda; ?></td>
                                <td><?php echo $historico->produto_venda; ?></td>
                                <td><?php echo $historico->quantidade_venda; ?></td>
                                <td><?php echo $historico->valor_produto_unitario_venda; ?></td>
                                <td><?php echo $historico->valor_produto_total_venda; ?></td>
                                <td><?php echo $historico->total_venda_valor_bruto_venda;?></td>
                                <td><?php echo $historico->tipo_de_pagamento_venda; ?></td>
                                <td><?php echo $historico->desconto_venda_venda; ?></td>
                                <td><?php echo $historico->total_venda_atual_com_desconto_venda; ?></td>
                                <td><?php echo $historico->codigo_pagamento_cartao_venda; ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($historico->data_hora_venda)); ?></td>

                                <td><i class="fa-solid fa-file-arrow-down icone_fontawesome" onclick="download_pedido(<?= $historico->numero_da_venda_venda ?>)" style="cursor: pointer"></i></td>
                            </tr>
                        </tbody>
                            <?php
                                
                                }
                                }
                            }   
                        ?>
                    </table>

    </section>


    <script src="js/pdv.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
