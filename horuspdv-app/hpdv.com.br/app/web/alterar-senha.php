<?php
if (!isset($_GET['u']) || !isset($_GET['t'])) {
    header('Location: login');
    exit();
} else {
    $u = base64_decode($_GET['u']);
    $t = base64_decode($_GET['t']);
}

?>
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
                                Alterar Senha
                            </h5>
                            <p>
                                Insira a nova senha e confirme para alterar a senha de acesso.

                            </p>
                            <div>
                                <div class="form-floating">
                                    <input type="password" id="newPassword" name="new-password" class="form-control" placeholder="Nova senha" required>
                                    <label for="newPassword" class="campo-obrigatorio">Nova Senha de Acesso</label>
                                    <span class="fa-solid fa-eye-slash"></span>
                                </div>

                                <div class="form-floating">
                                    <input type="password" id="repeatPassword" name="repeatPassword" class="form-control" placeholder="Confirmar Senha de Acesso" required>
                                    <label for="repeatPassword" class="campo-obrigatorio">Confirmar Senha de Acesso</label>
                                    <span class="fa-solid fa-eye-slash fa-eye-slash-repeat"></span>
                                </div>
                                <div>
                                    <button class="btn btn-enter" title="Alterar" id="btnChangePassword" onclick="changePassword('<?= $u ?>', '<?= $t ?>')">
                                        Alterar
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
<script src="../js/change-password.js"></script>

</html>