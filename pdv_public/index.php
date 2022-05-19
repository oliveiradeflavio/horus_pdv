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

    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
    <!-- css -->
    <link rel="stylesheet" href="css/index.css">

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Home</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
           
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" >
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
                                <?php if($_SESSION['perfil_usuario'] == 1): ?>
                                    <a href="#">Configurações</a>
                                <?php endif; ?>
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
                          
                            
                            <button onclick="location.href='#'" class="btn btn-primary">Histórico</button>
                            <button onclick="window.open('venda.php', '_blank')" class="btn btn-primary">Iniciar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mb-3">
                <div class='col-md-6'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Clientes Ativos</h5>
                        </div>
                        <div class="card-body">
                            794 
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Fornecedores Ativos</h5>
                        </div>
                        <div class="card-body">
                            200 
                        </div>
                    </div>
                </div>
                </div>

                <div class="row mb-3">
                <div class='col-md-6'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Produtos Ativos</h5>
                        </div>
                        <div class="card-body">
                            3400 
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card">
                        <div class="card-header">
                            <h5>Vendas Realizadas</h5>
                        </div>
                        <div class="card-body">
                            1000 
                        </div>
                    </div>
                </div>
                </div>

            </div>

            
        </div>

    </section>

    

   

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>