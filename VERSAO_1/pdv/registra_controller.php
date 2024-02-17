<?php
  
  session_start();
  require_once "conexao.php";
  require "login_model.php";
  require "login_service.php";


    //capturar o parametro ação que esta sendo passado como parametro via GET
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if( $acao == 'permissao'){
        $login = new Login();
        $conexao = new Conexao();
        $loginService = new LoginService($conexao, $login);

        $permissao_usuario = $_POST['permissao_usuario'];
        $id_usuario = $_POST['usuario_permissao'];

        $login->__set('id_usuario', $id_usuario);
        $login->__set('perfil_usuario', $permissao_usuario);
        $loginService->alteraPermissaoUsuario();
        header('Location: configuracoes.php?sucesso_permissao=1#nav_permissao_usuario');
   
    }elseif($acao == 'recuperar_senha'){
        $login = new Login();
        $conexao = new Conexao();
        $loginService = new LoginService($conexao, $login);

        $id_usuario = $_POST['usuario_recuperar_senha'];
        $nova_senha = md5($_POST['senha_usuario_recuperada_nova']);
        
        $login->__set('id_usuario', $id_usuario);
        $login->__set('nova_senha', $nova_senha);

        $loginService->novaSenhaUsuario();
        header('Location: configuracoes.php?sucesso_nova_senha=1#nav_recuperacao');
    
    }elseif($acao == 'excluir_usuario'){
        $login = new Login();
        $conexao = new Conexao();
        $loginService = new LoginService($conexao, $login);

        $id_usuario = $_POST['usuario_excluir'];
        $login->__set('id_usuario', $id_usuario);
        $loginService->excluirUsuario();
        header('Location: configuracoes.php?sucesso_excluir_usuario=1#nav_excluir_usuario');
    
    }else{

    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);
    $foto = $_FILES['foto_perfil'];

    if(empty($foto['name']))
        {
            $novo_nome = 'logo.png';
        }
        else{
            $tamanho = 2048;
            $error = array();
            if(!preg_match("/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso não é uma imagem.";
                }
            if(count($error) == 0){
    
            $extensao = strtolower(substr($foto['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "../pdv/img/usuarios/";
            move_uploaded_file($foto['tmp_name'], $diretorio.$novo_nome);
            }
        }

    $login = new Login();
    $conexao = new Conexao();
    $loginService = new LoginService($conexao, $login);
    $login->__set('cpf', $cpf);
    $login->__set('nome', $nome);
    $login->__set('email', $email);
    $login->__set('usuario', $usuario);
    $login->__set('senha', $senha);
    $login->__set('foto', $novo_nome);

    $logins = $loginService->consultaUsuario();

    if(empty($logins)){
      $loginService->inserir();
      header('Location: login.php?sucesso=1');
    }
    
    foreach ($logins as $indice => $login) {

        if($login->cpf_usuario == $cpf){
            header("Location: registrar.php?erro=2");
        
        }
        if ($login->username_usuario == $usuario) {
           header("Location: registrar.php?erro=3");
        
        }
        if($login->cpf_usuario != $cpf && $login->username_usuario != $usuario){
            $loginService->inserir();
            header('Location: login.php?sucesso=1');
        
        }
    }
}


?>