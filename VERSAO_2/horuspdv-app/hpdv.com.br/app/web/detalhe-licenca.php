<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../layouts/head.php' ?>
    <link rel="stylesheet" href="../css/configuracoes.css">

</head>

<body>
    <?php require '../layouts/menu.php' ?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <div class="card">
                            <div class="mt-2">
                                <h5>Usuário de acesso: usuarioteste</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mt-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data de Ativação do Sistema</th>
                                            <th scope="col">Data da Última Renovação</th>
                                            <th scope="col">Data da Próxima Renovação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12/07/2023 18:07:44</td>
                                            <td>11/07/2023 11:07:42</td>
                                            <td>10/08/2024 11:08:42</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2">
                                <h5>Para renovar sua licença. Clique no botão gerar chave pix.</h5>

                                <div>
                                    <button type="button" class="btn btn-lg btn-primary" onclick="">Gerar chave pix</button>
                                </div>
                                <div id="modalChavePix"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>