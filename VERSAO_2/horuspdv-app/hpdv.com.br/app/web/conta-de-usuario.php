<?php require "../layouts/session.php" ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/tabs.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/pt-BR.js"></script>

</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card">
                            <ul id='tab_conta_de_usuario' class="nav nav-tabs nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="active" data-bs-toggle="pill" data-bs-target="#tab_user_account_new_user"> <i class="fa-solid fa-user-plus"></i>
                                        Novo Usuário
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="pill" data-bs-target="#tab_user_account_delete_user"> <i class="fa-solid fa-user-minus"></i>
                                        Excluir Usuário</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_user_account_user_permission"> <i class="fa-solid fa-address-card"></i>
                                        Permissões</a>
                                </li>
                                <li class="nav-item">

                                    <a data-bs-toggle="pill" data-bs-target="#tab_user_account_registered_users"><i class="fa-solid fa-users"></i>
                                        Usuários Cadastrados
                                    </a>
                                </li>
                            </ul>
                            <div id="tab_user_account_content" class="tab-content">
                                <div id="tab_user_account_new_user" class="tab-pane fade active show" role="tabpanel">
                                    <div>
                                        <form action="#" method="post" id="formNewUser">
                                            <input type="hidden" name="csrf_token">

                                            <div class="form-floating">
                                                <input type="text" id="cpf" name="cpf" class="form-control" title="CPF" placeholder="CPF" maxlength="14">
                                                <label for="cpf" class="required-field-label" title="CPF">CPF</label>
                                            </div>

                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="customer-client" placeholder="Nome Completo" minlength="3">
                                                <label for="customer-client" class="required-field-label">Nome Completo</label>
                                            </div>
                                            <div class="form-floating">
                                                <input type="text" id="email" name="email" title="E-mail" class="form-control" placeholder="E-mail">
                                                <label for="email" class="required-field-label">E-mail</label>
                                            </div>

                                            <div class="form-floating">
                                                <input type="text" id="user-access" name="user-access" class="form-control" title="Usuário de Acesso" placeholder="Usuário de Acesso" minlength="3">
                                                <label for="user-access" class="required-field-label">Usuário de Acesso</label>
                                            </div>

                                            <div>
                                                <button class="btn btn-primary btn-lg">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab_user_account_delete_user" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post" id="formDeleteUser">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="csrf_token">
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Usuários cadastrados</label>
                                                        <select name="select_delete_user" id="select_delete_user" class="form-select">
                                                            <option value="" selected>Selecionar</option>
                                                            <option value="usuario1">Usuário 1</option>
                                                            <option value="usuario2">Usuário 2</option>
                                                        </select>
                                                    </div>

                                                    <div>
                                                        <button class="btn btn-primary btn-lg">Excluir</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div id="tab_user_account_user_permission" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post" id="formUserPermission">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="csrf_token">
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Usuários cadastrados</label>
                                                        <select name="select_user_permission" id="select_user_permission" class="form-select">
                                                            <option value="" selected>Selecionar</option>
                                                            <option value="usuario1">Usuário 1</option>
                                                            <option value="usuario2">Usuário 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 mb-3">
                                                        <label for="">Tipo de Permissão</label>
                                                        <select name="select_permission_type" id="select_permission_type" class="form-select">
                                                            <option value="" selected>Selecionar</option>

                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-primary btn-lg">Alterar Permissão</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="tab_user_account_registered_users" class="tab-pane fade" role="tabpanel">
                                    <div>
                                        <form action="#" method="post" id="formRegisteredUsers">
                                            <input type="hidden" name="csrf_token">

                                            <div>
                                                <form action="#" method="post">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover mt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Usuário</th>
                                                                    <th scope="col">Tipo de Permissão</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Teste</td>
                                                                    <td>Comum</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>User</td>
                                                                    <td>Administrador</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </form>
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


    <script src="../js/_component/validation.js"></script>
    <script src="../js/_component/mask.js"></script>
    <script src="../js/user-account.js"></script>

</html>