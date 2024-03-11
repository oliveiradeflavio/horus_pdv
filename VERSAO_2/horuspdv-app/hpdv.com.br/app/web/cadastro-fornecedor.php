<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/register.css">

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
                        <div class="card-body">
                            <div class="row">
                                <div class="container-box">
                                    <div class="col-md-6">
                                        <div class="col-md-4 card-box ">
                                            <a href="#" onclick="exibir('modal-cad-fornecedor')">
                                                <i class="fa-solid fa-user-plus"></i>
                                                Novo Fornecedor</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-4 card-box">
                                            <a href="#" onclick="exibir('modal-pesquisa-fornecedor')">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                Pesquisar Fornecedor</a>
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
    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-cad-fornecedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-title">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <form action="#" method="post" id="formCadProvider">
                            <input type="hidden" name="csrf_token">
                            <div class="row">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="razao-social" placeholder="Razão Social" required>
                                    <label for="razao-social" class="required-field-label">Razão Social</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <input type="text" id="nome-fantasia" name="nome-fantasia" title="Nome Fantasia" class="form-control" placeholder="nome-fantasia">
                                    <label for="nome-fantasia" title="Nome Fantasia">Nome Fantasia</label>
                                </div>

                                <div class="form-floating col-md-6">
                                    <input type="text" id="cnpj" name="cnpj" class="form-control" title="CNPJ" placeholder="cnpj" onblur="" maxlength="14" required>
                                    <label for="cnpj" class="required-field-label" title="CPF">CNPJ</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="cep" name="cep" class="form-control" title="CEP" onchange="pesquisaCEP(this.value)" placeholder="CEP" maxlength="9" required>
                                    <label for="cep" class="required-field-label" title="CEP">CEP</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="cidade" name="cidade" title="Cidade" class="form-control texto-input" placeholder="Cidade" required>
                                    <label for="cidade" class="required-field-label" title="Cidade">Cidade</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <select id="uf" name="uf" class="form-select form-control" title="UF" required>
                                        <option selected="">UF</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <input type="text" id="endereco" name="endereco" class="form-control" title="Endereço" placeholder="endereco" required>
                                    <label for="endereco" class="required-field-label" title="Endereço">Endereço</label>
                                </div>
                                <div class="form-floating col-md-6">
                                    <input type="text" id="bairro" name="bairro" class="form-control" title="Bairro" placeholder="Bairro" required>
                                    <label for="bairro" class="required-field-label" title="Bairro">Bairro</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="complemento" name="complemento" title="Complemento" class="form-control" placeholder="Complemento">
                                    <label for="complemento" title="Complemento">Complemento</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="numero" name="numero" title="Número" class="form-control texto-input-num" placeholder="Número" required>
                                    <label for="numero" class="required-field-label" title="Número">Número</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="ponto-de-referencia" name="ponto-de-referencia" title="Ponto de Referência" class="form-control" placeholder="Ponto de Referência">
                                    <label for="ponto-de-referencia" title="Ponto de Referência">Ponto de Referência</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="telefone" name="telefone" title="Telefone" class="form-control" placeholder="Telefone" maxlength="14">
                                    <label for="telefone" title="Telefone">Telefone</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="celular" name="celular" class="form-control" title="Celular" placeholder="Celular" maxlength="15">
                                    <label for="celular" class="required-field-label" title="Celular">Celular</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="email" name="email" title="E-mail" class="form-control" placeholder="E-mail" onblur="validaEmail(this.value)">
                                    <label for="email" title="E-mail">E-mail</label>
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
    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-pesquisa-fornecedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                    <input type="search" name="pesquisar-fornecedor" id="pesquisar-fornecedor" class="form-control" placeholder="Pesquise pelo nome ou cnpj do fornecedor" required>
                                    <div class="icon-search">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <button type="reset" class="btn-close" id="btn-close-search-provider"></button>
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