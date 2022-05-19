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

    <!-- jquery mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Cadastro Clientes</title>
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
                            <h5 class="card-title">Cadastro de Clientes</h5>
                            <p class="card-text">
                                Cadastre seus clientes para que possam comprar seus produtos.
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
                            <div class="form-group col-md-3">
                                <label for="inputCPF">CPF</label>
                                <input type="text" class="form-control" id="inputCPF" onblur='testaCPF(this.value)' required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDtNascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="inputDtNascimento" onblur="validaDataNascimento()" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputNome">Nome</label>
                                <input type="text" class="form-control" id="inputNome" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCEP">CEP</label>
                                <input type="text" class="form-control" id="inputCEP" onblur="pesquisaCEP(this.value)"  required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEstado">Estado</label>
                                <select id="inputEstado" class="form-control" >
                                    <option selected>Selecionar...</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                    <option value="EX">Estrangeiro</option>
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputCidade">Cidade</label>
                                <input type="text" class="form-control" id="inputCidade" required>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEndereco">Endereço</label>
                                <input type="text" class="form-control" id="inputEndereco"  required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputNumero">Número</label>
                                <input type="number" class="form-control" id="inputNumero"  required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputEnderecoComplemento">Complemento</label>
                                <input type="text" class="form-control" id="inputEnderecoComplemento" >
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputBairro">Bairro</label>
                                <input type="text" class="form-control" id="inputBairro" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputCelular">Celular</label>
                                <input type="text" class="form-control" id="inputCelular" required>
                            </div>

                        </div>

                        <button type="submit" onclick="validaCampos()" class="btn btn-primary">Cadastrar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>

            </div>
        </div>



    </section>


<!-- <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script> -->

<script src="js/pdv.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>