<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/tabs.css">

</head>

<body>
    <?php require '../layouts/menu.php' ?>

</body>
<main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <div class="card">
                        <ul id='tab_relatorio' class="nav nav-tabs nav-pills nav-fill">
                            <li class="nav-item">
                                <a href="#tab_relatorio_cliente" class="active"> <i class="fa-solid fa-user-plus"></i>
                                    Relatório de Cliente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_relatorio_produto"> <i class="fa-solid fa-tags"></i>
                                    Relatório de Produto</a>
                            </li>
                            <li class="nav-item">

                                <a href="#tab_relatorio_fornecedor"> <i class="fa-solid fa-truck-fast"></i>
                                    Relatório de Fornecedor</a>
                            </li>
                            <li class="nav-item">

                                <a href="#tab_historico_vendas"> <i class="fa-solid fa-clock-rotate-left"></i>
                                    Histórico de Vendas</a>
                            </li>
                        </ul>
                        <div id="tab_relatorio_content" class="tab-content">
                            <div id="tab_relatorio_cliente" class="tab-pane fade show active" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="chb_relatorio_cliente">
                                                <span class="slider">
                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="tab_relatorio_produto" class="tab-pane fade" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="chb_relatorio_produto">
                                                <span class="slider">

                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div id="tab_relatorio_fornecedor" class="tab-pane fade" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="chb_relatorio_fornecedor">
                                                <span class="slider">

                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="tab_historico_vendas" class="tab-pane fade" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="chb_historico_vendas">
                                                <span class="slider">

                                                </span>
                                            </label>
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

<script src="../js/relatorio.js"></script>

</html>