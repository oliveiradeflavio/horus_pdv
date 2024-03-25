<?php
class LicenseService
{
    private $connect;
    private $license;

    public function __construct(DbConnection $connect, LicenseModel $license)
    {
        $this->connect = $connect->getConnection();
        $this->license = $license;
    }

    public function verifyLicenseExists($id_user)
    {
        $query = "SELECT * FROM tb_licenca WHERE id_usuario = :id_usuario";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id_usuario', $id_user);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function generateLicense($id_user)
    {
        $query = "INSERT INTO tb_licenca (id_usuario, data_ativacao_sistema, data_ultima_renovacao, data_proxima_renovacao) VALUES (:id_usuario, :data_ativacao_sistema, :data_ultima_renovacao, :data_proxima_renovacao)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id_usuario', $id_user);
        $stmt->bindValue(':data_ativacao_sistema', $this->license->__get('data_ativacao_sistema'));
        $stmt->bindValue(':data_ultima_renovacao', $this->license->__get('data_ultima_renovacao'));
        $stmt->bindValue(':data_proxima_renovacao', $this->license->__get('data_proxima_renovacao'));
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastRenewal()
    {
        $query = "SELECT data_proxima_renovacao FROM tb_licenca WHERE id_usuario = :id_usuario";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id_usuario', $this->license->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
