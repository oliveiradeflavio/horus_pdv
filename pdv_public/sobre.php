<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header("Location: login.php?login=2");
}
?>

<!DOCTYPE html>
<html lang="en">
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
                            <a href="index.php" style="cursor:pointer"><?php echo $_SESSION['nome_usuario'] ?>
                            <div class="dropdown-divider"></div>
                            Voltar para o home</a>
                            </a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>