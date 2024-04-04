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

function cpfValidation($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais, o que invalida o CPF
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica se os dígitos verificadores estão corretos
    if ($cpf[9] != $digitoVerificador1 || $cpf[10] != $digitoVerificador2) {
        return false;
    }

    return true;
}

$userAccountValues = json_encode($_POST);
$userAccountValuesDecode = json_decode($userAccountValues);

$csrfToken = $userAccountValuesDecode->csrfToken;
$action = $userAccountValuesDecode->action;

if (!isset($csrfToken) || $csrfToken != $_SESSION['csrf_token']) {
    //erro de autenticação
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {

    //criar um novo usuário
    if (isset($action) && $action === 'create_user') {
        $cpf = $userAccountValuesDecode->cpf;
        $name = $userAccountValuesDecode->name;
        $email = $userAccountValuesDecode->email;
        $user_access = $userAccountValuesDecode->user_access;

        if (!isset($cpf) || !isset($name) || !isset($email) || !isset($user_access) || empty($cpf) || empty($name) || empty($email) || empty($user_access)) {
            //campos obrigatórios
            redirect(array("error" => "erro2", "message" => "Campos obrigatórios."));
        } elseif (!cpfValidation($cpf)) {
            //CPF inválido
            redirect(array("error" => "erro5", "message" => "CPF inválido."));
        } elseif (strlen($name) < 2) {
            //Nome muito curto
            redirect(array("error" => "erro3", "message" => "Verifique o campo nome digitado."));
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            //Email inválido
            redirect(array("error" => "erro6", "message" => "E-mail inválido."));
        } else {

            $model_user->__set("cpf", $cpf);
            $model_user->__set("nome", $name);
            $model_user->__set("email", $email);
            $model_user->__set("usuario_acesso", $user_access);
            // criar uma senha padrão para o novo usuário. A senha padrao é o usuario_acesso
            $password = password_hash($user_access, PASSWORD_DEFAULT);
            $model_user->__set("senha_usuario", $password);

            $service_user = new LoginService($connect, $model_user);

            $result = $service_user->checkUserAccessExists();

            //verificar se o usuário de acesso já existe
            if ($result) {
                redirect(array("error" => "erro7", "message" => "Dados já existentes no sistema"));
            } else {

                $result_create_user = $service_user->createUser();

                if ($result_create_user) {
                    redirect(array("success" => "success", "message" => "Usuário criado com sucesso. A senha gerada é o usuário de acesso."));
                } else {
                    redirect(array("error" => "erro4", "message" => "Erro ao criar usuário."));
                }
            }
        }
    }

    //deletar o usuário
    if (isset($action) && $action === 'delete_user') {

        $user_id = $userAccountValuesDecode->user_id;

        if (!isset($user_id) || empty($user_id)) {
            //campos obrigatórios
            redirect(array("error" => "erro2", "message" => "Selecione um usuário para deletar."));
        } else {
            $model_user->__set("id", $user_id);

            $service_user = new LoginService($connect, $model_user);

            $result_delete_user = $service_user->deleteUser();

            if ($result_delete_user) {
                redirect(array("success" => "success", "message" => "Usuário deletado com sucesso."));
            } else {
                redirect(array("error" => "erro4", "message" => "Erro ao deletar usuário."));
            }
        }
    }

    //alter a permissão do usuário
    if (isset($action) && $action === 'user_permission') {

        $user_id = $userAccountValuesDecode->user_id;
        $permission = $userAccountValuesDecode->permission;

        if (!isset($user_id) || empty($user_id) || !isset($permission) || empty($permission)) {
            //campos obrigatórios
            redirect(array("error" => "erro2", "message" => "Selecione um usuário e uma permissão."));
        } else {
            $model_user->__set("id", $user_id);
            $model_user->__set("tipo_permissao", $permission);

            $service_user = new LoginService($connect, $model_user);

            $result = $service_user->updateUserPermission();

            if ($result) {
                redirect(array("success" => "success", "message" => "Permissão alterada com sucesso."));
            } else {
                redirect(array("error" => "erro4", "message" => "Erro ao alterar permissão."));
            }
        }
    }
}
