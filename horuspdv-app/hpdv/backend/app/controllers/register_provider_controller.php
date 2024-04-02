<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../models/register_provider_model.php";
require __DIR__ . "/../services/register_provider_service.php";

$connect = new DBConnection();
$model_provider = new RegisterProviderModel();
$service_provider = new RegisterProviderService($connect, $model_provider);

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}

function cnpjValidation($cnpj)
{
    // Remove caracteres especiais do CNPJ
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    // Verifica se o CNPJ possui 14 dígitos
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Verifica se todos os dígitos são iguais, o que é um CNPJ inválido
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0, $j = 5; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $dv1 = ($resto < 2) ? 0 : 11 - $resto;

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0, $j = 6; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $dv2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica se os dígitos verificadores estão corretos
    if ($cnpj[12] != $dv1 || $cnpj[13] != $dv2) {
        return false;
    }

    return true;
}

$new_provider_values = json_encode($_POST);
$new_provider_values_decode = json_decode($new_provider_values);

$csrf_token = $new_provider_values_decode->csrfToken;
$action = $new_provider_values_decode->action;

if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
    //erro de autenticação csrf -
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {

    //adicionando um novo fornecedor
    if (isset($action) && $action === "add_provider") {

        foreach ($new_provider_values_decode as $key => $value) {
            if ($key === "cnpj") {
                if (!cnpjValidation($value)) {
                    redirect(array("error" => "erro2", "message" => "CNPJ inválido."));
                }
            }

            if ($key === "email") {
                if ($value != "" && filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    redirect(array("error" => "erro3", "message" => "E-mail inválido."));
                }
            }
            if ($key === "telephone") {
                if ($value != "" && strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Telefone inválido."));
                }
            }

            if ($key === "cellphone") {
                if (strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Celular inválido."));
                }
            }
            if ($key === "fantasy_name") {
                if (strlen($value) < 3) {
                    redirect(array("error" => "erro5", "message" => "Nome fantasia inválido."));
                }
            }

            if ($key === "company_name") {
                if (strlen($value) < 3) {
                    redirect(array("error" => "erro6", "message" => "Razão social inválida."));
                }
            }
        }

        // consultar se o cnpj já existe no banco de dados
        $model_provider->__set('cnpj', $new_provider_values_decode->cnpj);
        $result = $service_provider->checkCNPJExists();
        if ($result) {
            redirect(array("error" => "erro7", "message" => "CNPJ já cadastrado."));
        } else {

            $razao_social = $new_provider_values_decode->company_name;
            $nome_fantasia = $new_provider_values_decode->fantasy_name;
            $cnpj = $new_provider_values_decode->cnpj;
            $cep = $new_provider_values_decode->cep;
            $cidade = $new_provider_values_decode->city;
            $uf = $new_provider_values_decode->state;
            $endereco = $new_provider_values_decode->address;
            $bairro = $new_provider_values_decode->neighborhood;
            $complemento = $new_provider_values_decode->street_complement;
            $numero = $new_provider_values_decode->number;
            $ponto_referencia = $new_provider_values_decode->reference_point;
            $telefone = $new_provider_values_decode->telephone;
            $celular = $new_provider_values_decode->cellphone;
            $email = $new_provider_values_decode->email;

            // adicionando um novo fornecedor
            $model_provider->__set('razao_social', $razao_social);
            $model_provider->__set('nome_fantasia', $nome_fantasia);
            $model_provider->__set('cnpj', $cnpj);
            $model_provider->__set('cep', $cep);
            $model_provider->__set('cidade', $cidade);
            $model_provider->__set('uf', $uf);
            $model_provider->__set('endereco', $endereco);
            $model_provider->__set('bairro', $bairro);
            $model_provider->__set('complemento', $complemento);
            $model_provider->__set('numero', $numero);
            $model_provider->__set('ponto_referencia', $ponto_referencia);
            $model_provider->__set('telefone', $telefone);
            $model_provider->__set('celular', $celular);
            $model_provider->__set('email', $email);

            $result_add_provider = $service_provider->addProvider();

            if ($result_add_provider) {
                redirect(array("success" => "successo", "message" => "Fornecedor cadastrado com sucesso."));
            } else {
                redirect(array("error" => "erro8", "message" => "Erro ao cadastrar fornecedor."));
            }
        }
    }
    //pesquisando fornecedor	
    if (isset($action) && $action === "search_provider") {
        $valueSearch = $new_provider_values_decode->valueSearch;

        if ($valueSearch === "") {
            redirect(array("error" => "erro9", "message" => "Campo de pesquisa vazio."));
        } else {
            $model_provider->__set('valueSearch', $valueSearch);
            $result_searcy_provider = $service_provider->searchProvider();
            if ($result_searcy_provider) {
                echo json_encode($result_searcy_provider);
            } else {
                redirect(array("error" => "erro10", "message" => "Nenhum fornecedor encontrado."));
            }
        }
    }

    //excluir o fornecedor
    if (isset($action) && $action === "delete") {
        $id = $new_provider_values_decode->id;
        $model_provider->__set('id', $id);
        $result_delete_provider = $service_provider->deleteProvider();
        if ($result_delete_provider) {
            redirect(array("success" => "successo", "message" => "Fornecedor excluído com sucesso."));
        } else {
            redirect(array("error" => "erro11", "message" => "Erro ao excluir fornecedor."));
        }
    }

    //alterar fornecedor
    if (isset($action) && $action === 'update') {

        foreach ($new_provider_values_decode as $key => $value) {
            if ($key === "cnpj") {
                if (!cnpjValidation($value)) {
                    redirect(array("error" => "erro2", "message" => "CNPJ inválido."));
                }
            }

            if ($key === "email") {
                if ($value != "" && filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    redirect(array("error" => "erro3", "message" => "E-mail inválido."));
                }
            }
            if ($key === "telephone") {
                if ($value != "" && strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Telefone inválido."));
                }
            }

            if ($key === "cellphone") {
                if (strlen($value) < 14) {
                    redirect(array("error" => "erro4", "message" => "Celular inválido."));
                }
            }
            if ($key === "fantasy_name") {
                if (strlen($value) < 3) {
                    redirect(array("error" => "erro5", "message" => "Nome fantasia inválido."));
                }
            }

            if ($key === "company_name") {
                if (strlen($value) < 3) {
                    redirect(array("error" => "erro6", "message" => "Razão social inválida."));
                }
            }
        }

        //verificar se o cnjp já existe no banco de dados
        $model_provider->__set('cnpj', $new_provider_values_decode->cnpj);
        $model_provider->__set('id', $new_provider_values_decode->id);
        $result = $service_provider->checkCNPJExistsUpdate();
        if ($result) {
            redirect(array("error" => "erro7", "message" => "CNPJ já cadastrado."));
        } else {
            $id = $new_provider_values_decode->id;
            $razao_social = $new_provider_values_decode->company_name;
            $nome_fantasia = $new_provider_values_decode->fantasy_name;
            $cnpj = $new_provider_values_decode->cnpj;
            $cep = $new_provider_values_decode->cep;
            $cidade = $new_provider_values_decode->city;
            $uf = $new_provider_values_decode->state;
            $endereco = $new_provider_values_decode->address;
            $bairro = $new_provider_values_decode->neighborhood;
            $complemento = $new_provider_values_decode->street_complement;
            $numero = $new_provider_values_decode->number;
            $ponto_referencia = $new_provider_values_decode->reference_point;
            $telefone = $new_provider_values_decode->telephone;
            $celular = $new_provider_values_decode->cellphone;
            $email = $new_provider_values_decode->email;

            //alterando o fornecedor
            $model_provider->__set('id', $id);
            $model_provider->__set('razao_social', $razao_social);
            $model_provider->__set('nome_fantasia', $nome_fantasia);
            $model_provider->__set('cnpj', $cnpj);
            $model_provider->__set('cep', $cep);
            $model_provider->__set('cidade', $cidade);
            $model_provider->__set('uf', $uf);
            $model_provider->__set('endereco', $endereco);
            $model_provider->__set('bairro', $bairro);
            $model_provider->__set('complemento', $complemento);
            $model_provider->__set('numero', $numero);
            $model_provider->__set('ponto_referencia', $ponto_referencia);
            $model_provider->__set('telefone', $telefone);
            $model_provider->__set('celular', $celular);
            $model_provider->__set('email', $email);

            $result_update = $service_provider->updateProvider();

            if ($result_update) {
                redirect(array("success" => "successo", "message" => "Fornecedor alterado com sucesso."));
            } else {
                redirect(array("error" => "erro12", "message" => "Erro ao alterar fornecedor."));
            }
        }
    }
}
