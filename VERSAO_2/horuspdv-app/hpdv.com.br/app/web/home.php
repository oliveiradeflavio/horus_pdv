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
                            <div class="row">
                                <div class="col-md-4 card-box">
                                    <a href="historico-de-vendas">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        Histórico de Vendas</a>
                                </div>
                                <div class="col-md-4 card-box">
                                    <a href="relatorio">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        Relatórios</a>
                                </div>
                                <div class="col-md-4 card-box">
                                    <a href="vendas" target="_blank">
                                        <i class=" fa-solid fa-cart-arrow-down"></i>
                                        Iniciar Vendas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>