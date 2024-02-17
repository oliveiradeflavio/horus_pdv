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

    <!-- css -->
    <link rel="stylesheet" href="css/index.css">

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
                            <a class="nav-link" id="nav_excluisao_usuario" href="#nav_excluir_usuario">Excluir Usuário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav_dados_empresariais" href="#nav_dados">Dados Empresariais</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tab_configuracoes_controller">
                        <div class="tab-pane fade show active mt-5" id="nav_config_senha" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Senha Master</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="#" method="post" id="form_alterar_senha_master">
                                                    <div class="form-group custom-control custom-switch ml-3">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox_senha_alterar_senha" onclick="habilitarTrocaSenha()">
                                                        <label class="col-md-8 custom-control-label" for="checkbox_senha_alterar_senha">Ativar para alterar sua senha</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="senha_master">Senha Master Atual</label>
                                                        <input type="password" class="form-control" id="senha_master_antiga" name="senha_master_antiga" placeholder="Senha Master Atual" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="senha_master_confirmar">Nova Senha Master</label>
                                                        <input type="password" class="form-control" id="senha_master_nova" name="senha_master_nova" placeholder="Nova Senha Master" disabled>
                                                    </div>
                                                    <button type="button" onclick="habilitarTrocaSenha()" id="btn_salvar_senha" class="btn btn-primary" disabled>Salvar</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- msg de retorno -->
                                        <div class="container row col-md-12 centro">
                                            <?php
                                            if (isset($_GET['sucesso_senha']) && $_GET['sucesso_senha'] == '1') { ?>
                                                <div class='alert alert-success mt-2' role='alert'>
                                                    <strong>Sucesso!</strong> Senha master alterado com sucesso.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php }

                                            if (isset($_GET['erro_senha']) && $_GET['erro_senha'] == '2') { ?>
                                                <div class='alert alert-danger mt-2' role='alert'>
                                                    <strong>Atenção</strong> Erro ao alterar senha master.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav_permissao_usuario" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Permissões de Usuários</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="registra_controller.php?acao=permissao" method="post" id="form_alterar_permissao_usuario">
                                                    <div class="form-group custom-control custom-switch ml-3">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox_permissao_usuario" onclick="habilitarTrocaPermissao()">
                                                        <label class="col-md-8 custom-control-label" for="checkbox_permissao_usuario">Ativar para alterar permissão de usuário</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="permissao_usuario">Permissão de Usuário</label>
                                                        <select class="form-control" id="permissao_usuario" name="permissao_usuario" disabled>
                                                            <option value="">Selecione um tipo de Permissão</option>
                                                            <option value="1">Administrador</option>
                                                            <option value="2">Usuário</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usuario_permissao">Usuário</label>
                                                        <select class="form-control" id="usuario_permissao" name="usuario_permissao" disabled>
                                                            <option value="">Escolha um usuário</option>
                                                            <?php
                                                            require_once '../pdv/conexao.php';
                                                            $conexao = new Conexao();
                                                            $conexao = $conexao->conectar();
                                                            $query = 'SELECT * FROM tb_usuarios';
                                                            $stmt = $conexao->prepare($query);
                                                            $stmt->execute();
                                                            $usuarios = $stmt->fetchAll();
                                                            foreach ($usuarios as $usuario) { ?>
                                                                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <button type="button" onclick="habilitarTrocaPermissao()" id="btn_salvar_permissao" class="btn btn-primary" disabled>Salvar</button>
                                                </form>
                                            </div>
                                        </div>
                                          <!-- msg de retorno -->
                                          <div class="container row col-md-12 centro">
                                            <?php
                                            if (isset($_GET['sucesso_permissao']) && $_GET['sucesso_permissao'] == '1') { ?>                                             
                                              
                                                <div class='alert alert-success mt-2' role='alert'>
                                                    <strong>Sucesso!</strong> Permissão alterada com sucesso.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php }
                                            if (isset($_GET['erro_permissao']) && $_GET['erro_permissao'] == '2') { ?>
                                                <div class='alert alert-danger mt-2' role='alert'>
                                                    <strong>Atenção</strong> Erro ao alterar a permissão.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>                                               
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav_recuperacao" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Recuperação de Senha</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="registra_controller.php?acao=recuperar_senha" method="post" id="form_recuperar_senha">
                                                    <div class="form-group custom-control custom-switch ml-3">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox_recuperar_senha" onclick="habilitarRecuperacaoSenha()">
                                                        <label class="col-md-8 custom-control-label" for="checkbox_recuperar_senha">Ativar para recuperar a senha</label>
                                                    </div>        
                                                    <div class="form-group">
                                                        <label for="usuario_permissao">Usuário</label>
                                                        <select class="form-control" id="usuario_recuperar_senha" name="usuario_recuperar_senha" disabled>
                                                            <option value="">Escolha um usuário</option>
                                                            <?php
                                                            require_once '../pdv/conexao.php';
                                                            $conexao = new Conexao();
                                                            $conexao = $conexao->conectar();
                                                            $query = 'SELECT * FROM tb_usuarios';
                                                            $stmt = $conexao->prepare($query);
                                                            $stmt->execute();
                                                            $usuarios = $stmt->fetchAll();
                                                            foreach ($usuarios as $usuario) { ?>
                                                                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="senha_usuario_recuperada_nova">Nova Senha</label>
                                                        <input type="password" class="form-control" id="senha_usuario_recuperada_nova" name="senha_usuario_recuperada_nova" disabled>
                                                    </div>
                                                    <button type="button" onclick="habilitarRecuperacaoSenha()" id="btn_salvar_recuperar_senha" class="btn btn-primary" disabled>Salvar</button>
                                                </form>
                                            </div>
                                        </div>
                                          <!-- msg de retorno -->
                                          <div class="container row col-md-12 centro">
                                            <?php
                                            if (isset($_GET['sucesso_nova_senha']) && $_GET['sucesso_nova_senha'] == '1') { ?>                                             
                                              
                                                <div class='alert alert-success mt-2' role='alert'>
                                                    <strong>Sucesso!</strong> Senha alterada com sucesso.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php }
                                            if (isset($_GET['erro_recuperar_senha']) && $_GET['erro_recuperar_senha'] == '2') { ?>
                                                <div class='alert alert-danger mt-2' role='alert'>
                                                    <strong>Atenção</strong> Erro ao alterar a senha.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>                                               
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                                 
                        </div>
                        <div class="tab-pane fade" id="nav_excluir_usuario" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <div class="container mt-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title">Excluir Usuário</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="registra_controller.php?acao=excluir_usuario" method="post" id="form_excluir_usuario">
                                                        <div class="form-group custom-control custom-switch ml-3">
                                                            <input type="checkbox" class="custom-control-input" id="checkbox_excluir_usuario" onclick="habilitarExcluirUsuario()">
                                                            <label class="col-md-8 custom-control-label" for="checkbox_excluir_usuario">Ativar para excluir</label>
                                                        </div>        
                                                        <div class="form-group">
                                                            <label for="usuario_excluir">Usuário</label>
                                                            <select class="form-control" id="usuario_excluir" name="usuario_excluir" disabled>
                                                                <option value="">Escolha um usuário</option>
                                                                <?php
                                                                require_once '../pdv/conexao.php';
                                                                $conexao = new Conexao();
                                                                $conexao = $conexao->conectar();
                                                                $query = 'SELECT * FROM tb_usuarios';
                                                                $stmt = $conexao->prepare($query);
                                                                $stmt->execute();
                                                                $usuarios = $stmt->fetchAll();
                                                                foreach ($usuarios as $usuario) { 
                                                                    if($_SESSION['id_usuario'] != $usuario['id_usuario']){?>
                                                                        <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
                                                            <?php  }
                                                               } ?>
                                                            </select>
                                                        </div>
                                                    <button type="button" onclick="habilitarExcluirUsuario()" id="btn_excluir_usuario" class="btn btn-primary" disabled>Salvar</button>
                                                    </form>
                                                </div>
                                            </div>
                                                <!-- msg de retorno -->
                                          <div class="container row col-md-12 centro">
                                            <?php
                                            if (isset($_GET['sucesso_excluir_usuario']) && $_GET['sucesso_excluir_usuario'] == '1') { ?>                                             
                                              
                                                <div class='alert alert-success mt-2' role='alert'>
                                                    <strong>Sucesso!</strong> Usuário excluído com sucesso.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php }
                                            if (isset($_GET['erro_excluir_usuario']) && $_GET['erro_excluir_usuario'] == '2') { ?>
                                                <div class='alert alert-danger mt-2' role='alert'>
                                                    <strong>Atenção</strong> Erro ao excluir o usuário.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>                                               
                                            <?php } ?>
                                        </div>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                           
                            <div class="tab-pane fade" id="nav_dados" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Dados Empresariais</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="" method="post" id="form_dados_empresariais">
                                                    <div class="form-group custom-control custom-switch ml-3">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox_editar_dados_empresariais" onclick="habilitaDadosEmpresariais()">
                                                        <label class="col-md-8 custom-control-label" for="checkbox_editar_dados_empresariais">Ativar para edição</label>
                                                    </div> 
                                                    <div class="form-row">       
                                                    <?php
                                                    require_once '../pdv/conexao.php';
                                                    $conexao = new Conexao();
                                                    $conexao = $conexao->conectar();
                                                    $query = 'SELECT * FROM tb_dados_empresariais';
                                                    $stmt = $conexao->prepare($query);
                                                    $stmt->execute();
                                                    $dados_empresariais = $stmt->fetchAll(PDO::FETCH_OBJ);

                                                    //Verificando se tem dados empresariais cadastrados, caso contrário irá apresentar o form vazio para preenchimento
                                                    if(count($dados_empresariais) > 0){                                                    

                                                    foreach ($dados_empresariais as $key => $dados) {?>                                                             

                                                            <div class="form-group col-md-6">
                                                                <label for="nome_empresa">Nome da Empresa</label>
                                                                <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" disabled required value="<?= $dados->nome_empresa_dados_empresariais ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="cnpj_empresa">CNPJ</label>
                                                                <input type="text" class="form-control" id="cnpj_empresa" name="cnpj_empresa" onblur='validarCNPJ(this.value)' disabled required value="<?= $dados->cnpj_dados_empresariais ?>">
                                                            </div>
                                                    </div>

                                                    <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="cep_empresa">CEP</label>
                                                                <input type="text" class="form-control" id="cep_empresa" name="cep_empresa" onblur='pesquisarCEP(this.value)' disabled required value="<?= $dados->cep_dados_empresariais ?>">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="estado_empresa">Estado</label>
                                                                <select id="estado_empresa" class="form-control" name="estado_empresa" disabled required value="<?= $dados->estado_dados_empresariais ?>">
                                                                    <option value=''>Selecionar...</option>
                                                                    <option value="AC" <?php echo $dados->estado_dados_empresariais == 'AC' ? 'selected' : ''; ?>>Acre</option>
                                                                    <option value="AL" <?php echo $dados->estado_dados_empresariais == 'AL' ? 'selected' : ''; ?>>Alagoas</option>
                                                                    <option value="AP" <?php echo $dados->estado_dados_empresariais == 'AP' ? 'selected' : ''; ?>>Amapá</option>
                                                                    <option value="AM" <?php echo $dados->estado_dados_empresariais == 'AM' ? 'selected' : ''; ?>>Amazonas</option>
                                                                    <option value="BA" <?php echo $dados->estado_dados_empresariais == 'BA' ? 'selected' : ''; ?>>Bahia</option>
                                                                    <option value="CE" <?php echo $dados->estado_dados_empresariais == 'CE' ? 'selected' : ''; ?>>Ceará</option>
                                                                    <option value="DF" <?php echo $dados->estado_dados_empresariais == 'DF' ? 'selected' : ''; ?>>Distrito Federal</option>
                                                                    <option value="ES" <?php echo $dados->estado_dados_empresariais == 'ES' ? 'selected' : ''; ?>>Espírito Santo</option>
                                                                    <option value="GO" <?php echo $dados->estado_dados_empresariais == 'GO' ? 'selected' : ''; ?>>Goiás</option>
                                                                    <option value="MA" <?php echo $dados->estado_dados_empresariais == 'MA' ? 'selected' : ''; ?>>Maranhão</option>
                                                                    <option value="MT" <?php echo $dados->estado_dados_empresariais == 'MT' ? 'selected' : ''; ?>>Mato Grosso</option>
                                                                    <option value="MS" <?php echo $dados->estado_dados_empresariais == 'MS' ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                                                                    <option value="MG" <?php echo $dados->estado_dados_empresariais == 'MG' ? 'selected' : ''; ?>>Minas Gerais</option>
                                                                    <option value="PA" <?php echo $dados->estado_dados_empresariais == 'PA' ? 'selected' : ''; ?>>Pará</option>
                                                                    <option value="PB" <?php echo $dados->estado_dados_empresariais == 'PB' ? 'selected' : ''; ?>>Paraíba</option>
                                                                    <option value="PR" <?php echo $dados->estado_dados_empresariais == 'PR' ? 'selected' : ''; ?>>Paraná</option>
                                                                    <option value="PE" <?php echo $dados->estado_dados_empresariais == 'PE' ? 'selected' : ''; ?>>Pernambuco</option>
                                                                    <option value="PI" <?php echo $dados->estado_dados_empresariais == 'PI' ? 'selected' : ''; ?>>Piauí</option>
                                                                    <option value="RJ" <?php echo $dados->estado_dados_empresariais == 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
                                                                    <option value="RN" <?php echo $dados->estado_dados_empresariais == 'RN' ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                                                                    <option value="RS" <?php echo $dados->estado_dados_empresariais == 'RS' ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                                                                    <option value="RO" <?php echo $dados->estado_dados_empresariais == 'RO' ? 'selected' : ''; ?>>Rondônia</option>
                                                                    <option value="RR" <?php echo $dados->estado_dados_empresariais == 'RR' ? 'selected' : ''; ?>>Roraima</option>
                                                                    <option value="SC" <?php echo $dados->estado_dados_empresariais == 'SC' ? 'selected' : ''; ?>>Santa Catarina</option>
                                                                    <option value="SP" <?php echo $dados->estado_dados_empresariais == 'SP' ? 'selected' : ''; ?>>São Paulo</option>
                                                                    <option value="SE" <?php echo $dados->estado_dados_empresariais == 'SE' ? 'selected' : ''; ?>>Sergipe</option>
                                                                    <option value="TO" <?php echo $dados->estado_dados_empresariais == 'TO' ? 'selected' : ''; ?>>Tocantins</option>                                                                   
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="endereco_empresa">Endereço</label>
                                                                <input type="text" class="form-control" id="endereco_empresa" name="endereco_empresa" disabled required value="<?= $dados->endereco_dados_empresariais ?>">
                                                            </div>
                                                    </div>

                                                    <div class="form-row">                                              
                                                            <div class="form-group col-md-2">
                                                                <label for="numero_empresa">Número</label>
                                                                <input type="number" class="form-control" id="numero_empresa" name="numero_empresa" disabled required value="<?= $dados->numero_dados_empresariais ?>">
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="bairro_empresa">Bairro</label>
                                                                <input type="text" class="form-control" id="bairro_empresa" name="bairro_empresa" disabled required value="<?= $dados->bairro_dados_empresariais ?>">
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="cidade_empresa">Cidade</label>
                                                                <input type="text" class="form-control" id="cidade_empresa" name="cidade_empresa" disabled required value="<?= $dados->cidade_dados_empresariais ?>">
                                                            </div>                                                        
                                                    </div>    
                                                    
                                                    <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="telefone_empresa">Telefone</label>
                                                                <input type="text" class="form-control" id="telefone_empresa" name="telefone_empresa" disabled value="<?= $dados->telefone_dados_empresariais ?>"> 
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="celular_empresa">Celular</label>
                                                                <input type="text" class="form-control" id="celular_empresa" name="celular_empresa" disabled required value="<?= $dados->celular_dados_empresariais ?>">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="email_empresa">E-mail</label>
                                                                <input type="email" class="form-control" id="email_empresa" name="email_empresa" disabled required value="<?= $dados->email_dados_empresariais ?>">
                                                             </div>
                                                    </div>                                                          
                                                 <?php } ?>                                             
                                        
                                                    <button type="button" onclick="habilitaDadosEmpresariais()" id="btn_salvar_dados_empresariais" class="btn btn-primary" disabled>Salvar</button>
                                                        

                                                <?php }else { ?>

                                                    <div class="form-group col-md-6">
                                                                <label for="nome_empresa">Nome da Empresa</label>
                                                                <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" disabled required ">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="cnpj_empresa">CNPJ</label>
                                                                <input type="text" class="form-control" id="cnpj_empresa" name="cnpj_empresa" onblur='validarCNPJ(this.value)' disabled required >
                                                            </div>
                                                    </div>

                                                    <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="cep_empresa">CEP</label>
                                                                <input type="text" class="form-control" id="cep_empresa" name="cep_empresa" onblur='pesquisarCEP(this.value)' disabled required>
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="estado_empresa">Estado</label>
                                                                <select id="estado_empresa" class="form-control" name="estado_empresa" disabled required>
                                                                    <option value=''>Selecionar...</option>
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
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="endereco_empresa">Endereço</label>
                                                                <input type="text" class="form-control" id="endereco_empresa" name="endereco_empresa" disabled required>
                                                            </div>
                                                    </div>

                                                    <div class="form-row">                                              
                                                            <div class="form-group col-md-2">
                                                                <label for="numero_empresa">Número</label>
                                                                <input type="number" class="form-control" id="numero_empresa" name="numero_empresa" disabled required>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="bairro_empresa">Bairro</label>
                                                                <input type="text" class="form-control" id="bairro_empresa" name="bairro_empresa" disabled required>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="cidade_empresa">Cidade</label>
                                                                <input type="text" class="form-control" id="cidade_empresa" name="cidade_empresa" disabled required >
                                                            </div>                                                        
                                                    </div>    
                                                    
                                                    <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="telefone_empresa">Telefone</label>
                                                                <input type="text" class="form-control" id="telefone_empresa" name="telefone_empresa" disabled > 
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="celular_empresa">Celular</label>
                                                                <input type="text" class="form-control" id="celular_empresa" name="celular_empresa" disabled required>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="email_empresa">E-mail</label>
                                                                <input type="email" class="form-control" id="email_empresa" name="email_empresa" disabled required >
                                                             </div>
                                                    </div>  
                                                    <button type="button" onclick="habilitaDadosEmpresariais()" id="btn_salvar_dados_empresariais" class="btn btn-primary" disabled>Salvar</button> 
                                                    </form>                                                            
                                                 <?php } ?>
                                        </div>
                                    </div>
                                       <!-- msg de retorno -->
                                       <div class="container row col-md-12 centro">
                                            <?php
                                            if (isset($_GET['sucesso_dados_empresariais']) && $_GET['sucesso_dados_empresariais'] == '1') { ?>                                             
                                              
                                                <div class='alert alert-success mt-2' role='alert'>
                                                    <strong>Sucesso!</strong> Dados empresariais salvo com sucesso.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>
                                            <?php }
                                            if (isset($_GET['erro_dados_empresariais']) && $_GET['erro_dados_empresariais'] == '2') { ?>
                                                <div class='alert alert-danger mt-2' role='alert'>
                                                    <strong>Atenção</strong> Erro ao salvar dados empresariais.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="resetURL()">&times;</span>
                                                    </button>
                                                </div>                                               
                                            <?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
    </section>


    <script src="js/configuracoes.js"></script>
</body>

</html>