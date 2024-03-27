<?php
session_start();

require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../models/login_model.php";
require __DIR__ . "/../services/login_service.php";

$connect = new DbConnection();
$model_user = new LoginModel();

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}

$access_credentials = json_encode($_POST);
$access_credentials_decode = json_decode($access_credentials);

$csrf_token = $access_credentials_decode->csrfToken;
$name = $access_credentials_decode->name;
$email = $access_credentials_decode->email;
$oldPassword = $access_credentials_decode->oldPassword;
$newPassword = $access_credentials_decode->newPassword;
$statusChangePassword = $access_credentials_decode->statusChangePassword;

if (!isset($csrf_token) || $csrf_token != $_SESSION['csrf_token']) {
    //erro de autenticação csrf
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {

    if ($statusChangePassword == "true") {

        //usuário irá trocar de senha
        if (!isset($name) || !isset($email) || empty($name) || empty($email)) {
            //Nome ou email inválidos
            redirect(array("error" => "erro2", "message" => "Verifique se os campos nome e e-mail estão preenchidos corretamente."));
        } elseif (strlen($name) < 2) {
            //Nome muito curto
            redirect(array("error" => "erro3", "message" => "Verifique o campo nome digitado."));
        } elseif ($oldPassword === "" && $newPassword === "") {
            //Senha antiga e nova senha vazias
            redirect(array("error" => "erro4", "message" => "Campo senha e nova senha vazios."));
        } elseif (strlen($oldPassword) < 6 || strlen($newPassword) < 6) {
            //senha muito curta
            redirect(array("error" => "erro5", "message" => "A senha deve ter no mínimo 6 caracteres."));
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            //Email inválido
            redirect(array("error" => "erro6", "message" => "E-mail inválido."));
        } else {
            //validação da senha antiga que esta no banco de dados. 
            //Usuário deve digitar a senha antiga corretamente para poder trocar de senha já que ele esta logado no sistema
            $access_user = $_SESSION['access_user'];
            $model_user->__set("usuario_acesso", $access_user);
            $service_user = new LoginService($connect, $model_user);
            $verifyPassword = $service_user->verifyPassword();

            if (!password_verify($oldPassword, $verifyPassword->senha_usuario)) {
                redirect(array("error" => "erro7", "message" => "Senha antiga incorreta."));
            } else {

                // verificar se existem dados iguais no banco de dados 
                $model_user->__set('id', $_SESSION['id_user']);
                $model_user->__set("email", $email);
                $service_user = new LoginService($connect, $model_user);

                $result = $service_user->checkEmailExists();

                if ($result) {
                    redirect(array("error" => "erro7", "message" => "Dados já existentes no sistema"));
                } else {

                    //Usuário irá trocar de senha
                    $model_user->__set("id", $_SESSION['id_user']);
                    $model_user->__set("nome", $name);
                    $model_user->__set("email", $email);
                    $model_user->__set("senha_usuario", password_hash($newPassword, PASSWORD_DEFAULT));
                    $service_user = new LoginService($connect, $model_user);

                    $result = $service_user->updateProfile();
                    if ($result) {
                        redirect(array("success" => "success", "message" => "Perfil atualizado com sucesso."));
                    } else {
                        redirect(array("error" => "erro7", "message" => "Erro ao atualizar o perfil."));
                    }
                }
            }
        }
    }
    if ($statusChangePassword == "false") {
        //usuário não irá  trocar de senha
        if (!isset($name) || !isset($email) || empty($name) || empty($email)) {
            //Nome ou email inválidos
            redirect(array("error" => "erro2", "message" => "Verifique se os campos nome e e-mail estão preenchidos corretamente."));
        } elseif (strlen($name) < 2) {
            //Nome muito curto
            redirect(array("error" => "erro3", "message" => "Verifique o campo nome digitado."));
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            //Email inválido
            redirect(array("error" => "erro6", "message" => "E-mail inválido."));
        } else {

            // verificar se existem dados iguais no banco de dados 
            $model_user->__set('id', $_SESSION['id_user']);
            $model_user->__set("email", $email);
            $service_user = new LoginService($connect, $model_user);

            $result = $service_user->checkEmailExists();

            if ($result) {
                redirect(array("error" => "erro7", "message" => "Dados já existentes no sistema"));
            } else {
                $model_user->__set("id", $_SESSION['id_user']);
                $model_user->__set("nome", $name);
                $model_user->__set("email", $email);
                $service_user = new LoginService($connect, $model_user);
                $result = $service_user->updateProfileNoPassword();
                if ($result) {
                    redirect(array("success" => "success", "message" => "Perfil atualizado com sucesso."));
                } else {
                    redirect(array("error" => "erro7", "message" => "Erro ao atualizar o perfil."));
                }
            }
        }
    }
}
