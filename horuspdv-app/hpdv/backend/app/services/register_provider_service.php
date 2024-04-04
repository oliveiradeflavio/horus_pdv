<?php

class RegisterProviderService
{
    private $connect;
    private $provider;

    public function __construct(DbConnection $connect, RegisterProviderModel $provider)
    {
        $this->connect = $connect->getConnection();
        $this->provider = $provider;
    }

    public function checkCNPJExists()
    {
        $query = "SELECT cnpj FROM tb_fornecedores WHERE cnpj = :cnpj";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':cnpj', $this->provider->__get('cnpj'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addProvider()
    {
        $query = "INSERT INTO tb_fornecedores (razao_social, nome_fantasia, cnpj, cep, cidade, uf, endereco, bairro, complemento, numero, ponto_referencia, telefone, celular, email) VALUES (:razao_social, :nome_fantasia, :cnpj, :cep, :cidade, :uf, :endereco, :bairro, :complemento, :numero, :ponto_referencia, :telefone, :celular, :email)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':razao_social', $this->provider->__get('razao_social'));
        $stmt->bindValue(':nome_fantasia', $this->provider->__get('nome_fantasia'));
        $stmt->bindValue(':cnpj', $this->provider->__get('cnpj'));
        $stmt->bindValue(':cep', $this->provider->__get('cep'));
        $stmt->bindValue(':cidade', $this->provider->__get('cidade'));
        $stmt->bindValue(':uf', $this->provider->__get('uf'));
        $stmt->bindValue(':endereco', $this->provider->__get('endereco'));
        $stmt->bindValue(':bairro', $this->provider->__get('bairro'));
        $stmt->bindValue(':complemento', $this->provider->__get('complemento'));
        $stmt->bindValue(':numero', $this->provider->__get('numero'));
        $stmt->bindValue(':ponto_referencia', $this->provider->__get('ponto_referencia'));
        $stmt->bindValue(':telefone', $this->provider->__get('telefone'));
        $stmt->bindValue(':celular', $this->provider->__get('celular'));
        $stmt->bindValue(':email', $this->provider->__get('email'));
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function searchProvider()
    {
        $query = "SELECT * FROM tb_fornecedores WHERE razao_social LIKE :valueSearch OR nome_fantasia LIKE :valueSearch OR cnpj LIKE :valueSearch ORDER BY nome_fantasia ASC";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':valueSearch', '%' . $this->provider->__get('valueSearch') . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteProvider()
    {
        $query = "DELETE FROM tb_fornecedores WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id', $this->provider->__get('id'));
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function checkCNPJExistsUpdate()
    {
        $query = "SELECT cnpj FROM tb_fornecedores WHERE cnpj = :cnpj AND id != :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':cnpj', $this->provider->__get('cnpj'));
        $stmt->bindValue(':id', $this->provider->__get('id'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateProvider()
    {
        $query = "UPDATE tb_fornecedores SET razao_social = :razao_social, nome_fantasia = :nome_fantasia, cnpj = :cnpj, cep = :cep, cidade = :cidade, uf = :uf, endereco = :endereco, bairro = :bairro, complemento = :complemento, numero = :numero, ponto_referencia = :ponto_referencia, telefone = :telefone, celular = :celular, email = :email WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':razao_social', $this->provider->__get('razao_social'));
        $stmt->bindValue(':nome_fantasia', $this->provider->__get('nome_fantasia'));
        $stmt->bindValue(':cnpj', $this->provider->__get('cnpj'));
        $stmt->bindValue(':cep', $this->provider->__get('cep'));
        $stmt->bindValue(':cidade', $this->provider->__get('cidade'));
        $stmt->bindValue(':uf', $this->provider->__get('uf'));
        $stmt->bindValue(':endereco', $this->provider->__get('endereco'));
        $stmt->bindValue(':bairro', $this->provider->__get('bairro'));
        $stmt->bindValue(':complemento', $this->provider->__get('complemento'));
        $stmt->bindValue(':numero', $this->provider->__get('numero'));
        $stmt->bindValue(':ponto_referencia', $this->provider->__get('ponto_referencia'));
        $stmt->bindValue(':telefone', $this->provider->__get('telefone'));
        $stmt->bindValue(':celular', $this->provider->__get('celular'));
        $stmt->bindValue(':email', $this->provider->__get('email'));
        $stmt->bindValue(':id', $this->provider->__get('id'));
        $stmt->execute();
        return $stmt->rowCount();
    }
}
