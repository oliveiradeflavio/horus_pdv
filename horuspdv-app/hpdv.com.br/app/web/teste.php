<?php

$data_nascimento = '10/10/1990';
// converter a data de nascimento para o padrão yyyy-mm-dd
$data_nascimento = date("Y-m-d", strtotime($data_nascimento));

print_r($data_nascimento);
