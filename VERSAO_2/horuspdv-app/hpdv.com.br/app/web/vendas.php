<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/vendas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<body>

    <main>
        <section class="section-product-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-list">
                            <select name="" id="select_client" class="form-select" required>
                                <option value="">Selecione um cliente</option>
                                <option value="">Consumidor (sem cadastro realizado)</option>
                                <option value="">Cliente 1</option>
                                <option value="">Cliente 2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-list">
                            <select name="" id="select_product" class="form-select" required>
                                <option value="">Selecione um produto</option>
                                <option value="">Coca Cola</option>
                                <option value="">Suco</option>
                                <option value="">Alface</option>
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
                                        <input type="text" class="form-control" id="quantidade_produto" placeholder="Quantidade" value="0">
                                        <label for="quantidade_produto" class="required-field-label">Quantidade</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="valor_unitario" placeholder="Valor Unitário" disabled value="R$00,00">
                                        <label for="valor_unitario" class="required-field-label">Valor Unitário</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="valor_total" placeholder="Valor Total" disabled value="R$00,00">
                                    <label for="valor_total" class="required-field-label">Valor Total</label>
                                </div>
                            </div>
                            <div class="container-product-preview">
                                <div>
                                    <img src="../assets/img/avatar/shopping-cart.webp" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="container container-cupom">
                            <div class="cupom">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nº PEDIDO</th>
                                                <th scope="col">CÓDIGO</th>
                                                <th scope="col">PRODUTO</th>
                                                <th scope="col">VLR. UN.</th>
                                                <th scope="col">QTD</th>
                                                <th scope="col">VLR. TOTAL</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>00001</td>
                                                <td>12121231</td>
                                                <td>Coca Cola</td>
                                                <td>R$ 5,00</td>
                                                <td>2</td>
                                                <td>R$ 10,00</td>
                                                <td>
                                                    <i class="fas fa-trash-alt"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>00001</td>
                                                <td>12121231</td>
                                                <td>Coca Cola Coca Cola Coca Cola </td>
                                                <td>R$ 5,00</td>
                                                <td>2</td>
                                                <td>R$ 10,00</td>
                                                <td>
                                                    <i class="fas fa-trash-alt"></i>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="subtotal mt-5">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sub-total" placeholder="Sub-total" disabled value="R$00,00">
                                    <label for="sub-total">Sub-total</label>
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
                            <button class="btn btn-lg btn-primary" onclick="exibir('modal-fechar-pedido')">Fechar Pedido</button>
                            <button class="btn btn-lg btn-danger">Cancelar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
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
            </div>
        </footer>
    </main>

    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-fechar-pedido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-title">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <form action="#" method="post" id="formFecharPedido">
                            <input type="hidden" name="csrf_token">
                            <input type="hidden" name="action">
                            <div>
                                <div class="form-group mb-3">
                                    <select id="tipo_pagamento" name="tipo-pagamento" class="form-select" title="Tipo de Pagamento" required>
                                        <option value="">Dinheiro</option>
                                        <option value="">Cartão de Crédito</option>
                                        <option value="">Cartão de Débito</option>
                                        <option value="">Vale Alimentação / Vale Cesta</option>
                                        <option value="">Pix</option>
                                    </select>
                                </div>
                                <div class="row">

                                    <div class="form-floating col-md-6 mt-3">
                                        <input type="text" class="form-control" id="desconto" placeholder="Desconto">
                                        <label for="desconto" class="required-field-label">Desconto</label>
                                    </div>

                                    <div class="form-floating col-md-6 mt-3">
                                        <input type="text" class="form-control" id="valor_com_desconto" placeholder="Valor com Desconto">
                                        <label for="valor_com_desconto" class="required-field-label">Valor com desconto</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-floating mt-3">
                                        <input type="text" class="form-control" id="cd_transacao_pix" placeholder="Código de transação ou Chave Pix">
                                        <label for="cd_transacao_pix" class="required-field-label">Código de Tranação ou Chave Pix</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-floating mt-3">
                                        <input type="text" class="form-control" id="valor_pago" placeholder="Valor Pago" disabled>
                                        <label for="valor_pago" class="required-field-label">Valor Pago</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-lg">Fechar Venda</button>
                                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Voltar para venda</button>
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
<script src="../js/vendas.js"></script>

</html>