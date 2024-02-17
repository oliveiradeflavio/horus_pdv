<?php

    session_start();
    require "conexao.php";
    require "login_model.php";
    require "login_service.php";  

   
    $foto = $_FILES['foto_perfil'];
    $nome_usuario_perfil = $_POST['nome_usuario_perfil'];
    $email_usuario_perfil = $_POST['email_usuario_perfil'];
    //$username_usuario_perfil = $_POST['username_usuario_perfil'];

    if(isset($_POST['nova_senha_usuario_perfil'])){
        $nova_senha_usuario_perfil = md5($_POST['nova_senha_usuario_perfil']);
    }    

    if($nome_usuario_perfil == '' || $email_usuario_perfil == '' )
    {
        header('Location: perfil_usuario.php?erro=1');
    }
    else
    {
        if(empty($foto['name']))
        {
            $novo_nome = $_SESSION['foto_usuario'];
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

        $perfil_usuario = new Login();
        $conexao = new Conexao();
        $perfil_usuario->__set('nome', $nome_usuario_perfil);
        $perfil_usuario->__set('email', $email_usuario_perfil);
        //$perfil_usuario->__set('username', $username_usuario_perfil);
        $perfil_usuario->__set('foto', $novo_nome);
        $perfil_usuario->__set('id', $_SESSION['id_usuario']);
       
        if(isset($_POST['antiga_senha_usuario_perfil'])) {
            $antiga_senha_usuario_perfil = md5($_POST['antiga_senha_usuario_perfil']);

            if($antiga_senha_usuario_perfil == $_SESSION['senha_usuario'] && $nova_senha_usuario_perfil != '') {
                $perfil_usuario->__set('senha', $nova_senha_usuario_perfil);
                $perfil_usuarioService = new LoginService($conexao, $perfil_usuario);
                $perfil_usuarioService->atualizarSenha();
                header('Location: perfil_usuario.php?atualizado=1');

            }else{
               header('Location: perfil_usuario.php?erro=2');
            }
        }
        else{
            $perfil_usuarioService = new LoginService($conexao, $perfil_usuario);
            $perfil_usuarioService->atualizar();
            header('Location: perfil_usuario.php?atualizado=1');
        }
    }




?>