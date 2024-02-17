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
    <title>Hórus PDV - Sobre</title>
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
                            <a href="index.php">Home</a>
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
        </nav>
    </header>
    
    <section>

        <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">Hórus PDV</span>

                        <div class='px-4 mt-3'>
                            <p class="fontes">O Hórus PDV é um sistema de gestão de produtos e serviços que tem como objetivo 
                                <br>facilitar o controle de estoque, aumentar a produtividade e a segurança de seus funcionários.
                            </p>

                            <p class="fontes">
                                Cadastre clientes, fornecedores, produtos. Cadastre funcionários e faça suas vendas. Gere relatórios de vendas e estoque.
                            </p>
                                
                        </div>
                        <div class="px-4 mt-5">
                            <p>Desenvolvido por Flávio Oliveira</p>

                            
                                <a style="color: #3b5998;"  role="button" href="https://www.linkedin.com/in/fladoliveira"
                                target="_blank"
                                ><i class="fab fa-linkedin icone_sobre"></i
                                ></a>

                                <a style="color: #000;"  role="button" href="https://github.com/oliveiradeflavio"
                                target="_blank"
                                ><i class="fab fa-github icone_sobre"></i
                                ></a>

                                <a style="color: #E1306C"  role="button" href="https://www.instagram.com/flavio_tech"
                                target="_blank"
                                ><i class="fab fa-instagram icone_sobre"></i
                                ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>