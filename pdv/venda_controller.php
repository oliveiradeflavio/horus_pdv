<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
