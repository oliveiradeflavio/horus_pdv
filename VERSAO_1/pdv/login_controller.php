<?php
    
    session_start();
    require "conexao.php";
    require "login_model.php";
    require "login_service.php";

    $usuario = strtolower($_POST['usuario']);
    $password = md5($_POST['senha']);

    $login = new Login();
    $conexao = new Conexao();
    $login->__set('usuario', $usuario);
    $login->__set('senha', $password);
   
    $loginService = new LoginService($conexao, $login);
    $logins = $loginService->recuperar();
 
    if(empty($logins)){
        header("Location: login.php?login=1");
    }

    foreach ($logins as $indice => $login) {

              
        if($login->username_usuario == $usuario && $login->password_usuario == $password){
           
            $_SESSION['autenticado'] = 'SIM';
            $_SESSION['id_usuario'] = $login->id_usuario;
            $_SESSION['nome_usuario'] = $login->nome_usuario;
            $_SESSION['username_usuario'] = $login->username_usuario;
            $_SESSION['email_usuario'] = $login->email_usuario;
            $_SESSION['foto_usuario'] = $login->foto_usuario;
            $_SESSION['senha_usuario'] = $login->password_usuario;
            $_SESSION['perfil_usuario'] = $login->perfil_usuario; // 1 - ADMIN, 2 - USER

            header('Location: index.php');
        
        }else {
            $_SESSION['autenticado'] = 'NAO';
            header("Location: login.php?login=2");
        }
    }

?>