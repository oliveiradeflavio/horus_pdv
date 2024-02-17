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
    <link rel="stylesheet" href="css/perfil_usuario.css">
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
                          
                            
                            <button onclick="location.href='historico_venda.php'" class="btn btn-primary">Histórico</button>
                            <button onclick="location.href='relatorios.php'" class="btn btn-primary">Relatórios</button>
                            <button onclick="location.href='venda.php'" class="btn btn-primary">Venda</button>
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

                        <div class="form-group custom-control custom-switch ml-3">
                            <input type="checkbox" class="custom-control-input"  id="checkbox_perfil_alterar_senha" onclick="habilitarTrocaSenha()">
                            <label class="col-md-8 custom-control-label" for="checkbox_perfil_alterar_senha">Ativar para alterar sua senha</label>
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

                <div class="col-md-5 justify-content-center centro ">
                    <div class="mt-5">
                        <img src="../pdv/img/usuarios/<?= $_SESSION['foto_usuario'] ?>" width="300" height="300" class="rounded-circle avatar-pic">
                    </div>
                    <div class="mt-2 mb-5">
                        <label for='foto_perfil' class='sel-enviar-foto'>Enviar foto</label>
                        <input id="foto_perfil" type="file" name="foto_perfil">
                        <span id='nome-arquivo'></span>
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
                                <strong>Sucesso!</strong> Perfil atualizado com sucesso, faça login novamente para verificar.
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

<script src="js/perfil.js"></script>
</body>

</html>