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

    <!-- OFFLINE -->
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

    <title>Hórus PDV - Relatórios</title>
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
                            <h5 class="card-title">Relatórios</h5>
                            <p class="card-text">
                                Exporte cadastros de clientes, fornecedores, produtos e vendas.
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

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <form  id="form_relatorio" method="POST">
                <label for="">Selecione a Categoria</label>
                <select class="form-control mb-2" name="categoria_relatorio" id="categoria_relatorio">
                    <option value="">Selecione um relatório</option>
                    <option value="rel_clientes">Relatório de Clientes</option>
                    <option value="rel_fornecedores">Relatório de Fornecedores</option>
                    <option value="rel_produtos">Relatório de Produtos</option>
                    <option value="rel_vendas">Relatório de Vendas</option>
                </select>
                
                <label for="">Selecione o Período</label>
                <select class="form-control" name="periodo_relatorio" id="periodo_relatorio" disabled>
                    <script>
                        $('#categoria_relatorio').on('change', function(){
                            let categoria = $(this).val();
                            
                            if (categoria == ''){
                                $('#periodo_relatorio').attr('disabled', true);
                                $('#btn_gerar_relatorio').attr('disabled', true);
                                $('#periodo_relatorio').html('');

                            }else if(categoria == 'rel_vendas'){
                                $('#periodo_relatorio').removeAttr('disabled'); 
                                $('#btn_gerar_relatorio').removeAttr('disabled');
                                $('#periodo_relatorio').html('');
                                $('#periodo_relatorio').append('<option value="todos_anos">Todos</option>');
                                <?php 
                                    require_once '../pdv/conexao.php';
                                    $conexao = new Conexao();
                                    $conexao = $conexao->conectar();
                                    $query = 'SELECT DISTINCT(YEAR(data_hora_venda)) AS ano FROM tb_vendas';
                                    $resultado = $conexao->query($query);
                                    while($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
                                        echo '$("#periodo_relatorio").append("<option value='.$linha['ano'].'>'.$linha['ano'].'</option>");';
                                    }
                                ?> 
                            }else{
                                $('#periodo_relatorio').removeAttr('disabled');
                                $('#btn_gerar_relatorio').removeAttr('disabled');
                                $('#periodo_relatorio').html(`
                                    <option value="todos">Todos</option>
                                `); 
                                
                            }
                        });     
                    </script>
                </select>
                 <button type="button" onclick="gerarRelatorio()" class="btn btn-primary" id="btn_gerar_relatorio" disabled>Gerar Relatório</button>

                </form>                
            </div>
        </div>
    </section>

    <script src="js/pdv.js"></script>
</body>
</html>
