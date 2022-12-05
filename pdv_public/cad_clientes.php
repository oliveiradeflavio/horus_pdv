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

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="css/index.css">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Cadastro Clientes</title>
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

    <section class="container row col-md-12 centro">
        <!-- msg de retorno -->
        <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Cliente cadastrado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick='resetURL()'>&times;</span>
                </button>
            </div>
        <?php } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == '2') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Cliente removido com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick='resetURL()'>&times;</span>
                </button>
            </div>

        <?php } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == '3') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Cliente alterado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick='resetURL()'>&times;</span>
                </button>
            </div>

        <?php } else if (isset($_GET['erro']) && $_GET['erro'] == '2') { ?>
            <div class='alert alert-warning mt-2' role='alert'>
                <strong>Atenção</strong> CPF já cadastrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick='resetURL()'>&times;</span>
                </button>
            </div>

        <?php } else if (isset($_GET['erro']) && $_GET['erro'] == '3') { ?>
            <div class='alert alert-danger mt-2' role='alert'>
                <strong>Erro</strong> Senha master incorreta!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick='resetURL()'>&times;</span>
                </button>
            </div>
        <?php } ?>

    </section>

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


                            <button onclick="location.href='historico_venda.php'" class="btn btn-primary">Histórico</button>
                            <button onclick="location.href='relatorios.php'" class="btn btn-primary">Relatórios</button>
                            <button onclick="window.open('venda.php', '_blank')" class="btn btn-primary">Iniciar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <form action='cad_cliente_controller.php' method="post" id="formCadCliente">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCPF">CPF</label>
                                <input type="text" class="form-control" id="inputCPF" name='inputCPF' onblur='testaCPF(this.value)' required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDtNascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="inputDtNascimento" name='inputDtNascimento' onblur="validaDataNascimento(this.value)" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputNome">Nome</label>
                                <input type="text" class="form-control" id="inputNome" name="inputNome" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCEP">CEP</label>
                                <input type="text" class="form-control" id="inputCEP" name='inputCEP' onblur="pesquisaCEP(this.value)" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEstado">Estado</label>
                                <select id="inputEstado" name="inputEstado" class="form-control">
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
                                <input type="text" class="form-control" id="inputCidade" name="inputCidade" required>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEndereco">Endereço</label>
                                <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputNumero">Número</label>
                                <input type="number" class="form-control" id="inputNumero" name='inputNumero' required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputEnderecoComplemento">Complemento</label>
                                <input type="text" class="form-control" id="inputEnderecoComplemento" name="inputEnderecoComplemento">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputBairro">Bairro</label>
                                <input type="text" class="form-control" id="inputBairro" name="inputBairro" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputCelular">Celular/WhatsApp</label>
                                <input type="text" class="form-control" id="inputCelular" name="inputCelular" required>
                            </div>

                        </div>

                        <button type="button" onclick="validaCampos()" id='btnCadastrarCliente' class="btn btn-primary">Cadastrar</button>
                        <button id="btnAlterarCliente" style="display: none" class="btn btn-secondary">Alterar</button>
                        <button type="button" onclick="resetaCampos()" class="btn btn-danger" id='btnCancelarCliente'>Cancelar</button>
                        <i class="fa-solid fa-circle-question icone_fontawesome ml-3" id="ajuda_cad_cliente" style="cursor: pointer" onclick="ajuda_cadastro()"></i>

                    </form>
                </div>
            </div>
        </div>

        <div class="container centro mb-2 mt-5" id="campo_pesquisa">
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="?#campo_pesquisa" id='pesquisar_dados'>
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded input_pesquisar" name="buscar" id="inputPesquisa" placeholder="CPF ou Nome a ser pesquisado" onchange="verificarCampoPesquisa()" />
                            <button type="button" onclick="verificarCampoPesquisa()" class="input-group-text border-0" id="botaoPesquisar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['buscar'])) { ?>

            <?php
            require_once '../pdv/conexao.php';
            $conexao = new Conexao();
            $conexao = $conexao->conectar();
            $buscar = "%" . trim($_GET['buscar']) . "%";
            $query = "SELECT * FROM tb_clientes WHERE nome_cliente LIKE :buscar OR cpf_cliente LIKE :buscar";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':buscar', $buscar);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (count($resultado) <= 0) {
            ?>

                <div class="d-flex justify-content-center col-md-12" role="alert">
                    <img class="img-fluid" width="400" height="400" src="img/not-found.jpg" id='imagem_arquivo_not_found' alt="">
                <?php
            } else {
                ?>
                    <div id="loading"></div>
                    <div class="container col-md-11">
                    <table class="table table-lg table-hover table-responsive p-3" id="tabela_cad_clientes">
                        <thead>
                            <tr>
                                <th scope="col">CPF</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">CEP</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Número</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Complemento</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Celular/WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($resultado as $key => $cadCliente) { ?>

                                <tr>
                                    <td><?php echo $cadCliente->cpf_cliente; ?></td>
                                    <td><?php echo $cadCliente->nome_cliente; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($cadCliente->dt_nascimento_cliente)); ?></td>
                                    <td><?php echo $cadCliente->cep_cliente; ?></td>
                                    <td><?php echo $cadCliente->endereco_cliente; ?></td>
                                    <td><?php echo $cadCliente->numero_cliente; ?></td>
                                    <td><?php echo $cadCliente->bairro_cliente; ?></td>
                                    <td><?php echo $cadCliente->complemento_cliente; ?></td>
                                    <td><?php echo $cadCliente->estado_cliente; ?></td>
                                    <td><?php echo $cadCliente->cidade_cliente; ?></td>
                                    <td><?php echo $cadCliente->celular_cliente; ?></td>

                                    <td> <i class="fa-regular fa-pen-to-square icone_fontawesome" onclick="editarCliente(<?= $cadCliente->id_cliente ?>,
                                                                                '<?= $cadCliente->cpf_cliente ?>',
                                                                                '<?= $cadCliente->nome_cliente ?>',                                                                              
                                                                                '<?= $cadCliente->dt_nascimento_cliente ?>',
                                                                                '<?= $cadCliente->cep_cliente ?>',
                                                                                '<?= $cadCliente->endereco_cliente ?>',
                                                                                '<?= $cadCliente->numero_cliente ?>',
                                                                                '<?= $cadCliente->bairro_cliente ?>',
                                                                                '<?= $cadCliente->complemento_cliente ?>',
                                                                                '<?= $cadCliente->estado_cliente ?>',
                                                                                '<?= $cadCliente->cidade_cliente ?>',
                                                                                '<?= $cadCliente->celular_cliente ?>')" style='cursor: pointer'></i> </td>
                                    <td> <i class="fas fa-trash-alt icone_fontawesome" onclick="excluirCliente(<?= $cadCliente->id_cliente ?>)" style='cursor: pointer'></i> </td>
                                </tr>
                        </tbody>
            <?php
                            }
                        }
                    }
            ?>

                    </table>
                    </div>
    </section>

    <script src="js/pdv.js"></script>
</body>
</html>