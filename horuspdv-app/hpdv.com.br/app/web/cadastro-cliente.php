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
                                                <a href="#" onclick="display('modal-cad-client')">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                    Novo Cliente</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-4 card-box">
                                                <a href="#" onclick="display('modal-search-client')">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    Pesquisar Cliente</a>
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
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-cad-client" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formAddNewClient">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" tabindex="-1">
                                <input type="hidden" name="action" value="add_client" tabindex="-1">
                                <div class="row">
                                    <div class="form-floating">
                                        <input type="text" class="form-control text_only" id="customer-name" placeholder="Nome" minlength="3" required>
                                        <label for="customer-name" class="required-field-label">Nome</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-4">
                                        <input type="text" id="cpf" name="cpf" class="form-control" title="CPF" placeholder="CPF" minlength="14" maxlength="14" required>
                                        <label for="cpf" class="required-field-label" title="CPF">CPF</label>
                                    </div>
                                    <div class="form-floating col-md-3">
                                        <input type="text" id="rg" name="rg" title="RG" class="form-control" placeholder="RG" maxlength="12">
                                        <label for="rg" title="RG">RG</label>
                                    </div>
                                    <div class="form-floating col-md-3">
                                        <input type="text" id="birth-date" name="birth-date" class="form-control" placeholder="Data de Nascimento" title="Data de Nascimento" onblur="birthDateValidation(this.id)" maxlength="10">
                                        <label for="birth-date" class="required-field-label" title="Data de Nascimento">DN</label>
                                    </div>
                                    <div class="form-floating col-md-2">
                                        <input type="text" id="age" name="age" title="Idade" class="form-control texto-input-num" placeholder="Idade" tabindex="-1" disabled>
                                        <label for="age" title="Idade">Idade</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-4">
                                        <input type="text" id="cep" name="cep" class="form-control" title="CEP" onchange="getAddressByCep(this.value)" placeholder="CEP" maxlength="9" required>
                                        <label for="cep" class="required-field-label" title="CEP">CEP</label>
                                    </div>

                                    <div class="form-floating col-md-4">
                                        <input type="text" id="city" name="city" title="Cidade" class="form-control texto-input" placeholder="Cidade" required>
                                        <label for="city" class="required-field-label" title="Cidade">Cidade</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="state" name="state" class="form-select form-control" title="UF" required>
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
                                        <input type="text" id="address" name="address" class="form-control" title="Endereço" placeholder="endereco" required>
                                        <label for="address" class="required-field-label" title="Endereço">Endereço</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" id="neighborhood" name="neighborhood" class="form-control" title="Bairro" placeholder="Bairro" required>
                                        <label for="neighborhood" class="required-field-label" title="Bairro">Bairro</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-4">
                                        <input type="text" id="street-complement" name="street-complement" title="Complemento" class="form-control" placeholder="Complemento">
                                        <label for="street-complement" title="Complemento">Complemento</label>
                                    </div>

                                    <div class="form-floating col-md-4">
                                        <input type="text" id="number" name="number" title="Número" class="form-control texto-input-num" placeholder="Número" required>
                                        <label for="number" class="required-field-label" title="Número">Número</label>
                                    </div>

                                    <div class="form-floating col-md-4">
                                        <input type="text" id="reference-point" name="reference-point" title="Ponto de Referência" class="form-control" placeholder="Ponto de Referência">
                                        <label for="reference-point" title="Ponto de Referência">Ponto de Referência</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating col-md-4">
                                        <input type="text" id="telephone" name="telephone" title="Telefone" class="form-control" placeholder="Telefone" minlength="14" maxlength="14">
                                        <label for="telephone" title="Telefone">Telefone</label>
                                    </div>

                                    <div class="form-floating col-md-4">
                                        <input type="text" id="cellphone" name="cellphone" class="form-control" title="Celular" placeholder="Celular" minlength="15" maxlength="15" required>
                                        <label for="cellphone" class="required-field-label" title="Celular">Celular</label>
                                    </div>

                                    <div class="form-floating col-md-4">
                                        <input type="text" id="email" name="email" title="E-mail" class="form-control" placeholder="E-mail">
                                        <label for="email" title="E-mail">E-mail</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-search-client" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-title">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row">
                            <form action="#" method="post" id="formSearchClient">
                                <input type="hidden" name="csrf_token">
                                <input type="hidden" name="action">
                                <div id="container-search">
                                    <label for="pesquisar-cliente" class="label-search">
                                        <input type="search" name="pesquisar-cliente" id="pesquisar-cliente" class="form-control" placeholder="Pesquise por cpf" required>
                                        <div class="icon-search">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <button type="reset" class="btn-close" id="btn-close-search-client"></button>
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

<script src="../js/_component/validation.js"></script>
<script src="../js/_component/mask.js"></script>
<script src="../js/register.js"></script>

</html>