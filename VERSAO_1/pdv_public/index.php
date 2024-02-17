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

    <title>Hórus PDV - Home</title>
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
                            <h5 class="card-title">Bem vindo ao Hórus PDV</h5>
                            <p class="card-text">
                                O Hórus PDV é um sistema de gestão de vendas para pequenas e médias empresas.
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


                            <button onclick="location.href='historico_venda.php'" class="btn btn-primary">Histórico</button>
                            <button onclick="location.href='relatorios.php'" class="btn btn-primary">Relatórios</button>
                            <button onclick="window.open('venda.php', '_blank')" class="btn btn-primary">Iniciar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mb-3">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Cadastros Realizados</h5>
                        </div>
                        <div class='card-body centro' id="chart_div_cadastros" style="height: 400 ; width: 600;"></div>

                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Vendas Realizadas</h5>
                        </div>
                        <div class='card-body centro' id="chart_div_vendas"></div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3">
            <?= date("Y") ?> <i class="fa-solid fa-code"></i>
            <a href="sobre.php">Flávio Oliveira</a>
        </div>
  <!-- Copyright -->
    </footer>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Gráficos Google Charts -->
    <script>
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChartVendas);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Registers'],
                <?php
                require_once '../pdv/conexao.php';
                $conexao = new Conexao();
                $conexao = $conexao->conectar();
                $query = "SELECT COUNT(*) FROM tb_clientes";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(count($result) > 0){
                    foreach ($result as $row) {
                        echo "['Clientes', " . $row[0] . "],";
                    }
                }else{
                    echo "['Clientes', 0],";                
                }

                $query = "SELECT COUNT(*) FROM tb_fornecedores";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(count($result) > 0){
                    foreach ($result as $row) {
                        echo "['Fornecedores', " . $row[0] . "],";
                    }
                }else{
                    echo "['Fornecedores', 0],";                
                }                

                $query = "SELECT COUNT(*) FROM tb_produtos";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(count($result) > 0){
                    foreach ($result as $row) {
                        echo "['Produtos', " . $row[0] . "],";
                    }
                }else{
                    echo "['Produtos', 0],";                
                }
               
                $query =  "SELECT COUNT(*) FROM  tb_usuarios";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(count($result) > 0){
                    foreach ($result as $row) {
                        echo "['Usuários', " . $row[0] . "],";
                    }
                }else{
                    echo "['Usuários', 0],";                
                }               
                ?>

            ]);

            var options = {
                pieHole: 0.3,
                //is3D: true,
                //pieSliceText: 'value',
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div_cadastros'));
            chart.draw(data, options);
        }

        function drawChartVendas() {
            var data_vendas = google.visualization.arrayToDataTable([

                ['Year', 'Vendas'],
                //Pego todos os anos que existem no banco de dados, usando o DISTINCT.
                <?php  
                $query = 'SELECT DISTINCT(YEAR(data_hora_venda)) AS ano FROM tb_vendas';
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $todos_anos = $stmt->fetchAll();
                if(count($todos_anos) > 0){
                    foreach ($todos_anos as $ano) {
                        $query = "SELECT COUNT(`numero_da_venda_venda`) FROM tb_vendas WHERE YEAR(`data_hora_venda`) = :ano";
                        $stmt = $conexao->prepare($query);
                        $stmt->bindValue(':ano', $ano['ano']);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $row) {
                            echo "['" . $ano['ano'] . "', " . $row[0] . "],";
                        }
                    }
                }else{
                    echo "['0', 0],";
                }
               

                ?>
            ]);

            var options = {
                title: 'Performance de Vendas',
                hAxis: {
                    title: 'Ano',
                    titleTextStyle: {
                        color: '#333'
                    }
                },
                vAxis: {
                    minValue: 0
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_vendas'));
            chart.draw(data_vendas, options);
        }
    </script>
    <!-- fim gráficos google charts -->
</body>
</html>