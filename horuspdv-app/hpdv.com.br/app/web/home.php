<?php require "../layouts/session.php" ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/home.css">

</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card">
                            <!-- restrições de cadastro -->
                            <?php
                            if ($user_logged->tipo_permissao == "cadastro" || $user_logged->tipo_permissao == "administrador") { ?>
                                <div class="row">
                                    <div class="col-md-4 card-box">
                                        <a href="cadastro-cliente">
                                            <i class="fa-solid fa-user-plus"></i>
                                            Cadastro de Cliente</a>
                                    </div>
                                    <div class="col-md-4 card-box">
                                        <a href="cadastro-produto">
                                            <i class="fa-solid fa-tags"></i>
                                            Cadastro de Produto</a>
                                    </div>
                                    <div class="col-md-4 card-box">
                                        <a href="cadastro-fornecedor">
                                            <i class="fa-solid fa-truck-fast"></i>
                                            Cadastro de Fornecedor</a>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- restrições venda -->
                            <?php
                            if ($user_logged->tipo_permissao == "venda" || $user_logged->tipo_permissao == "administrador") { ?>
                                <div class="row">
                                    <div class="col-md-4 card-box">
                                        <a href="historico-de-vendas">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            Histórico de Vendas</a>
                                    </div>
                                <?php } ?>

                                <div class="col-md-4 card-box">
                                    <a href="relatorio">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        Relatórios</a>
                                </div>

                                <!-- restrições venda -->
                                <?php
                                if ($user_logged->tipo_permissao == "venda" || $user_logged->tipo_permissao == "administrador") { ?>
                                    <div class="col-md-4 card-box">
                                        <a href="vendas" target="_blank">
                                            <i class=" fa-solid fa-cart-arrow-down"></i>
                                            Iniciar Vendas</a>
                                    </div>
                                <?php } ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>