<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
$connect = new DbConnection();
$connect = $connect->getConnection();

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}


$values = json_encode($_POST);
$values_decode = json_decode($values);

$action = $values_decode->action;
$csrf_token = $values_decode->csrf_token;

if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
    //erro de autenticação csrf - cross-site request forgery
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
} else {

    if ($action === "search_sales") {

        $search = $values_decode->search;
        //remover os espaços em branco no final e no inicio da string
        $search = trim($search);
        $query = "SELECT v.*, 
                    c.nome, c.cpf,
                    p.nome_produto, 
                    p.id 
                    FROM tb_vendas v 
                    JOIN tb_clientes c ON v.cliente = c.id 
                    JOIN tb_produtos p ON v.produto = p.id 
                    WHERE v.numero_da_venda LIKE :search OR c.cpf LIKE :search
                    GROUP BY v.id 
                    ORDER BY v.id ASC;";
        $stmt = $connect->prepare($query);
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (count($results) > 0) {
            echo json_encode($results);
        } else {
            echo json_encode(array("error" => "erro2", "message" => "Nenhuma venda encontrada."));
        }
    }
}
