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

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV</title>
</head>

<body>   
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/logo.png" width="400" height="400" alt="logo" class="img-fluid mt-5 transparencia img_desktop">
                    <img src="img/logo_mobile.png" width="400" height="400" alt="logo" class="img-fluid mt-5 transparencia img_mobile">
                </div>
                <div class="col-md-6 mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3 class='img_desktop'>Hórus PDV</h3>
                                <p class="mb-4"> Sem conta? <a href="registrar.php" style='color: #6c66aa;'> Cadastre-se</a></p>
                            </div>
                            <form action="login_controller.php" method="post">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
                                    <label for="usuario">Usuário</label>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                                    <label for="senha">Senha</label>
                                </div>

                                <input type="submit" value="Logar" class="btn btn-primary">

                            </form>
                            <?php
                            if (isset($_GET['login']) && $_GET['login'] == 1) { ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    Usuário ou senha incorretos.
                                </div>
                            <?php
                            }
                            if (isset($_GET['login']) && $_GET['login'] == 2) { ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    Você não tem permissão para acessar o sistema.
                                </div>
                            <?php
                            }
                            
                            if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) { ?>
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                 <strong>Sucesso</strong> Faça login para continuar.
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                 </div>
                             <?php
                             }
                             ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>