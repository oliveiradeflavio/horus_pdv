<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/cadastro-cliente.css">

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
                                <div class="center">
                                    <div class="col-md-6">
                                        <div class="col-md-4 card-box ">
                                            <a href="#" onclick="exibir('modal-cad-cliente')">
                                                <i class="fa-solid fa-user-plus"></i>
                                                Novo Cliente</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-4 card-box">
                                            <a href="#" onclick="exibir('modal-pesquisa-cliente')">
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
    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-cad-cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-title">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <form action="#" method="post">
                            <input type="hidden" name="csrf_token">
                            <div class="row">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nome-cliente" placeholder="Nome">
                                    <label for="nome-cliente" class="required-field-label">Nome</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="cpf" name="cpf" class="form-control" title="CPF" placeholder="CPF" onblur="validaCPF(this.value)" maxlength="14">
                                    <label for="cpf" class="required-field-label" title="CPF">CPF</label>
                                </div>
                                <div class="form-floating col-md-3">
                                    <input type="text" id="rg" name="rg" title="RG" class="form-control" placeholder="RG" maxlength="12">
                                    <label for="rg" title="RG">RG</label>
                                </div>
                                <div class="form-floating col-md-3">
                                    <input type="text" id="data-nascimento" name="data-nascimento" class="form-control" placeholder="Data de Nascimento" title="Data de Nascimento" onblur="validaDataNascimento(this.id)" required="" maxlength="10">
                                    <label for="nascimento" class="required-field-label" title="Data de Nascimento">DN</label>
                                </div>
                                <div class="form-floating col-md-2">
                                    <input type="text" id="idade" name="idade" title="Idade" class="form-control texto-input-num" placeholder="Idade">
                                    <label for="idade" title="Idade">Idade</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="cep" name="cep" class="form-control" title="CEP" onchange="pesquisaCEP(this.value)" placeholder="CEP" maxlength="9">
                                    <label for="cep" class="required-field-label" title="CEP">CEP</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="cidade" name="cidade" title="Cidade" class="form-control texto-input" placeholder="Cidade">
                                    <label for="cidade" class="required-field-label" title="Cidade">Cidade</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="uf" class="required-field-label" title="UF">UF</label>
                                    <select id="uf" name="uf" class="form-select form-control" title="UF">
                                        <option selected="">Selecionar</option>
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
                                    <input type="text" id="endereco" name="endereco" class="form-control" title="Endereço" placeholder="endereco">
                                    <label for="endereco" class="required-field-label" title="Endereço">Endereço</label>
                                </div>
                                <div class="form-floating col-md-6">
                                    <input type="text" id="bairro" name="bairro" class="form-control" title="Bairro" placeholder="Bairro">
                                    <label for="bairro" class="required-field-label" title="Bairro">Bairro</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating col-md-4">
                                    <input type="text" id="complemento" name="complemento" title="Complemento" class="form-control" placeholder="Complemento">
                                    <label for="complemento" title="Complemento">Complemento</label>
                                </div>

                                <div class="form-floating col-md-4">
                                    <input type="text" id="numero" name="numero" title="Número" class="form-control texto-input-num" placeholder="Número">
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

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade bd-example-modal-lg show" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-pesquisa-cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-title">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <form action="#" method="post">
                            <input type="hidden" name="csrf_token">
                            <input type="hidden" name="action">
                            <div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>

    </section>

    <script src="../js/cadastro-cliente.js"></script>

</html>