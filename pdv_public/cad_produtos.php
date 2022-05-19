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
    <link rel="stylesheet" href="css/cad_produtos.css">

    <!-- jquery mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Cadastro Fornecedores</title>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Produtos</h5>
                            <p class="card-text">
                                Cadastre os produtos que serão vendidos no PDV.
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

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <form id="formCadCliente" >
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputImagemProduto" class="form-label">Carregue uma imagem do produto</label>
                            <input class="form-control" type="file" id="inputImagemProduto" required>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputNomeProduto">Nome do Produto</label>
                                <input type="text" class="form-control" id="inputNomeProduto" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputCodigo">Código</label>
                                <input type="text" class="form-control" id="inputCodigo" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputDescricaoProduto">Descrição do Produto</label>
                                <input type="text" class="form-control" id="inputDescricaoProduto"  required>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class="form-group col-md-4">
                                    <label for="inputQuantidade">Quantidade</label>
                                    <input type="text" class="form-control" id="inputQuantidade" required>
                                </div>
                            
                            <div class="form-group col-md-4">
                                <label for="inputPrecoUnitario">Preço Unitário</label>
                                <input type="text" class="form-control" id="inputPrecoUnitario" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputPrecoTotal">Preço Total</label>
                                <input type="email" class="form-control" id="inputPrecoTotal" required>
                            </div>

                          
                        </div>

                        <button type="submit" onclick="validaCampos()" class="btn btn-primary">Cadastrar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>

            </div>
        </div>



    </section>

<script src="js/pdv.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>