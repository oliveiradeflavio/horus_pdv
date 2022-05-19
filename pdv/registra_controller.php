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

    $login = new Login();
    $conexao = new Conexao();
    $login->__set('cpf', $cpf);
    $login->__set('nome', $nome);
    $login->__set('email', $email);
    $login->__set('usuario', $usuario);
    $login->__set('senha', $senha);

    $loginService = new LoginService($conexao, $login);
    $loginService->inserir();




?>