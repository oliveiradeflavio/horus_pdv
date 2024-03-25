<?php
class LoginService
{
    private $connect;
    private $user;

    public function __construct(DbConnection $connect, LoginModel $user)
    {
        $this->connect = $connect->getConnection();
        $this->user = $user;
    }

    public function verifyUserExists()
    {
        $query = "SELECT * FROM tb_usuarios WHERE usuario_acesso = :usuario_acesso";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':usuario_acesso', $this->user->__get('usuario_acesso'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function verifyPassword()
    {
        $query = "SELECT senha_usuario FROM tb_usuarios WHERE usuario_acesso = :usuario_acesso";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':usuario_acesso', $this->user->__get('usuario_acesso'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateLastAccess()
    {
        $query = "UPDATE tb_usuarios SET data_ultimo_acesso = :data_ultimo_acesso WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':data_ultimo_acesso', $this->user->__get('data_ultimo_acesso'));
        $stmt->bindValue(':id', $this->user->__get('id'));
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function recoverPassword()
    {
        $query = "SELECT * FROM tb_usuarios WHERE cpf = :cpf AND usuario_acesso = :usuario_acesso";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':cpf', $this->user->__get('cpf'));
        $stmt->bindValue(':usuario_acesso', $this->user->__get('usuario_acesso'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function saveTokenResetPassword()
    {
        $query = "UPDATE tb_usuarios SET token_reset_senha_acesso = :token_reset_senha_acesso, horario_geracao_token = :horario_geracao_token WHERE cpf = :cpf AND usuario_acesso = :usuario_acesso";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':token_reset_senha_acesso', $this->user->__get('token_reset_senha_acesso'));
        $stmt->bindValue(':horario_geracao_token', $this->user->__get('horario_geracao_token'));
        $stmt->bindValue(':cpf', $this->user->__get('cpf'));
        $stmt->bindValue(':usuario_acesso', $this->user->__get('usuario_acesso'));
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
