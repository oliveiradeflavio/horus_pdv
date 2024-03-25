<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = uniqid();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <div class="card">
                        <form action="#" method="post" id="formLogin">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
                            <h5>Hórus PDV</h5>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="accessUser" name="access-user" placeholder="Usuário de Acesso" title="Usuário de Acesso">
                                <label for="login">Usuário de Acesso</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="accessPassword" name="access-password" placeholder="Senha de Acesso" title="Senha de Acesso">
                                <label for="password">Senha</label>
                                <span class="fa-solid fa-eye-slash"></span>
                            </div>
                            <div class="mt-3">
                                <a href="recuperar-senha" title="Esqueceu a senha?">Esqueceu a senha?</a>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-enter" title="Entrar" id="btnLogin">
                                    Entrar
                                </button>
                            </div>

                        </form>
                        <div>
                            <?php if (isset($_GET['return']) && isset($_GET['return']) == 'not_authenticated') { ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <span class="fa-solid fa-exclamation-triangle"></span>
                                    <span class="error-msg-text">Você não está autenticado. Faça o login para acessar o sistema.</span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="loader-container"></div>
    </section>

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script scr="../js/_component/loading.js"></script>
<script src="../js/login.js"></script>

</html>