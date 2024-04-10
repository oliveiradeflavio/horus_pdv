<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../models/sales_model.php";
require __DIR__ . "/../services/sales_service.php";

$connect = new DbConnection();
$model_sale = new SalesModel();
$sale_service = new SalesSerivce($connect, $model_sale);

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}

$sale_values = json_encode($_POST);
$sale_values_decoder = json_decode($sale_values);

$csrf_token = $sale_values_decoder->csrf_token;
$action = $sale_values_decoder->action;

if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
    //erro de autenticação csrf -
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {
    //verifica se a ação é de cadastro de venda
    if ($action == "register_sale") {

        //gerar um contato que será o numero da venda 
        $sale_number = $sale_service->getSaleNumber();
        if (count($sale_number) > 0) {
            $count = $sale_number[0]->numero_da_venda;
            $count = $count + 1;
        } else {
            $count = 1;
        }

        $seller = $_SESSION['access_user']; //vendedor usuario de acesso
        $client = $sale_values_decoder->client;
        $subtotal = $sale_values_decoder->subtotal;
        $payment_type = $sale_values_decoder->payment_type;
        $discount = $sale_values_decoder->discount;
        $disconunted_price = $sale_values_decoder->disconunted_price;
        $amount_paid = $sale_values_decoder->amount_paid;
        $cd_transaction_pix = $sale_values_decoder->cd_transaction_pix;

        //dar baixa no estoque de produtos vendidos e atualizar o estoque de acordo com a quantidade vendida
        //aqui é necessário fazer um loop para cada produto vendido
        //para cada produto vendido é necessário atualizar o estoque
        //para atualizar o estoque é necessário fazer um select para pegar a quantidade atual do produto
        //depois fazer um update subtraindo a quantidade vendida da quantidade atual
        //para cada produto vendido
        //depois de atualizar o estoque de cada produto vendido
        //retornar uma mensagem de sucesso
        foreach ($sale_values_decoder->products as $product) {
            $model_sale->__set("id", $product->product_id);
            $product_data = $sale_service->getProductData();

            $quantity_product_bd = $product_data->quantidade_produto;

            if ($quantity_product_bd < $product->quantity) {
                redirect(array("error" => "erro3", "message" => "Quantidade insuficiente no estoque."));
            } else {
                $new_quantity = $quantity_product_bd - $product->quantity;

                //atualizar o preco total em produto de acordo com a nova quantidade
                $unity_price_product_bd = $product_data->preco_unitario_produto;
                $total_price_product_bd = $product_data->preco_total_em_produto;

                $new_price_in_product = str_replace('.', '',  $unity_price_product_bd);
                $new_price_in_product = str_replace(',', '.',  $new_price_in_product);

                $new_price_in_product = floatval($new_price_in_product);

                $new_price_in_product  = $new_quantity * $new_price_in_product;

                $new_price_in_product = number_format($new_price_in_product, 2, ',', '.');

                $new_total_price_product_bd = $new_price_in_product;

                $model_sale->__set("quantidade_produto", $new_quantity);
                $model_sale->__set("preco_total_em_produto", $new_total_price_product_bd);
                $model_sale->__set("id", $product->product_id);

                $sale_service->updateProductQuantity();
            }
        }

        // Product esta como um array de objetos
        // Contendo product_id, quantity, price 
        // Para poder salvar cada produto com esse cliente é necessário fazer um loop e salvar cada produto para esse cliente
        $return = array();
        foreach ($sale_values_decoder->products as $product) {
            $model_sale->__set("numero_da_venda", $count);
            $model_sale->__set("cliente", $client);
            $model_sale->__set("vendedor", $seller);
            $model_sale->__set("subtotal", $subtotal);
            $model_sale->__set("tipo_de_pagamento", $payment_type);
            $model_sale->__set("desconto", $discount);
            $model_sale->__set("valor_com_desconto", $disconunted_price);
            $model_sale->__set("valor_a_ser_pago", $amount_paid);
            $model_sale->__set("codigo_de_transacao_ou_chave_pix", $cd_transaction_pix);
            $model_sale->__set("produto", $product->product_id);
            $model_sale->__set("quantidade", $product->quantity);
            $model_sale->__set("valor_unitario", $product->price);

            //
            $return[] = $sale_service->registerSale();
        }
        if (in_array(0, $return)) {
            redirect(array("error" => "erro2", "message" => "Erro ao cadastrar venda."));
        } else {
            redirect(array("success" => "sucesso", "id" => strval($count), "message" => "Venda realizada com sucesso." . $count));
        }
    } else {
        //erro de ação não encontrada
        redirect(array("error" => "erro2", "message" => "Ação não encontrada."));
    }
}
