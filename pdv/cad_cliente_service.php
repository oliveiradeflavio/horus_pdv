<?php

    class CadClienteService{

        private $conexao;
        private $cliente;

        public function __construct(Conexao $conexao, CadCliente $cliente){
            $this->conexao = $conexao->conectar();
            $this->cliente = $cliente;
        }

        public function consultaCadCliente(){
            $query = 'SELECT * FROM tb_clientes WHERE cpf_cliente = :cpf';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function inserirCliente(){
            $query = 'INSERT INTO tb_clientes (cpf_cliente, dt_nascimento_cliente, nome_cliente, cep_cliente, estado_cliente, cidade_cliente, endereco_cliente, numero_cliente, complemento_cliente, bairro_cliente, celular_cliente) VALUES (:cpf, :dt_nascimento, :nome, :cep, :estado, :cidade, :endereco, :numero, :complemento, :bairro, :celular)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));
            $stmt->bindValue(':dt_nascimento', $this->cliente->__get('dt_nascimento'));
            $stmt->bindValue(':nome', $this->cliente->__get('nome'));
            $stmt->bindValue(':cep', $this->cliente->__get('cep'));
            $stmt->bindValue(':estado', $this->cliente->__get('estado'));
            $stmt->bindValue(':cidade', $this->cliente->__get('cidade'));
            $stmt->bindValue(':endereco', $this->cliente->__get('endereco'));
            $stmt->bindValue(':numero', $this->cliente->__get('numero'));
            $stmt->bindValue(':complemento', $this->cliente->__get('complemento'));
            $stmt->bindValue(':bairro', $this->cliente->__get('bairro'));
            $stmt->bindValue(':celular', $this->cliente->__get('celular'));
            $stmt->execute();

        }

        public function alterarCliente(){
            $query = 'UPDATE tb_clientes SET cpf_cliente = :cpf, dt_nascimento_cliente = :dt_nascimento, nome_cliente = :nome, cep_cliente = :cep, estado_cliente = :estado, cidade_cliente = :cidade, endereco_cliente = :endereco, numero_cliente = :numero, complemento_cliente = :complemento, bairro_cliente = :bairro, celular_cliente = :celular WHERE id_cliente = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));
            $stmt->bindValue(':dt_nascimento', $this->cliente->__get('dt_nascimento'));
            $stmt->bindValue(':nome', $this->cliente->__get('nome'));
            $stmt->bindValue(':cep', $this->cliente->__get('cep'));
            $stmt->bindValue(':estado', $this->cliente->__get('estado'));
            $stmt->bindValue(':cidade', $this->cliente->__get('cidade'));
            $stmt->bindValue(':endereco', $this->cliente->__get('endereco'));
            $stmt->bindValue(':numero', $this->cliente->__get('numero'));
            $stmt->bindValue(':complemento', $this->cliente->__get('complemento'));
            $stmt->bindValue(':bairro', $this->cliente->__get('bairro'));
            $stmt->bindValue(':celular', $this->cliente->__get('celular'));
            $stmt->bindValue(':id', $this->cliente->__get('id'));
            $stmt->execute();
        }

        public function excluirCliente(){
            $query = 'DELETE FROM tb_clientes WHERE id_cliente = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->cliente->__get('id'));
            $stmt->execute();
        }

        public function mostrarTodosClientes(){
            $query = 'SELECT * FROM tb_clientes ORDER BY nome_cliente';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

?>