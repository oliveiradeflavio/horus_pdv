<?php

class RegisterClientService
{
    private $connect;
    private $client;

    public function __construct(DbConnection $connect, RegisterClientModel $client)
    {
        $this->connect = $connect->getConnection();
        $this->client = $client;
    }

    public function checkCpfExists()
    {
        $query = "SELECT cpf FROM tb_clientes WHERE cpf = :cpf";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':cpf', $this->client->__get('cpf'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addClient()
    {
        $query = "INSERT INTO tb_clientes (nome, cpf, rg, data_nascimento, idade, cep, cidade, uf, endereco, bairro, complemento, numero, ponto_referencia, telefone, celular, email) VALUES (:nome, :cpf, :rg, :data_nascimento, :idade, :cep, :cidade, :uf, :endereco, :bairro, :complemento, :numero, :ponto_referencia, :telefone, :celular, :email)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':nome', $this->client->__get('nome'));
        $stmt->bindValue(':cpf', $this->client->__get('cpf'));
        $stmt->bindValue(':rg', $this->client->__get('rg'));
        $stmt->bindValue(':data_nascimento', $this->client->__get('data_nascimento'));
        $stmt->bindValue(':idade', $this->client->__get('idade'));
        $stmt->bindValue(':cep', $this->client->__get('cep'));
        $stmt->bindValue(':cidade', $this->client->__get('cidade'));
        $stmt->bindValue(':uf', $this->client->__get('uf'));
        $stmt->bindValue(':endereco', $this->client->__get('endereco'));
        $stmt->bindValue(':bairro', $this->client->__get('bairro'));
        $stmt->bindValue(':complemento', $this->client->__get('complemento'));
        $stmt->bindValue(':numero', $this->client->__get('numero'));
        $stmt->bindValue(':ponto_referencia', $this->client->__get('ponto_referencia'));
        $stmt->bindValue(':telefone', $this->client->__get('telefone'));
        $stmt->bindValue(':celular', $this->client->__get('celular'));
        $stmt->bindValue(':email', $this->client->__get('email'));
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function searchClient()
    {
        $query = "SELECT * FROM tb_clientes WHERE nome LIKE :valueSearch OR cpf LIKE :valueSearch ORDER BY nome ASC";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':valueSearch', '%' . $this->client->__get('valueSearch') . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteClient()
    {
        $query = "DELETE FROM tb_clientes WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':id', $this->client->__get('id'));
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function checkCpfExistsUpdate()
    {
        $query = "SELECT cpf FROM tb_clientes WHERE cpf = :cpf AND id != :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':cpf', $this->client->__get('cpf'));
        $stmt->bindValue(':id', $this->client->__get('id'));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateClient()
    {
        $query = "UPDATE tb_clientes SET nome = :nome, cpf = :cpf, rg = :rg, data_nascimento = :data_nascimento, idade = :idade, cep = :cep, cidade = :cidade, uf = :uf, endereco = :endereco, bairro = :bairro, complemento = :complemento, numero = :numero, ponto_referencia = :ponto_referencia, telefone = :telefone, celular = :celular, email = :email WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':nome', $this->client->__get('nome'));
        $stmt->bindValue(':cpf', $this->client->__get('cpf'));
        $stmt->bindValue(':rg', $this->client->__get('rg'));
        $stmt->bindValue(':data_nascimento', $this->client->__get('data_nascimento'));
        $stmt->bindValue(':idade', $this->client->__get('idade'));
        $stmt->bindValue(':cep', $this->client->__get('cep'));
        $stmt->bindValue(':cidade', $this->client->__get('cidade'));
        $stmt->bindValue(':uf', $this->client->__get('uf'));
        $stmt->bindValue(':endereco', $this->client->__get('endereco'));
        $stmt->bindValue(':bairro', $this->client->__get('bairro'));
        $stmt->bindValue(':complemento', $this->client->__get('complemento'));
        $stmt->bindValue(':numero', $this->client->__get('numero'));
        $stmt->bindValue(':ponto_referencia', $this->client->__get('ponto_referencia'));
        $stmt->bindValue(':telefone', $this->client->__get('telefone'));
        $stmt->bindValue(':celular', $this->client->__get('celular'));
        $stmt->bindValue(':email', $this->client->__get('email'));
        $stmt->bindValue(':id', $this->client->__get('id'));
        $stmt->execute();
        return $stmt->rowCount();
    }
}
