<?php require "../layouts/session.php" ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/settings.css">

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
                                <form action="#" method="post" id="formEditProfile">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                                    <div class="form-floating">
                                        <input type="text" id="cpf" class="form-control" title="CPF" placeholder="CPF" maxlength="14" value="<?= $user_logged->cpf ?>" disabled>
                                        <label for="cpf" class="required-field-label" title="CPF">CPF</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Nome Completo" value="<?= $user_logged->nome ?>">
                                        <label for="name" class="required-field-label">Nome Completo</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" id="email" name="email" title="E-mail" class="form-control" placeholder="E-mail" onblur="validaEmail(this.value)" value="<?= $user_logged->email ?>">
                                        <label for="email" class="required-field-label">E-mail</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="text" class="form-control" title="Usuário de Acesso" placeholder="Usuário de Acesso" disabled value="<?= $user_logged->usuario_acesso ?>">
                                        <label for="access-user" class="required-field-label" title="usuario-acesso">Usuário de Acesso</label>
                                    </div>

                                    <div class="slider-text">
                                        <span>Ative para trocar de senha</span>
                                    </div>

                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" id="chboxChangePassword" onclick="cbChangePassword()" name="chChangePassword">
                                            <span class="slider"></span>
                                        </label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Senha Antiga" disabled>
                                        <label for="oldPassword" class="required-field-label">Senha Antiga</label>
                                        <span class="fa-solid fa-eye-slash"></span>
                                    </div>

                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Nova Senha" disabled>
                                        <label for="newPassword" class="required-field-label">Nova Senha</label>
                                        <span class="fa-solid fa-eye-slash fa-eye-slash-repeat"></span>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary btn-lg">Salvar</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
            </div>
        </section>
    </main>

</body>

<script src="../js/edit-profile.js"></script>

</html>