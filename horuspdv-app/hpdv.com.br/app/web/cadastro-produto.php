<?php require "../layouts/session.php" ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/register.css">

</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="container-box">
                                        <div class="col-md-6">
                                            <div class="col-md-4 card-box ">
                                                <a href="#" onclick="display('modal-cad-product')">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                    Novo Produto</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-4 card-box">
                                                <a href="#" onclick="display('modal-search-product')">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    Pesquisar Produto</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-cad-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formCadProduct">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" tabindex="-1">
                                <input type="hidden" name="action" value="add_product" tabindex="-1">
                                <div class="row">
                                    <div class="container-img col-md-12">
                                        <span id="delete-img-preview" title="Remover imagem"></span>
                                        <img id="preview-img" src="../assets/img/avatar/produto-sem-imagem.webp" width="200" height="200" alt="Avatar" class="img-fluid">
                                        <label for="img-product">Cadastre a imagem do seu produto</label>
                                        <input id="img-product" type="file" name="img-product" class="input-file">
                                        <span id="file-name"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="product-name" placeholder="Nome do Produto" required>
                                        <label for="product-name" class="required-field-label">Nome do Produto</label>
                                    </div>

                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="product-code" placeholder="Código do Produto" required>
                                        <label for="product-code" class="required-field-label">Código do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select id="product-supplier" name="product-supplier" class="form-select form-control" title="Fornecedor do Produto" required>
                                            <option selected="">Fornecedor do Produto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-12">
                                        <input type="text" class="form-control" id="product-description" placeholder="Descrição do Produto" required>
                                        <label for="product-description" class="required-field-label">Descrição do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="product-qnt" placeholder="Quantidade do Produto" required>
                                        <label for="product-qnt" class="required-field-label">Quantidade do Produto</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="product-unit-price" placeholder="Preço Unitário do Produto" required>
                                        <label for="product-unit-price" class="required-field-label">Preço Unitário do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="product-sale-price" placeholder="Preço de Venda do Produto" required>
                                        <label for="product-sale-price" class="required-field-label">Preço de Venda do Produto</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="total-price-on-product" placeholder="Preço Total em Produto" required>
                                        <label for="total-price-on-product" class="required-field-label">Preço Total em Produto</label>
                                    </div>
                                </div>


                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" id="btnSend">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-search-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formSearchProduct">
                                <input type="hidden" name="csrf_token_search" value="<?= $_SESSION['csrf_token'] ?>" tabindex="-1">
                                <input type="hidden" name="action_search" value="search_product" tabindex="-1">
                                <div id="container-search">
                                    <label for="search-product" class="label-search">
                                        <input type="search" name="search-product" id="search-product" class="form-control" placeholder="Pesquise pelo nome ou código do produto" required>
                                        <div class="icon-search">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <button type="reset" class="btn-close" id="btn-close-search-product"></button>
                                    </label>
                                </div>
                            </form>
                            <div class="table-responsive d-none">
                                <table class="table table-hover mt-4" id="result-search">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<script src="../js/_component/validation.js"></script>
<script src="../js/_component/mask.js"></script>
<script src="../js/register.js"></script>

</html>