<?php require "../layouts/session.php";
require_once '../controllers/db_connection.php';
$connect = new DbConnection();
$connect = $connect->getConnection();

#carregar os clientes
$client_sql = "SELECT * FROM tb_clientes ORDER BY nome ASC";
$stmt = $connect->prepare($client_sql);
$stmt->execute();
$result_client = $stmt->fetchAll(PDO::FETCH_OBJ);

#carregar os produtos
$product_sql = "SELECT * FROM tb_produtos ORDER BY nome_produto ASC";
$stmt = $connect->prepare($product_sql);
$stmt->execute();
$result_product = $stmt->fetchAll(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/sales.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/pt-BR.js"></script>

<body>

    <main>
        <section class="section-product-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-list">
                            <select name="" id="select_client" class="form-select" required>
                                <option value="">Selecione um cliente</option>
                                <option value="Consumidor(sem cadastro realizado)">Consumidor (sem cadastro realizado)</option>
                                <?php foreach ($result_client as $client) : ?>
                                    <option value="<?php echo $client->id ?>"><?php echo $client->nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-list">
                            <select name="select_product" id="select_product" class="form-select" required>
                                <option value="">Selecione um produto</option>
                                <?php foreach ($result_product as $product) : ?>
                                    <option value="<?php echo $product->id ?>" data-id="<?= $product->id ?>" data-price="<?= $product->preco_venda_produto ?>" data-img="<?= $product->imagem_produto ?>" data-qnt="<?= $product->quantidade_produto ?>"><?php echo $product->nome_produto ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="container container_product">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control number_only" id="product_quantity" placeholder="Quantidade" value="0">
                                        <label for="product_quantity" class="required-field-label">Quantidade</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="unit_price" placeholder="Valor Unitário" disabled value="R$00,00">
                                        <label for="unit_price" class="required-field-label">Valor Unitário</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="total_price" placeholder="Valor Total" disabled value="R$00,00">
                                        <label for="total_price" class="required-field-label">Valor Total</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <button class="btn btn-success btn-lg" id="add_product" onclick="addProductTable()" disabled>Adicionar Produto</button>
                                </div>
                            </div>
                            <div class="container-product-preview">
                                <div>
                                    <img id="preview_img" src="../assets/img/avatar/shopping-cart.webp" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="container container-cupom">
                            <div class="cupom">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table_product">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col">Nº PEDIDO</th> -->
                                                <th scope="col">CÓDIGO</th>
                                                <th scope="col">PRODUTO</th>
                                                <th scope="col">VLR. UN.</th>
                                                <th scope="col">QTD</th>
                                                <th scope="col">VLR. TOTAL</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="subtotal mt-5">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subtotal" placeholder="Sub-total" disabled value="R$00,00">
                                    <label for="subtotal">Sub-total</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container-operation">
                            <button class="btn btn-lg btn-primary" onclick="closeSale()" id="close_sale" disabled>Fechar Pedido</button>
                            <button class="btn btn-lg btn-danger" onclick="cancelSale()">Cancelar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container-system">
                            <label for="">Usuário Logado: Teste</label>
                            <label for="">Data: <?php echo date("d/m/Y") ?></label>
                            <label for="">Dia da Semana: <?php
                                                            // date_default_timezone_set('UTC');
                                                            // $date = new IntlDateFormatter(
                                                            //     'pt_BR',
                                                            //     IntlDateFormatter::FULL,
                                                            //     IntlDateFormatter::FULL,
                                                            //     'America/Sao_Paulo',
                                                            //     IntlDateFormatter::GREGORIAN
                                                            // );
                                                            // $dia_da_semana = $date->format(new DateTime());
                                                            setlocale(LC_TIME, 'pt_BR');
                                                            $dia_da_semana  = array(
                                                                "Sunday" => "Domingo",
                                                                "Monday" => "Segunda-feira",
                                                                "Tuesday" => "Terça-feira",
                                                                "Wednesday" => "Quarta-feira",
                                                                "Thursday" => "Quinta-feira",
                                                                "Friday" => "Sexta-feira",
                                                                "Saturday" => "Sábado"
                                                            );
                                                            $dia_da_semana = $dia_da_semana[date('l')];
                                                            echo $dia_da_semana; ?></label>
                        </div>

                    </div>
                </div>
            </div> -->
        </footer>
    </main>

    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-close-order" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-title">
                        <button type="button" class="btn-close btn-close-white" onclick="backToSale()" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <form action="#" method="post" id="formCloseOrder">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="sale">
                            <div>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="total_sale" readonly disabled placeholder="Total da Venda">
                                        <label for="total_sale">Total da Venda</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select id="payment_type" name="payment_type" class="form-select" title="Tipo de Pagamento" required>
                                        <option value="dinheiro">Dinheiro</option>
                                        <option value="cartão de crédito">Cartão de Crédito</option>
                                        <option value="cartão de débito">Cartão de Débito</option>
                                        <option value="vale alimentação/vale cesta">Vale Alimentação / Vale Cesta</option>
                                        <option value="pix">Pix</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6 mt-3">
                                        <input type="text" minlength="0" maxlength="100" class="form-control number_only" id="discount" placeholder="Desconto">
                                        <label for="discount">Desconto em %</label>
                                    </div>

                                    <div class="form-floating col-md-6 mt-3">
                                        <input type="text" class="form-control" id="disconunted_price" disabled placeholder="Valor com Desconto">
                                        <label for="disconunted_price">Valor com desconto</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-floating mt-3">
                                        <input type="text" class="form-control" id="cd_transaction_pix" disabled placeholder="Código de transação ou Chave Pix">
                                        <label for="cd_transaction_pix" class="required-field-label">Código de transação ou chave Pix</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-floating mt-3">
                                        <input type="text" class="form-control" id="amount_paid" placeholder="Valor Pago" disabled>
                                        <label for="amount_paid" class="required-field-label">Valor a ser pago</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-lg" id="closeSaleModal">Fechar Venda</button>
                                    <button type="button" class="btn btn-secondary btn-lg" onclick="backToSale()">Voltar para venda</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="../js/_component/validation.js"></script>
<script src="../js/_component/mask.js"></script>
<script src="../js/sales.js"></script>

</html>