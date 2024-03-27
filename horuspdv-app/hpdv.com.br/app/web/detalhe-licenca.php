<?php require "../layouts/session.php";

require_once '../controllers/db_connection.php';
$connect = new DbConnection();
$connect = $connect->getConnection();
$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM tb_licenca WHERE id_usuario = :id_usuario";
$stmt = $connect->prepare($query);
$stmt->bindValue(':id_usuario', $id_user);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
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
                            <div class="mt-2">
                                <h5>Usuário de acesso: <?= $user_logged->usuario_acesso ?></h5>
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
                                        <?php
                                        foreach ($result as $license) : ?>

                                            <tr>
                                                <td><?= date('d/m/Y H:m:s', strtotime($license->data_ativacao_sistema)) ?></td>
                                                <td><?= date('d/m/Y H:m:s', strtotime($license->data_ultima_renovacao)) ?></td>
                                                <td><?= date('d/m/Y H:m:s', strtotime($license->data_proxima_renovacao)) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
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