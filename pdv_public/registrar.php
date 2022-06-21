<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- cdn bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="css/login.css">

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Criar Conta</title>
</head>

<body>

<div class="container">
        <div class="row">
            <div class='col-md-12'>
            <a href="login.php" alt="voltar">
            <i class="fas fa-home-lg icone"></i>
            </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container">
            <div class="row">

                <div class="col-md-6 mt-5 conteudo">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Criar uma nova conta</h3>
                                <p class="mb-4"> Preencha todos os campos abaixo</p>
                            </div>
                            <form action="registra_controller.php" method="post" enctype="multipart/form-data">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" onchange="validaCampos()" required>
                                    <label for="cpf">CPF</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" onchange="validaCampos()" required>
                                    <label for="nome">Nome Completo</label>
                                </div>

                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" onchange="validaCampos()" required>
                                    <label for="email">E-mail</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" onchange="validaCampos()" required>
                                    <label for="usuario">Username</label>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" onchange="validaCampos()" required>
                                    <label for="senha">Senha</label>
                                </div>

                                <input type="submit" value="Registrar" id='botaoRegistrar' class="btn btn-primary" disabled>
                                <input type="reset" value="Cancelar" class="btn btn-danger">


                                <?php
                                
                                if (isset($_GET['erro']) && $_GET['erro'] == 2) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                    <strong>Atenção</strong> CPF já cadastrado!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }
                                
                                if (isset($_GET['erro']) && $_GET['erro'] == 3) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                    <strong>Atenção</strong> Username já cadastrado!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }
                                ?>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 mt-2">
                   
                  <img id='preview' src="img/placeholder_imagem_criar_conta.png" width="400" height="400" alt="logo" class="img-fluid mt-5 transparencia">
                 
                   <div id="img-container">
                        <input id="img-input" type="file" name="foto_perfil">
                    </div>
                </div>
                
            </form>

            </div>

        </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/registrar.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>