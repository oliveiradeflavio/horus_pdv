<?php

//     $senha = isset($_POST['inputSenha']) ? $_POST['inputSenha'] : '';
//     $senha = md5($senha);
//     echo $senha;


//     // require "../pdv/configuracoes_controller.php";

//     // $configuracoes = $configuracoesService->consultaConfiguracoes();

//     // foreach ($configuracoes as $i => $config){
//     //     print_r($config->senha_master_configuracoes);
//     // }

// $quantidade = '20000';
// $preco_unitario = '10,11';
// $preco_unitario = str_replace(',', '.', $preco_unitario);
// $preco_unitario = floatval($preco_unitario);
// echo $preco_unitario;

// $preco_total_produto = $preco_unitario * $quantidade;
// $preco_total_produto = number_format($preco_total_produto, 2, ',', '.');
// echo $preco_total_produto;

// require_once __DIR__ . '/plugins/vendor/autoload.php';
// use Mpdf\Mpdf;

// $mpdf = new Mpdf();
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();


?>

<!-- // <html>
//     <form action="teste.php" method="post">
//     <input type="text" name="inputSenha" id="">
//     <button type="submit">Enviar</button>
//     </form> -->

<!-- Default switch -->

  <!-- cdn bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="customSwitch1">
  <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
</div>
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
  <label class="custom-control-label" for="customSwitch2">Disabled switch element</label>
</div>

</html>