<?php
  
  session_start();
  require "conexao.php";
  require "login_model.php";
  require "login_service.php";

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
  



?>