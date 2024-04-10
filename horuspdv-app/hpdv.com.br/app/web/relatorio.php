<?php require "../layouts/session.php";
require_once '../controllers/db_connection.php';
$connect = new DbConnection();
$connect = $connect->getConnection();

$query_clients = "SELECT DISTINCT YEAR(data_criacao) AS ano FROM tb_clientes ORDER BY ano DESC";
$query_products = "SELECT DISTINCT YEAR(data_criacao) AS ano FROM tb_produtos ORDER BY ano DESC";
$query_providers = "SELECT DISTINCT YEAR(data_criacao) AS ano FROM tb_fornecedores ORDER BY ano DESC";
$query_sales = "SELECT DISTINCT YEAR(data_criacao) AS ano FROM tb_vendas ORDER BY ano DESC";
$query_payment_option = "SELECT tipo_de_pagamento FROM tb_vendas GROUP BY tipo_de_pagamento ORDER BY tipo_de_pagamento ASC";

$stmt_clients = $connect->prepare($query_clients);
$stmt_products = $connect->prepare($query_products);
$stmt_providers = $connect->prepare($query_providers);
$stmt_sales = $connect->prepare($query_sales);
$stmt_payment_option = $connect->prepare($query_payment_option);

$stmt_clients->execute();
$stmt_products->execute();
$stmt_providers->execute();
$stmt_sales->execute();
$stmt_payment_option->execute();

$result_clients = $stmt_clients->fetchAll(PDO::FETCH_OBJ);
$result_products = $stmt_products->fetchAll(PDO::FETCH_OBJ);
$result_providers = $stmt_providers->fetchAll(PDO::FETCH_OBJ);
$result_sales = $stmt_sales->fetchAll(PDO::FETCH_OBJ);
$result_payment_option = $stmt_payment_option->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/tabs.css">

</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card card-report">
                            <ul id='tab_report' class="nav nav-tabs nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="active" data-bs-toggle="pill" data-bs-target="#tab_client_report"> <i class="fa-solid fa-user-plus"></i>
                                        Relatório de Cliente
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="pill" data-bs-target="#tab_product_report"> <i class="fa-solid fa-tags"></i>
                                        Relatório de Produto</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_provider_report"> <i class="fa-solid fa-truck-fast"></i>
                                        Relatório de Fornecedor</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_sales_history"> <i class=" fa-solid fa-clock-rotate-left"></i>
                                        Histórico de Vendas</a>
                                </li>
                            </ul>
                            <div id="tab_content_report" class="tab-content">
                                <div id="tab_client_report" class="tab-pane fade active show" role="tabpanel">
                                    <div>
                                        <form action="#" method="post" id="formReportClient">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="report_client">
                                            <div class="form-group mt-3 mb-3">
                                                <label for="">Tipo de Relatório</label>
                                                <select name="report-type-client" id="report_type_client" class="form-select">
                                                    <option value="" selected>Selecionar</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="excel">Excel</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3 mb-3">
                                                <label for="">Período</label>
                                                <select name="reporting_period" id="reporting_period" class="form-select">
                                                    <option value="" selected>Selecionar</option>
                                                    <?php foreach ($result_clients as $client) : ?>
                                                        <option value="<?= $client->ano ?>"><?= $client->ano ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary btn-lg">Gerar Relatório</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab_product_report" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <div>
                                            <form action="#" method="post" id="formReportProduct">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action_product" value="report_product">
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Tipo de Relatório</label>
                                                    <select name="report_type_product" id="report_type_product" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">Excel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Período</label>
                                                    <select name="reporting_period_product" id="reporting_period_product" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <?php foreach ($result_products as $product) : ?>
                                                            <option value="<?= $product->ano ?>"><?= $product->ano ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab_provider_report" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <div>
                                            <form action="#" method="post" id="formReportProvider">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action_provider" value="report_provider">
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Tipo de Relatório</label>
                                                    <select name="report_type_provider" id="report_type_provider" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">Excel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Período</label>
                                                    <select name="reporting_period_provider" id="reporting_period_provider" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <?php foreach ($result_providers as $provider) : ?>
                                                            <option value="<?= $provider->ano ?>"><?= $provider->ano ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_sales_history" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <div>
                                            <form action="#" method="post" id="formReportSales">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action_sales" value="report_sales">
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Tipo de Relatório</label>
                                                    <select name="report_type_sales" id="report_type_sales" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">Excel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Opção de Pagamento</label>
                                                    <select name="payment_option" id="payment_option" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <option value="all">Todos</option>
                                                        <?php foreach ($result_payment_option as $payment) : ?>
                                                            <option value="<?= $payment->tipo_de_pagamento ?>"><?= $payment->tipo_de_pagamento ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="">Período</label>
                                                    <select name="reporting_period_sales" id="reporting_period_sales" class="form-select">
                                                        <option value="" selected>Selecionar</option>
                                                        <?php foreach ($result_sales as $sale) : ?>
                                                            <option value="<?= $sale->ano ?>"><?= $sale->ano ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

<script src="../js/report.js"></script>

</html>