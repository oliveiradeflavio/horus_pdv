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
    <link rel="stylesheet" href="css/perfil_usuario.css">

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
                            <img src="img/logo.png" alt="" width="50" height="50" class="img-circulo"> 
                            <div class="dropdown-content mr-5">
                                <a>usuario logado</a>
                                <div class="dropdown-divider"></div>                              
                                <a href="perfil_usuario.php">Meu Perfil</a>
                                <a href="#">Configurações</a>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gerencie seu perfil</h5>
                            <p class="card-text">
                                Gerenciar o perfil logado, alterando nome, login, senha ou a foto.
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
                            <button onclick="location.href='#'" class="btn btn-primary">Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex ml-2">
                    <form role="form" action="perfil_controller.php" method="post" enctype="multipart/form-data" id='formPerfil'>
                       
                      <div class="form-group">
                            <label class="col-lg-3 control-label">Nome:</label>
                            <div class="col-lg-12">
                                <input class="form-control" value="<?php echo $_SESSION['nome_usuario'] ?>" type="text" name='nome_usuario_perfil' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input class="form-control" value="<?php echo $_SESSION['email_usuario'] ?>" type="text" name='email_usuario_perfil' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Username:</label>
                            <div class="col-md-12">
                                <input class="form-control" value="<?php echo $_SESSION['username_usuario'] ?>" type="text" name='username_usuario_perfil' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" class="col-md-12 form-check-input ml-5" id="checkbox_perfil_alterar_senha" onclick="habilitarTrocaSenha()">
                            <label class="col-md-8 form-check-label" for="checkbox_perfil_alterar_senha">Ativar para alterar sua senha</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 control-label">Antiga Senha:</label>
                            <div class="col-md-12">
                                <input class="form-control"  type="password" id='antiga_senha_usuario' name='antiga_senha_usuario_perfil' disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Nova Senha:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" id='nova_senha_usuario' name='nova_senha_usuario_perfil' disabled>
                            </div>
                        </div>
                        <div class="form-group">
                        
                            <div class="col-md-12">
                                <input class="btn btn-primary" value="Salvar" type="submit">
                                <input class="btn btn-danger" value="Cancelar" type="reset">
                            </div>
                        </div>

                   
                </div>

                <div class="col-md-5 justify-content-center ">
                    <div class="mt-5">
                        <img src="../pdv/img/usuarios/<?= $_SESSION['foto_usuario'] ?>" width="300" height="300" class="rounded-circle avatar-pic">
                    </div>
                    <div class="mt-5 mb-5">
                        <input type="file" name='foto_perfil' id='foto_perfil'>
                    </div>
                    <div>
                        <?php
                            if(isset($_GET['erro']) && $_GET['erro'] == '1'){?>
                                <div class='alert alert-danger'  role='alert'>
                                <strong>Erro!</strong> Verifique os campos e tente novamente.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <?php }
                            if(isset($_GET['erro']) && $_GET['erro'] == '2'){?>
                                <div class='alert alert-danger'  role='alert'>
                                <strong>Erro!</strong> Certifique-se de que a senha antiga está correta.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            <?php }
                            if(isset($_GET['atualizado']) && $_GET['atualizado'] == '1'){?>
                                <div class='alert alert-success'  role='alert'>
                                <strong>Sucesso!</strong> Perfil atualizado com sucesso.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            <?php }
                         ?>
                    </div>
                </div>

                </form>

            </div>

        </div>



    </section>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/perfil.js"></script>
</body>

</html>