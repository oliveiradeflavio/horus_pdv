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
                        <form action="#" method="post" id="form-login">
                            <h5>Hórus PDV</h5>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="usuario-de-acesso" name="usuario-de-acesso" placeholder="Usuário de Acesso" title="Usuário de Acesso">
                                <label for="login">Usuário de Acesso</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="senha-de-acesso" placeholder="Senha de Acesso" title="Senha de Acesso">
                                <label for="password">Senha</label>
                                <span class="fa-solid fa-eye-slash"></span>
                            </div>
                            <div class="mt-3">
                                <a href="recuperar-senha" title="Esqueceu a senha?">Esqueceu a senha?</a>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-enter" title="Entrar" id="btn-login">
                                    Entrar
                                </button>
                            </div>

                        </form>
                        <div class="text-danger error-msg" id="error-login">
                            <!-- <span class="fa-solid fa-exclamation-triangle"></span>
                            <span class="error-msg-text">Usuário ou senha inválidos</span> -->
                        </div>
                        <div id="spinner_loading" title="Carregando...">
                            <!-- <span class="spinner-border text-primary" role="status"></span> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/login.js"></script>

</html>