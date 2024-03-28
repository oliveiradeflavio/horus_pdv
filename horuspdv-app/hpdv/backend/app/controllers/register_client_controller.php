<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../models/register_client_model.php";
require __DIR__ . "/../services/register_client_service.php";

$connect = new DbConnection();
$model_client = new RegisterClientModel();
$service_client = new RegisterClientService($connect, $model_client);

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

$new_client_values = json_encode($_POST);
$new_client_values_decode = json_decode($new_client_values);

$csrf_token = $new_client_values_decode->csrfToken;
$action = $new_client_values_decode->action;

if (!isset($csrf_token) || $csrf_token != $_SESSION['csrf_token']) {
    //erro de autenticação csrf
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {
    //adicionando um novo cliente
    if (isset($action) && $action === "add_client") {

        foreach ($new_client_values_decode as $key => $value) {
            if ($key === "cpf") {
                if (!cpfValidation($value)) {
                    redirect(array("error" => "erro2", "message" => "CPF inválido."));
                }
            }
            if ($key === "email") {
                if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    redirect(array("error" => "erro3", "message" => "E-mail inválido."));
                }
            }
            if ($key === "telephone") {
                if (strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Telefone inválido."));
                }
            }

            if ($key === "cellphone") {
                if (strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Celular inválido."));
                }
            }
            if ($key === "newClientValues") {
                if (strlen($value) < 3) {
                    redirect(array("error" => "erro5", "message" => "Nome inválido."));
                }
            }

            if ($key === "age") {
                if (intval($value) > 130 || intval($value) == 0 || $value  === "") {
                    redirect(array("error" => "erro6", "message" => "Data de Nascimento inválida"));
                }
            }
        }
        // consultar se o cpf já existe no banco de dados 
        $model_client->__set("cpf", $new_client_values_decode->cpf);
        $result = $service_client->checkCpfExists();
        if ($result) {
            redirect(array("error" => "erro7", "message" => "CPF já cadastrado no sistema"));
        } else {

            $nome = $new_client_values_decode->customer_name;
            $cpf = $new_client_values_decode->cpf;
            $rg = $new_client_values_decode->rg;
            $data_nascimento = $new_client_values_decode->birth_date;
            // converter a data de nascimento para o padrão yyyy-mm-dd
            $data_nascimento = date("Y-m-d", strtotime($data_nascimento));
            $idade = $new_client_values_decode->age;
            $cep = $new_client_values_decode->cep;
            $cidade = $new_client_values_decode->city;
            $uf = $new_client_values_decode->state;
            $endereco = $new_client_values_decode->address;
            $bairro = $new_client_values_decode->neighborhood;
            $complemento = $new_client_values_decode->street_complement;
            $numero = $new_client_values_decode->number;
            $ponto_referencia = $new_client_values_decode->reference_point;
            $telefone = $new_client_values_decode->telephone;
            $celular = $new_client_values_decode->cellphone;
            $email = $new_client_values_decode->email;

            //adicionando um novo cliente
            $model_client->__set("nome", $nome);
            $model_client->__set("cpf", $cpf);
            $model_client->__set("rg", $rg);
            $model_client->__set("data_nascimento", $data_nascimento);
            $model_client->__set("idade", $idade);
            $model_client->__set("cep", $cep);
            $model_client->__set("cidade", $cidade);
            $model_client->__set("uf", $uf);
            $model_client->__set("endereco", $endereco);
            $model_client->__set("bairro", $bairro);
            $model_client->__set("complemento", $complemento);
            $model_client->__set("numero", $numero);
            $model_client->__set("ponto_referencia", $ponto_referencia);
            $model_client->__set("telefone", $telefone);
            $model_client->__set("celular", $celular);
            $model_client->__set("email", $email);

            $result_add_client = $service_client->addClient();

            if ($result_add_client) {
                redirect(array("success" => "sucesso", "message" => "Cliente cadastrado com sucesso"));
            } else {
                redirect(array("error" => "erro8", "message" => "Erro ao cadastrar cliente"));
            }
        }
    }
}
