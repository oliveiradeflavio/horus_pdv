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
                        <div class="card">
                            <ul id='tab_relatorio' class="nav nav-tabs nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="active" data-bs-toggle="pill" data-bs-target="#tab_relatorio_cliente"> <i class="fa-solid fa-user-plus"></i>
                                        Relatório de Cliente
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="pill" data-bs-target="#tab_relatorio_produto"> <i class="fa-solid fa-tags"></i>
                                        Relatório de Produto</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_relatorio_fornecedor"> <i class="fa-solid fa-truck-fast"></i>
                                        Relatório de Fornecedor</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_historico_vendas"> <i class=" fa-solid fa-clock-rotate-left"></i>
                                        Histórico de Vendas</a>
                                </li>
                            </ul>
                            <div id="tab_relatorio_content" class="tab-content">
                                <div id="tab_relatorio_cliente" class="tab-pane fade active show" role="tabpanel">
                                    <div>
                                        <form action="#" method="post">
                                            <input type="hidden" name="csrf_token">
                                            <div class="form-group mt-3 mb-3">
                                                <label for="">Tipo de Relatório</label>
                                                <select name="tipo_relatorio" id="tipo_relatorio" class="form-select">
                                                    <option value="" selected>Selecionar</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="excel">Excel</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3 mb-3">
                                                <label for="">Período</label>
                                                <select name="periodo_relatorio" id="periodo_relatorio" class="form-select">
                                                    <option value="" selected>Selecionar</option>

                                                </select>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-lg">Gerar Relatório</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab_relatorio_produto" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="csrf_token">
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Tipo de Relatório</label>
                                                        <select name="tipo_relatorio" id="tipo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>
                                                            <option value="pdf">PDF</option>
                                                            <option value="excel">Excel</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Período</label>
                                                        <select name="periodo_relatorio" id="periodo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>

                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div id="tab_relatorio_fornecedor" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="csrf_token">
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Tipo de Relatório</label>
                                                        <select name="tipo_relatorio" id="tipo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>
                                                            <option value="pdf">PDF</option>
                                                            <option value="excel">Excel</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Período</label>
                                                        <select name="periodo_relatorio" id="periodo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>

                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="tab_historico_vendas" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="csrf_token">
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Tipo de Relatório</label>
                                                        <select name="tipo_relatorio" id="tipo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>
                                                            <option value="pdf">PDF</option>
                                                            <option value="excel">Excel</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Opção de Pagamento</label>
                                                        <select name="opcao_pagamento" id="opcao_pagamento" class="form-select">
                                                            <option value="" selected>Selecionar</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Período</label>
                                                        <select name="periodo_relatorio" id="periodo_relatorio" class="form-select">
                                                            <option value="" selected>Selecionar</option>

                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary btn-lg">Gerar Relatório</button>
                                                    </div>
                                                </form>
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