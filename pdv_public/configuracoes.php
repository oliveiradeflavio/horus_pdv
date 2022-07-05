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

    <title>Hórus PDV - Configurações</title>
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
            </div>
        </nav>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <ul class="nav nav-tabs nav-pills" id="tab_configuracoes">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav_config_senha_master" href="#nav_config_senha">Senha Master</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav_permissoes" href="#nav_permissao_usuario">Permissões de Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav_recuperacao_senha" href="#nav_recuperacao">Recuperação de Senha</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav_dados_empresariais" href="#nav_dados">Dados Empresariais</a>
                    </li>
                </ul>
                <div class="tab-content" id="tab_configuracoes_controller">
                    <div class="tab-pane fade show active" id="nav_config_senha" role="tabpanel" aria-labelledby="nav-home-tab">
                        Senha Master
                    </div>
                    <div class="tab-pane fade" id="nav_permissao_usuario" role="tabpanel" aria-labelledby="nav-profile-tab">
                        Permissões de Usuários
                    </div>
                    <div class="tab-pane fade" id="nav_recuperacao" role="tabpanel" aria-labelledby="nav-profile-tab">
                        Recuperação de Senha
                    </div>
                    <div class="tab-pane fade" id="nav_dados" role="tabpanel" aria-labelledby="nav-profile-tab">
                        Dados Empresariais
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>


<script src="js/configuracoes.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
