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
                                                <a href="#" onclick="exibir('modal-cad-produto')">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                    Novo Produto</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-4 card-box">
                                                <a href="#" onclick="exibir('modal-pesquisa-produto')">
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
            </div>
        </section>
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-cad-produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formCadProduct">
                                <input type="hidden" name="csrf_token">
                                <div class="row">
                                    <div class="container-img col-md-12">
                                        <span id="excluir-img-preview" title="Remover imagem"></span>
                                        <img id="preview-img" src="../assets/img/avatar/produto-sem-imagem.webp" width="200" height="200" alt="Avatar" class="img-fluid">
                                        <label for="imagem-produto">Cadastre a imagem do seu produto</label>
                                        <input id="imagem-produto" type="file" name="imagem-produto" class="input-file">
                                        <span id="nome-arquivo"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="nome-produto" placeholder="Nome do Produto" required>
                                        <label for="nome-produto" class="required-field-label">Nome do Produto</label>
                                    </div>

                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="codigo-produto" placeholder="Código do Produto" required>
                                        <label for="codigo-produto" class="required-field-label">Código do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select id="fornecedor-produto" name="fornecedor-produto" class="form-select form-control" title="Fornecedor do Produto" required>
                                            <option selected="">Fornecedor do Produto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-12">
                                        <input type="text" class="form-control" id="descricao-produto" placeholder="Descrição do Produto" required>
                                        <label for="descricao-produto" class="required-field-label">Descrição do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="quantidade-produto" placeholder="Quantidade do Produto" required>
                                        <label for="quantidade-produto" class="required-field-label">Quantidade do Produto</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="preco-unitario-produto" placeholder="Preço Unitário do Produto" required>
                                        <label for="preco-unitario-produto" class="required-field-label">Preço Unitário do Produto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="preco-venda-produto" placeholder="Preço de Venda do Produto" required>
                                        <label for="preco-venda-produto" class="required-field-label">Preço de Venda do Produto</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="preco-total-em-produto" placeholder="Preço Total em Produto" required>
                                        <label for="preco-total-em-produto" class="required-field-label">Preço Total em Produto</label>
                                    </div>
                                </div>


                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-pesquisa-produto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formSearchProduct">
                                <input type="hidden" name="csrf_token">
                                <input type="hidden" name="action">
                                <div id="container-search">
                                    <label for="pesquisar-produto" class="label-search">
                                        <input type="search" name="pesquisar-produto" id="pesquisar-produto" class="form-control" placeholder="Pesquise pelo nome ou código do produto" required>
                                        <div class="icon-search">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <button type="reset" class="btn-close" id="btn-close-search-product"></button>
                                    </label>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover mt-4">
                                    <thead>
                                        <tr>

                                            <th scope="col">Nome</th>
                                            <th scope="col">CPF</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>
                                                <i class="fas fa-edit"></i>
                                                <i class="fas fa-trash-alt"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>
                                                <i class="fas fa-edit"></i>
                                                <i class="fas fa-trash-alt"></i>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<script src=" ../js/_component/modal.js"></script>
<script src="../js/register.js"></script>

</html>