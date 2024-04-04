<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<form action="../controllers/register_product_controller.php" method="post">

    <div class="form-floating col-md-6">
        <input type="text" class="form-control" id="total-price-on-product" name="total-price-on-product" placeholder="Preço Total em Produto" value="100000" readonly>
        <label for="total-price-on-product">Preço Total em Produto</label>
    </div>


    <div class="mt-3">
        <button type="submit" class="btn btn-primary" id="btnSend">Salvar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
    </div>
</form>