<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/settings.css">

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
                            <form action="#" method="post">
                                <input type="hidden" name="csrf_token">

                                <div class="form-floating">
                                    <input type="text" id="cpf" name="cpf" class="form-control" title="CPF" placeholder="CPF" onblur="validaCPF(this.value)" maxlength="14">
                                    <label for="cpf" class="required-field-label" title="CPF">CPF</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nome-cliente" placeholder="Nome Completo">
                                    <label for="nome-cliente" class="required-field-label">Nome Completo</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" id="email" name="email" title="E-mail" class="form-control" placeholder="E-mail" onblur="validaEmail(this.value)">
                                    <label for="email" class="required-field-label">E-mail</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" id="usuario-acesso" name="usuario-acesso" class="form-control" title="Usuário de Acesso" placeholder="Usuário de Acesso" disabled>
                                    <label for="usuario-acesso" class="required-field-label" title="usuario-acesso">Usuário de Acesso</label>
                                </div>

                                <div class="slider-text">
                                    <span>Ative para trocar de senha</span>
                                </div>

                                <div>
                                    <label class="switch">
                                        <input type="checkbox" id="checkboxEditarPerfilUsuario" onclick="" name="check_box_senha">
                                        <span class="slider"></span>
                                    </label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="senha-antiga" placeholder="Senha Antiga">
                                    <label for="senha-antiga-acesso" class="required-field-label">Senha Antiga</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nova-senha-acesso" placeholder="Nova Senha">
                                    <label for="nova-senha-acesso" class="required-field-label">Nova Senha</label>
                                </div>

                                <div>
                                    <button type="#" class="btn btn-primary btn-lg">Salvar</button>
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

</html>