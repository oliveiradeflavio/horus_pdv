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
                                <i class="fa-solid fa-user-plus"></i>
                                <a href="#nav_relatorio_cliente" class="active">Relatório de Cliente</a>
                            </li>
                            <li class="nav-item">
                                <i class="fa-solid fa-tags"></i>
                                <a href="#nav_relatorio_produto">Relatório de Produto</a>
                            </li>
                            <li class="nav-item">
                                <i class="fa-solid fa-truck-fast"></i>
                                <a href="#nav_relatorio_fornecedor">Relatório de Fornecedor</a>
                            </li>
                            <li class="nav-item">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <a href="#nav_historico_vendas">Histórico de Vendas</a>
                            </li>
                        </ul>
                        <div id="relatorio_pills" class="tab-content">
                            <div id="nav_relatorio_cliente" class="tab-pane fade show active" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="">
                                                <span class="slider">
                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="nav_relatorio_produto" class="tab-pane fade show" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="">
                                                <span class="slider">

                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div id="nav_relatorio_fornecedor" class="tab-pane fade show" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="">
                                                <span class="slider">

                                                </span>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="nav_historico_vendas" class="tab-pane fade show" role="tabpanel">
                                <div>
                                    <form action="#" method="post">
                                        <input type="hidden" name="csrf_token">

                                        <div class="form-group">
                                            <label for="" class="switch" title="Ative para habilitar os campos">
                                                <input type="checkbox" id="">
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