<?php require "../layouts/session.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card" id="card">
                            <form action="#" method="post" id="formSalesHistory">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="action" value="search_sales">
                                <div id="container-search">
                                    <label for="search_sales" class="label-search">
                                        <input type="search" name="search-sales" id="search_sales" class="form-control" placeholder="Pesquise pelo código da venda ou CPF do cliente" required>
                                        <div class="icon-search">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <button type="reset" class="btn-close" id="btn-close-search-client"></button>
                                    </label>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover mt-4" id="result_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Número da Venda</th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Código do Produto</th>
                                            <th scope="col">Nome do Produto</th>
                                            <th scope="col">QNT</th>
                                            <th scope="col">Data da Venda</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
</body>

<script src="../js/sales-history.js"></script>

</html>