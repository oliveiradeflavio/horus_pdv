<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/recover-password.css">
</head>

<body>
    <main>
        <section id="recover-password">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card card-recover-password">
                            <h5>
                                Recuperar Senha
                            </h5>
                            <p>
                                Digite seu CPF e seu usuário de acesso que o sistema irá enviar um link de recuperação de senha para o seu e-mail cadastrado.

                            </p>
                            <div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" title="CPF">
                                    <label for="cpf">CPF</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="accessUser" name="access-user" placeholder="Usuário de Acesso" title="Usuário de Acesso">
                                    <label for="usuario-de-acesso">Usuário de Acesso</label>
                                </div>
                                <div>
                                    <button class="btn btn-enter" title="Recuperar" id="btnRecoverPassword">
                                        Recuperar
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </section>

        <div class="loader-container"></div>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script scr="../js/_component/loading.js"></script>
<script src="../js/_component/validation.js"></script>
<script src="../js/_component/mask.js"></script>
<script src="../js/recover-password.js"></script>

</html>