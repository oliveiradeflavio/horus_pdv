<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../models/register_product_model.php";
require __DIR__ . "/../services/register_product_service.php";

$connect = new DbConnection();
$model_product = new RegisterProductModel();
$service_product = new RegisterProductService($connect, $model_product);

function redirect($msg)
{
    header('Location: ../web/cadastro-produto?' . http_build_query($msg));
    exit();
}

//se o usuário não por imagem no produto, a imagem padrão será essa
function defaultImage()
{
    return 'produto-sem-imagem.webp';
}

//diretório onde as imagens dos produtos serão salvas
function savedIamgeDirectory()
{
    return "../assets/img/products/";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    $new_product_values = $_POST;
    $img_product = $_FILES['img-product'];

    $csrf_token = $new_product_values['csrf_token'];
    $action = $new_product_values['action'];
    $product_name = $new_product_values['product-name'];
    $product_code = $new_product_values['product-code'];
    $product_supplier = $new_product_values['product-supplier'];
    $product_description = $new_product_values['product-description'];
    $product_qnt = $new_product_values['product-qnt'];
    $product_unit_price = $new_product_values['product-unit-price'];
    $product_sale_price = $new_product_values['product-sale-price'];
    $total_price_on_product = $new_product_values['total-price-on-product'];

    if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
        redirect(['error' => 'erro2', "message" => 'Erro de autenticação']);
    } else {

        //adicionar um novo produto
        if (isset($action) && $action === "add_product") {

            //consultar se o codigo do produto já existe no banco de dados
            $model_product->__set('codigo_produto', $product_code);
            $result = $service_product->searchProductByCode();

            if ($result) {
                redirect(['error' => 'erro3', "message" => 'Código do produto já existe']);
            } else {

                //verificar se o usuário enviou uma imagem, caso contrário, a imagem padrão será usada
                if (empty($img_product['name'])) {
                    $img_product = defaultImage();

                    $model_product->__set('nome_produto', $product_name);
                    $model_product->__set('codigo_produto', $product_code);
                    $model_product->__set('fornecedor', $product_supplier);
                    $model_product->__set('descricao_produto', $product_description);
                    $model_product->__set('quantidade_produto', $product_qnt);
                    $model_product->__set('preco_unitario_produto', $product_unit_price);
                    $model_product->__set('preco_venda_produto', $product_sale_price);
                    $model_product->__set('preco_total_em_produto', $total_price_on_product);
                    $model_product->__set('imagem_produto', $img_product);
                    $result =  $service_product->registerProduct();

                    if ($result) {
                        redirect(['success' => 'sucesso', "message" => 'Produto cadastrado com sucesso']);
                    } else {
                        redirect(['error' => 'erro5', "message" => 'Erro ao cadastrar produto']);
                    }
                } else {

                    $error = array(); //array para armazenar erros

                    // verifica se o arquivo é uma imagem
                    if (!preg_match("/^image\/(jpeg|jpg|png|webp)$/", $img_product['type'])) {
                        $error[1] = "Formato de imagem inválido. Permitido apenas jpeg, jpg, png e webp";
                        redirect(['error' => 'erro4', "message" => 'Formato de imagem inválido']);
                    }

                    if (count($error) === 0) {

                        $altered_product_img = $img_product['name'];
                        $extension = strtolower(substr($altered_product_img, -4));
                        $new_name_img_product = md5($altered_product_img) . "." . $extension;

                        //salva a imagem no diretório
                        move_uploaded_file($img_product['tmp_name'], savedIamgeDirectory() . $new_name_img_product);

                        $model_product->__set('nome_produto', $product_name);
                        $model_product->__set('codigo_produto', $product_code);
                        $model_product->__set('fornecedor', $product_supplier);
                        $model_product->__set('descricao_produto', $product_description);
                        $model_product->__set('quantidade_produto', $product_qnt);
                        $model_product->__set('preco_unitario_produto', $product_unit_price);
                        $model_product->__set('preco_venda_produto', $product_sale_price);
                        $model_product->__set('preco_total_em_produto', $total_price_on_product);
                        $model_product->__set('imagem_produto', $new_name_img_product);
                        $result =  $service_product->registerProduct();

                        if ($result) {
                            redirect(['success' => 'sucesso', "message" => 'Produto cadastrado com sucesso']);
                        } else {
                            redirect(['error' => 'erro5', "message" => 'Erro ao cadastrar produto']);
                        }
                    }
                }
            }
        }
    }
    //atualizar os dados do produto
    if (isset($action) && $action === "update") {

        //consultar se o codigo do produto já existe no banco de dados
        $model_product->__set('codigo_produto', $product_code);
        $model_product->__set('id', $new_product_values['id']);
        $result = $service_product->searchProductByCodeUpdate();

        if ($result) {
            redirect(['error' => 'erro3', "message" => 'Código do produto já existe']);
        } else {

            //verificar se o usuário enviou uma imagem, caso contrário, a imagem padrão será usada
            if (empty($img_product['name'])) {

                $model_product->__set('nome_produto', $product_name);
                $model_product->__set('codigo_produto', $product_code);
                $model_product->__set('fornecedor', $product_supplier);
                $model_product->__set('descricao_produto', $product_description);
                $model_product->__set('quantidade_produto', $product_qnt);
                $model_product->__set('preco_unitario_produto', $product_unit_price);
                $model_product->__set('preco_venda_produto', $product_sale_price);
                $model_product->__set('preco_total_em_produto', $total_price_on_product);
                $result =  $service_product->updateProductWithouImage();

                if ($result) {
                    redirect(['success' => 'sucesso', "message" => 'Produto atualizado com sucesso']);
                } else {
                    redirect(['error' => 'erro5', "message" => 'Erro ao atualizar produto']);
                }
            } else {

                $error = array(); //array para armazenar erros

                // verifica se o arquivo é uma imagem
                if (!preg_match("/^image\/(jpeg|jpg|png|webp)$/", $img_product['type'])) {
                    $error[1] = "Formato de imagem inválido. Permitido apenas jpeg, jpg, png e webp";
                    redirect(['error' => 'erro4', "message" => 'Formato de imagem inválido']);
                }

                if (count($error) === 0) {

                    $altered_product_img = $img_product['name'];
                    $extension = strtolower(substr($altered_product_img, -4));
                    $new_name_img_product = md5($altered_product_img) . "." . $extension;

                    //salva a imagem no diretório
                    move_uploaded_file($img_product['tmp_name'], savedIamgeDirectory() . $new_name_img_product);

                    $model_product->__set('nome_produto', $product_name);
                    $model_product->__set('codigo_produto', $product_code);
                    $model_product->__set('fornecedor', $product_supplier);
                    $model_product->__set('descricao_produto', $product_description);
                    $model_product->__set('quantidade_produto', $product_qnt);
                    $model_product->__set('preco_unitario_produto', $product_unit_price);
                    $model_product->__set('preco_venda_produto', $product_sale_price);
                    $model_product->__set('preco_total_em_produto', $total_price_on_product);
                    $model_product->__set('imagem_produto', $new_name_img_product);

                    $result =  $service_product->updateProduct();

                    if ($result) {
                        redirect(['success' => 'sucesso', "message" => 'Produto atualizado com sucesso']);
                    } else {
                        redirect(['error' => 'erro5', "message" => 'Erro ao atualizar produto']);
                    }
                }
            }
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {

    $new_product_values = json_encode($_GET);
    $new_product_values_decode = json_decode($new_product_values);

    $csrf_token = $new_product_values_decode->csrfToken;
    $action = $new_product_values_decode->action;

    if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
        echo json_encode(array("error" => "erro", "message" => "Erro de autenticação "));
    } else {
        //pesquisando produto
        if (isset($action) && $action === "search_product") {
            $valueSearch = $new_product_values_decode->valueSearch;

            $model_product->__set('valueSearch', $valueSearch);
            $result = $service_product->searchProduct();

            if ($result) {
                echo json_encode($result);
            } else {
                echo json_encode(array("error" => "erro2", "message" => "Nenhum produto encontrado"));
            }
        }
        // deletar produto
        if (isset($action) && $action === "delete") {
            $id = $new_product_values_decode->id;
            $model_product->__set('id', $id);
            $result = $service_product->deleteProduct();

            if ($result) {
                echo json_encode(array("success" => "sucesso", "message" => "Produto deletado com sucesso"));
            } else {
                echo json_encode(array("error" => "erro3", "message" => "Erro ao deletar produto"));
            }
        }
    }
} else {
    redirect(['error' => 'erro1', "message" => 'Nenhum dado enviado']);
}
